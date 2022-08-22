<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShopPageRequest;
use App\Http\Services\ShopService;
use App\Models\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    private $shopService;

    public function __construct(ShopService $shopService)
    {
        return $this->shopService = $shopService;
    }

    public function index(Request $request)
    {

        if ($request->ajax()) {

            $shop = Shop::select('*');

            return datatables($shop)->editColumn('banner', function ($shop) {

                return '<img src="' . $shop->banner . '" height="70" width="90" alt="No Image"/>';


            })->editColumn('active_status', function ($shop) {

                return '' . $shop->active_status == STATUS_ACTIVE ? '<label class="text-success">Active</label>' : '<label class="text-danger">Inactive</label>' . '';


            })->addColumn('action', function ($shop) {

                $button = $shop->active_status == STATUS_ACTIVE ? '<a type="button"  href="' . route('admin.page.shop.status', [encrypt($shop->id), encrypt(STATUS_INACTIVE)]) . '" class="btn btn-info btn-sm"><i class="fas fa-lock"></i></a>' : '<a type="button"  href="' . route('admin.page.shop.status', [encrypt($shop->id), encrypt(STATUS_ACTIVE)]) . '" class=" btn btn-success btn-sm"><i class="fas fa-lock-open"></i></a>';
                $button .= '&nbsp;&nbsp;&nbsp;<a type="button" name="edit" href="' . route('admin.page.shop.edit', encrypt($shop->id)) . '" class="edit btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>';
                $button .= '&nbsp;&nbsp;&nbsp;<a type="button" name="delete" href="' . route('admin.page.shop.delete', encrypt($shop->id)) . '" class="delete btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>';

                return $button;
            })
                ->addIndexColumn()
                ->rawColumns(['banner', 'active_status', 'action'])
                ->make(true);
        }

        return view('admin.pages.shop.index', ['page_title' => 'Shop Banner', 'menu' => 'Pages']);
    }


    //********************** End Get all Shop Banner ********************

    /*
     * * New shop create/store
     */

    public function createStore(Request $request)
    {
        if ($request->isMethod('POST')) {
            app(ShopPageRequest::class);

            $shop = $this->shopService->store($request); // call store function from Shop Banner service class to save Shop Banner

            if ($shop['success'] == true) {

                toast($shop['message'], 'success');
                return redirect()->route('admin.page.shop');
            }

            toast($shop['message'], 'warning');
            return redirect()->back();
        }
        return view('admin.pages.shop.create', ['task' => 'Create', 'menu' => 'Pages', 'page_title' => 'Shop Banner',]);
    }

    // ************************** End create/store Shop Banner ******************

    /*
     * * Find Shop Banner by editID and and pass Shop Banner information to edit page and update
     */

    public function editUpdate(Request $request, $id = null)
    {
        if ($request->isMethod('POST')) {

            app(ShopPageRequest::class);

            $shop = $this->shopService->update($request); // call store function from Shop Banner service class to update Shop Banner

            if ($shop['success'] == true) {

                toast($shop['message'], 'success');
                return redirect()->route('admin.page.shop');
            }

            toast($shop['message'], 'warning');
            return redirect()->back();

        } else {

            $shop = Shop::where('id', decrypt($id))->first();
            if ($shop) {
                return view('admin.pages.shop.edit', ['shop' => $shop, 'task' => 'Edit', 'page_title' => 'Shop Banner', 'menu' => 'Pages']);

            } else {

                toast("The Shop Banner doesn't exists", 'warning');
                return redirect()->back();
            }

        }
    }


    //************************End Edit/Update Shop Banner ******************

    /*
     * * Find Product by ID DELETE it
     */

    public function delete($id)
    {
        $shop = $this->shopService->delete($id);

        if ($shop['success'] == true) {

            toast($shop['message'], 'success');
            return redirect()->route('admin.page.shop');
        }

        toast($shop['message'], 'warning');
        return redirect()->back();
    }

    //************************End Delete Shop Banner ******************

    /*
     * * Find Shop Banner by ID and change active status,
     * * * if status is active; Shop Banner is active at this moment,
     * * * * Otherwise it active
     */

    public function changeStatus($id, $status)
    {
        $shop = Shop::where('id', decrypt($id))->first();

        if($shop) {

            $success = $shop->update(['active_status' => decrypt($status)]);
            $message = decrypt($status) == STATUS_ACTIVE ? 'Active' : 'inActive';

            if ($success) {
                toast('Shop banner successfully ' . $message, 'success');
                return redirect()->route('admin.page.shop');
            }

            toast($message, 'success');
            return redirect()->back();

        }

        toast("Shop Banner doesn't exists", 'warning');
        return redirect()->back();

    }


    //************************End status active/inActive ******************


}
