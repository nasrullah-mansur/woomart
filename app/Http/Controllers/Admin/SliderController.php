<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Http\Services\SliderService;
use App\Models\Slider;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SliderController extends Controller
{
    private $sliderService;

    public function __construct(SliderService $sliderService)
    {
        return $this->sliderService = $sliderService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {

            $slider = Slider::select('*');

            return datatables($slider)->editColumn('image', function ($slider) {
                $logo = '<img src="' . $slider->image . '" height="70" width="90" alt="No Image"/>';
                return $logo;

            })->editColumn('active_status', function ($slider) {

                $button = '' . $slider->active_status == STATUS_ACTIVE ? '<label class="text-success">Active</label>' : '<label class="text-danger">Inactive</label>' . '';
                return $button;

            })->addColumn('action', function ($slider) {

                $button = $slider->active_status == STATUS_ACTIVE ? '<a type="button"  href="' . route('admin.sliderChangeStatus', [encrypt($slider->id), encrypt(STATUS_INACTIVE)]) . '" class="btn btn-info btn-sm"><i class="fas fa-lock"></i></a>' : '<a type="button"  href="' . route('admin.sliderChangeStatus', [encrypt($slider->id), encrypt(STATUS_ACTIVE)]) . '" class=" btn btn-success btn-sm"><i class="fas fa-lock-open"></i></a>';
                $button .= '&nbsp;&nbsp;&nbsp;<a type="button" name="edit" href="' . route('admin.slider.edit', encrypt($slider->id)) . '" class="edit btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>';
                $button .= '&nbsp;&nbsp;&nbsp;<a type="button" name="delete" href="' . route('admin.slider.delete', encrypt($slider->id)) . '" class="delete btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>';

                return $button;
            })
                ->addIndexColumn()
                ->rawColumns(['image', 'active_status', 'action'])
                ->make(true);
        }

        return view('admin.slider.index', ['task' => 'List', 'page_title' => 'Slider', 'menu' => 'Slider']);
    }


    //********************** End Get all Slider ********************

    /*
     * * New Slider add/create and update
     */

    public function createStore(Request $request)
    {
        if ($request->isMethod('POST')) {

            app(SliderRequest::class);

            $slider = $this->sliderService->store($request); // call store function from Slider service class to save slider

            if ($slider['success'] == true) {

                toast($slider['message'], 'success');
                return redirect()->route('admin.slider');
            }

            toast($slider['message'], 'warning');
            return redirect()->back();
        }

        return view('admin.slider.create', ['task' => 'Create', 'menu' => 'Slider', 'page_title' => 'Slider',]);
    }

    // ************************** End add/create and update ******************

    /*
     * * Find slider by editID and and pass slider information to edit page and update
     */

    public function editUpdate(Request $request, $id = null)
    {
        if ($request->isMethod('POST')) {

            $slider = $this->sliderService->update($request); // call update function from Slider service class to update slider

            if ($slider['success'] == true) {

                toast($slider['message'], 'success');
                return redirect()->route('admin.slider');
            }

            toast($slider['message'], 'warning');
            return redirect()->back();

        } else {

            try {

                $slider = Slider::where('id', decrypt($id))->first();
                return view('admin.slider.edit', ['slider' => $slider, 'task' => 'Edit', 'page_title' => 'Slider', 'menu' => 'Slider']);

            } catch (\Exception $e) {

                toast("Slider doesn't exists", 'warning');
                return redirect()->back();

            }
        }

    }

    //************************End Edit/Update slider ******************


    /*
     * * Find Product by ID DELETE it
     */

    public function delete($id)
    {
        $slider = $this->sliderService->delete($id);

        if ($slider['success'] == true) {

            toast($slider['message'], 'success');
            return redirect()->route('admin.slider');
        }

        toast($slider['message'], 'warning');
        return redirect()->back();
    }

    //************************End Delete Slider ******************

    /*
     * * Find Slider by ID and change active status,
     */

    public function changeStatus($id, $status)
    {
        $slider = Slider::where('id', decrypt($id))->first();

        if ($slider) {

            $success = $slider->update(['active_status' => decrypt($status)]);   // active = 1; in active = 0;
            $message = decrypt($status) == STATUS_ACTIVE ? 'Active' : 'inActive';

            if ($success) {

                toast('Slider successfully ' . $message, 'success');
                return redirect()->back();
            }

            toast("Something went wrong", 'warning');
            return redirect()->back();
        }

        toast("Slider doesn't exists", 'warning');
        return redirect()->back();

    }


    //************************End status active/inActive ******************


}
