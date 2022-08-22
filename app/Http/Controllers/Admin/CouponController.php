<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CouponEditRequest;
use App\Http\Requests\CouponRequest;
use App\Model\Category;
use App\Model\Brand;
use App\Model\Coupon;
use App\Model\CouponCategory;
use App\Services\CouponService;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use function GuzzleHttp\Promise\all;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CouponController extends Controller
{
    /*
     * * Get All active Coupon, order by id decrement
     */

    public function __construct(Request $request)
    {

        $this->route = $request->route()->getAction();
        $this->page_title = $this->route['page_title'];
        $this->task = Str::ucfirst($this->route['task']);
        $this->pageSettings = array('page_title' => $this->page_title, 'task' => $this->task);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $coupons = Coupon::orderBy('id', 'desc')->select('*');
            return datatables($coupons)
                ->editColumn('value', function ($coupons) {

                    $discount = $coupons->value;
                    $discount .= $coupons->is_percentage ? ' %' : '';

                    return $discount;
                })
                ->editColumn('status', function ($coupons) {


                    return status_field($coupons->active_status, 'admin.coupon', $coupons->id);//status,route,id

                })
                ->editColumn('created_at', function ($coupons) {
                    return Carbon::parse($coupons->created_at)->diffForHumans();

                })->editColumn('end_date', function ($coupons) {
                    return Carbon::parse($coupons->end_date)->diffForHumans() . ' (' . Carbon::parse($coupons->end_date)->format('d F') . ')';

                })
                ->editColumn('action', function ($coupons) {

                    return action_field('admin.coupon', $coupons->id, null, 'edit', null);//route,id,VED


                })
                ->addIndexColumn()
                ->rawColumns(['status', 'action', 'end_date', 'value'])
                ->make(true);

        }


        return view('admin.coupon.index', ['pageSettings' => $this->pageSettings]);

    }

    //********************** End Get all Coupon ********************

    /*
     * * New Coupon add/create and update
     */

    public function addEdit(Request $request)
    {
        if ($request->isMethod('POST')) {

            app(CouponRequest::class);

            $save = app(CouponService::class)->addEdit($request); // call addEdit function from Coupon service class to add/create new coupon or update
            if ($save['status'] == true) {

                return redirect()->route('admin.coupons')->with('success', $save['message']);

            }
            return redirect()->route('admin.coupon.add')->with('warning', $save['message']);
        }
        $categories = Category::where(['active_status' => STATUS_ACTIVE, 'parent_id' => PARENT])->get();
        return view('admin.coupon.create', ['menu' => 'Coupon', 'categories' => $categories, 'pageSettings' => $this->pageSettings]);
    }

    // ************************** End add/create and update ******************

    /*
     * * Find Coupon by editID and and pass Coupon information to edit page
     */

    //************************End Edit category ******************

    /*
     * * Find Product by ID DELETE it
     */

    public function delete($id)
    {
        $coupon = app(CouponService::class)->delete(decrypt($id));
        if ($coupon['status'] == true) {
            return redirect()->route('admin.coupons')->with('success', $coupon['message']);
        }
        return redirect()->route('admin.coupons')->with('errors', $coupon['message']);

    }

    //************************End Delete Coupon ******************

    /*
     * * Find Coupon by ID and change active status,
     * * * if status is active; Coupon is active at this moment,
     * * * * Otherwise it active
     */

    public function inActive($id)
    {
        try {
            $coupon = Coupon::where('id', decrypt($id))->first();
            $coupon->update(['active_status' => 0]);        //active_status = 0; inActive
            return redirect()->route('admin.coupons')->with('success', __('Coupon successfully inActive'));

        } catch (\Exception $e) {
            return redirect()->route('admin.coupons')->with('dismiss', __('Something went wrong, please try again, Thanks!'));
        }
    }

    public function Active($id)
    {
        try {
            $coupon = Coupon::where('id', decrypt($id))->first();
            $coupon->update(['active_status' => 1]);        // active_status = 1; Active
            return redirect()->route('admin.coupons')->with('success', __('Coupon successfully Active'));

        } catch (\Exception $e) {
            return redirect()->route('admin.coupons')->with('dismiss', __('Something went wrong, please try again, Thanks!'));
        }
    }

    //************************End status active/inActive ******************

    public function edit($id)
    {
        $coupon = Coupon::where('id', decrypt($id))->first();

        $parent = Category::where(['active_status' => STATUS_ACTIVE])->max('parent_id');
        $categories = Category::where('parent_id', PARENT)->get();
        $coupon_categories = CouponCategory::where(['coupon_id' => $coupon->id, 'is_exclude' => false])->select('category_id')->with('category')->get();
        $exclude_coupon_categories = CouponCategory::where(['coupon_id' => $coupon->id, 'is_exclude' => true])->select('category_id')->with('category')->get();

        $coupon_categories_array = [];
        $index = 0;
        foreach ($coupon_categories as $key) {
            $coupon_categories_array[$index] = $key->category_id;
            $index++;
        }

        $exclude_coupon_categories_array = [];
        $index = 0;
        foreach ($exclude_coupon_categories as $key) {
            $exclude_coupon_categories_array[$index] = $key->category_id;
            $index++;
        }

        return view('admin.coupon.create', ['coupon' => $coupon, 'categories' => $categories, 'coupon_categories' => $coupon_categories_array, 'exclude_coupon_categories' => $exclude_coupon_categories_array, 'pageSettings' => $this->pageSettings]);
    }


    public function categoryTree($parent_id)
    {
        $childs = Category::Where('parent_id', $parent_id)->get();

        if (!empty($childs) && count($childs) > 0) {

            foreach ($childs as $child) {
                $data[] = [
                    'id' => $child->id,
                    'name' => $child->name,
                ];

                $this->categoryTree($child->id);
            }

            return $data;
        }

    }

}
