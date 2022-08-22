<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ColorRequest;
use App\Http\Services\ColorService;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    private $colorService;

    public function __construct(ColorService $colorService)
    {
        return $this->colorService = $colorService;
    }

    //********************** start Get all Brand ********************

    public function index(Request $request)
    {
        if ($request->ajax()) {

            $color = Color::select('*');

            return datatables($color)->addColumn('color',function ($color){
//                    return '<p style="background: '.$color->color_code.' "></p>' ;
                    return '<p style="background: #00bbff "></p>' ;
                })->addColumn('action', function ($color) {

                $button = '&nbsp;&nbsp;&nbsp;<a type="button" name="edit" href="' . route('admin.color.edit', encrypt($color->id)) . '" class="edit btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>';
                $button .= '&nbsp;&nbsp;&nbsp;<a type="button" name="delete" href="' . route('admin.color.delete', encrypt($color->id)) . '" class="delete btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>';

                return $button;
            })
                ->addIndexColumn()
                ->rawColumns(['action','color'])
                ->make(true);
        }

        return view('admin.color.index', ['page_title' => 'Color', 'menu' => 'Attribute']);
    }


    //********************** End Get all color attribute ********************

    /*
     * * New color attribute create/store
     */

    public function createStore(Request $request)
    {
        if ($request->isMethod('POST')) {

            app(ColorRequest::class);
            $color = $this->colorService->store($request);

            if ($color['success'] == true) {

                toast($color['message'], 'success');
                return redirect()->route('admin.color');
            }

            toast($color['message'], 'warning');
            return redirect()->route('admin.color.create');
        }

        return view('admin.color.create', ['menu' => 'Attribute', 'page_title' => 'Color']);
    }

    // ************************** End create/store ******************

    /*
     * * Find color attribute by editID and and pass color information to edit page
     */


    public function editUpdate(Request $request, $id= null)
    {
        if ($request->isMethod('POST')) {

            $color = $this->colorService->update($request);

            if ($color['success'] == true) {

                toast($color['message'], 'success');
                return redirect()->route('admin.color');
            }

            toast($color['message'], 'warning');
            return redirect()->back();

        } else {

            $color = Color::where('id', decrypt($id))->first();
            if ($color) {

                return view('admin.color.edit', ['color' => $color, 'page_title' => 'Color', 'menu' => 'Attribute']);
            }

            toast("Color doesn't exists", 'warning');
            return redirect()->back();
        }

    }

    //************************End Edit Color Attribute ******************

    /*
     * * Find Color by ID DELETE it
     */

    public function delete($id)
    {
        $color = $this->colorService->delete($id);

        if ($color['success'] == true) {

            toast($color['message'], 'success');
            return redirect()->route('admin.color');
        }

        toast($color['message'], 'warning');
        return redirect()->back();
    }

    //************************End Delete Brand ******************

}
