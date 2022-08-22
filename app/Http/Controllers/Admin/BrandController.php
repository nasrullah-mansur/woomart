<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use App\Http\Services\BrandService;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BrandController extends Controller
{
    private $brandService;

    public function __construct(BrandService $brandService)
    {
        return $this->brandService = $brandService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {

            $brand = Brand::select('*');

            return datatables($brand)->editColumn('image', function ($brand) {
                $logo = '<img src="' . $brand->image . '" height="70" width="90" alt="No Image"/>';
                return $logo;

            })->editColumn('active_status', function ($brand) {

                $button = '' . $brand->active_status == STATUS_ACTIVE ? '<label class="text-success">Active</label>' : '<label class="text-danger">Inactive</label>' . '';
                return $button;

            })->addColumn('action', function ($brand) {

                $button = $brand->active_status == STATUS_ACTIVE ? '<a type="button"  href="' . route('admin.brandChangeStatus', [encrypt($brand->id), encrypt(STATUS_INACTIVE)]) . '" class="btn btn-info btn-sm"><i class="fas fa-lock"></i></a>' : '<a type="button"  href="' . route('admin.brandChangeStatus', [encrypt($brand->id), encrypt(STATUS_ACTIVE)]) . '" class=" btn btn-success btn-sm"><i class="fas fa-lock-open"></i></a>';
                $button .= '&nbsp;&nbsp;&nbsp;<a type="button" name="edit" href="' . route('admin.brand.edit', encrypt($brand->id)) . '" class="edit btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>';
                $button .= '&nbsp;&nbsp;&nbsp;<a type="button" name="delete" href="' . route('admin.brand.delete', encrypt($brand->id)) . '" class="delete btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>';

                return $button;
            })
                ->addIndexColumn()
                ->rawColumns(['image', 'active_status', 'action'])
                ->make(true);
        }

        return view('admin.brand.index', ['page_title' => 'Brand', 'menu' => 'Products']);
    }


    //********************** End Get all Brand ********************

    /*
     * * New Brand create/store
     */

    public function createStore(Request $request)
    {
        if ($request->isMethod('POST')) {

            app(BrandRequest::class);

            $brand = $this->brandService->store($request); // call store function from Brand service class to save brand

            if ($brand['success'] == true) {

                toast($brand['message'], 'success');
                return redirect()->route('admin.brand');
            }

            toast($brand['message'], 'warning');
            return redirect()->back();
        }
        return view('admin.brand.create', ['task' => 'Create', 'menu' => 'Products', 'page_title' => 'Brand',]);
    }

    // ************************** End create/store brand ******************

    /*
     * * Find brand by editID and and pass brand information to edit page and update
     */

    public function editUpdate(Request $request, $id = null)
    {
        if ($request->isMethod('POST')) {

            app(BrandRequest::class);

            $brand = $this->brandService->update($request); // call store function from Brand service class to update brand

            if ($brand['success'] == true) {

                toast($brand['message'], 'success');
                return redirect()->route('admin.brand');
            }

            toast($brand['message'], 'warning');
            return redirect()->back();

        } else {

            $brand = Brand::where('id', decrypt($id))->first();
            if ($brand) {
                return view('admin.brand.edit', ['brand' => $brand, 'task' => 'Edit', 'page_title' => 'Brand', 'menu' => 'Products']);

            } else {

                toast("Brand doesn't exists", 'warning');
                return redirect()->back();
            }

        }
    }


    //************************End Edit/Update Brand ******************

    /*
     * * Find Product by ID DELETE it
     */

    public function delete($id)
    {
        $brand = $this->brandService->delete($id);

        if ($brand['success'] == true) {

            toast($brand['message'], 'success');
            return redirect()->route('admin.brand');
        }

        toast($brand['message'], 'warning');
        return redirect()->back();
    }

    //************************End Delete Brand ******************

    /*
     * * Find Brand by ID and change active status,
     * * * if status is active; Brand is active at this moment,
     * * * * Otherwise it active
     */

    public function changeStatus($id, $status)
    {
        $brand = Brand::where('id', decrypt($id))->first();

        if ($brand) {

            $success = $brand->update(['active_status' => decrypt($status)]);
            $message = decrypt($status) == STATUS_ACTIVE ? 'Active' : 'inActive';

            if ($success) {
                toast('Brand successfully ' . $message, 'success');
                return redirect()->route('admin.brand');
            }

            toast($message, 'success');
            return redirect()->back();

        }

        toast("Brand doesn't exists", 'warning');
        return redirect()->back();

    }


    //************************End status active/inActive ******************


}
