<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\AttributeService;
use App\Models\Attribute;
use App\Models\AttributeSet;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AttributeController extends Controller
{
    private $attributeService;

    public function __construct(AttributeService $attributeService)
    {
        return $this->attributeService = $attributeService;
    }

    //********************** start Get all Brand ********************

    public function index(Request $request)
    {
        if ($request->ajax()) {

            $attribute = Attribute::select('*');

            return datatables($attribute)->addColumn('action', function ($attribute) {

                $button = '&nbsp;&nbsp;&nbsp;<a type="button" name="edit" href="' . route('admin.attribute.edit', encrypt($attribute->id)) . '" class="edit btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>';
                $button .= '&nbsp;&nbsp;&nbsp;<a type="button" name="delete" href="' . route('admin.attribute.delete', encrypt($attribute->id)) . '" class="delete btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>';

                return $button;
            })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.attribute.index', ['page_title' => 'Attribute', 'menu' => 'Products']);
    }


    //********************** End Get all attribute ********************

    /*
     * * New Attribute create/store
     */

    public function createStore(Request $request)
    {
        if ($request->isMethod('POST')) {

            $attribute = $this->attributeService->store($request);

            if ($attribute['success'] == true) {

                toast($attribute['message'], 'success');
                return redirect()->route('admin.attribute');
            }

            toast($attribute['message'], 'warning');
            return redirect()->route('admin.attribute.create');
        }

        $attributeSets = AttributeSet::all();
        return view('admin.attribute.create', ['attributeSets' => $attributeSets, 'menu' => 'Products', 'page_title' => 'Attribute']);
    }

    // ************************** End create/store ******************

    /*
     * * Find attribute by editID and and pass attribute information to edit page
     */


    public function editUpdate(Request $request, $id)
    {
        if ($request->isMethod('POST')) {

            $attribute = $this->attributeService->update($request);

            if ($attribute['success'] == true) {

                toast($attribute['message'], 'success');
                return redirect()->route('admin.attribute');
            }

            toast($attribute['message'], 'warning');
            return redirect()->route('admin.attribute.edit');

        } else {

            $attribute = Attribute::where('id', decrypt($id))->first();
            if ($attribute) {

                $attributeSets = AttributeSet::all();
                return view('admin.brand.edit', ['attribute' => $attribute, 'attributeSets' => $attributeSets, 'page_title' => 'Attribute', 'menu' => 'Products']);
            }

            toast("Attribute doesn't exists", 'warning');
            return redirect()->back();
        }

    }

    //************************End Edit Attribute ******************

    /*
     * * Find Attribute by ID DELETE it
     */

    public function delete($id)
    {
        $attribute = $this->attributeService->delete($id);

        if ($attribute['success'] == true) {

            toast($attribute['message'], 'success');
            return redirect()->route('admin.attribute');
        }

        toast($attribute['message'], 'warning');
        return redirect()->back();
    }

    //************************End Delete Brand ******************

}
