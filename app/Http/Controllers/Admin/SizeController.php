<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SizeRequest;
use App\Http\Services\SizeService;
use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    private $sizeService;

    public function __construct(SizeService $sizeService)
    {
        return $this->sizeService = $sizeService;
    }

    //********************** start get all size  ********************

    public function index(Request $request)
    {
        if ($request->ajax()) {

            $size = Size::select('*');

            return datatables($size)->addColumn('action', function ($size) {

                $button = '&nbsp;&nbsp;&nbsp;<a type="button" name="edit" href="' . route('admin.size.edit', encrypt($size->id)) . '" class="edit btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>';
                $button .= '&nbsp;&nbsp;&nbsp;<a type="button" name="delete" href="' . route('admin.size.delete', encrypt($size->id)) . '" class="delete btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>';

                return $button;
            })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.size.index', ['page_title' => 'Size', 'menu' => 'Attribute']);
    }


    //********************** End get all size attribute ********************

    /*
     * * New size attribute create/store
     */

    public function createStore(Request $request)
    {
        if ($request->isMethod('POST')) {

            app(SizeRequest::class);
            $size = $this->sizeService->store($request);

            if ($size['success'] == true) {

                toast($size['message'], 'success');
                return redirect()->route('admin.size');
            }

            toast($size['message'], 'warning');
            return redirect()->route('admin.size.create');
        }

        return view('admin.size.create', ['menu' => 'Attribute', 'page_title' => 'Size']);
    }

    // ************************** End create/store ******************

    /*
     * * Find size attribute by editID and and pass size information to edit page
     */


    public function editUpdate(Request $request, $id = null)
    {
        if ($request->isMethod('POST')) {

            $size = $this->sizeService->update($request);

            if ($size['success'] == true) {

                toast($size['message'], 'success');
                return redirect()->route('admin.size');
            }

            toast($size['message'], 'warning');
            return redirect()->back();

        } else {

            $size = Size::where('id', decrypt($id))->first();
            if ($size) {

                return view('admin.size.edit', ['size' => $size, 'page_title' => 'Size', 'menu' => 'Attribute']);
            }

            toast("Size doesn't exists", 'warning');
            return redirect()->back();
        }

    }

    //************************End Edit size Attribute ******************

    /*
     * * Find size by ID DELETE it
     */

    public function delete($id)
    {
        $size = $this->sizeService->delete($id);

        if ($size['success'] == true) {

            toast($size['message'], 'success');
            return redirect()->route('admin.size');
        }

        toast($size['message'], 'warning');
        return redirect()->back();
    }

    //************************End Delete Brand ******************

}
