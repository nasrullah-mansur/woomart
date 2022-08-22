<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BannerCreateRequeast;
use App\Http\Services\BannerService;
use App\Models\Banner;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BannerController extends Controller
{
    private $bannerService;

    public function __construct(BannerService $bannerService)
    {
        return $this->bannerService = $bannerService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {

            $banner = Banner::select('*');

            return datatables($banner)->editColumn('offer_banner1', function ($banner) {
                $logo = '<img src="' . $banner->offer_banner1 . '" height="70" width="90" alt="No Image"/>';
                return $logo;

            })->editColumn('offer_banner2', function ($banner) {
                $logo = '<img src="' . $banner->offer_banner2 . '" height="70" width="90" alt="No Image"/>';
                return $logo;

            })->editColumn('offer_banner3', function ($banner) {
                $logo = '<img src="' . $banner->offer_banner3 . '" height="70" width="90" alt="No Image"/>';
                return $logo;

            })->editColumn('trend_banner1', function ($banner) {
                $logo = '<img src="' . $banner->trend_banner1 . '" height="70" width="90" alt="No Image"/>';
                return $logo;

            })->editColumn('trend_banner2', function ($banner) {
                $logo = '<img src="' . $banner->trend_banner2 . '" height="70" width="90" alt="No Image"/>';
                return $logo;

            })->addColumn('action', function ($banner) {

                $button = '&nbsp;&nbsp;&nbsp;<a type="button" name="edit" href="' . route('admin.banner.edit', encrypt($banner->id)) . '" class="edit btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>';
                $button .= '&nbsp;&nbsp;&nbsp;<a type="button" name="delete" href="' . route('admin.banner.delete', encrypt($banner->id)) . '" class="delete btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>';

                return $button;
            })
                ->addIndexColumn()
                ->rawColumns(['offer_banner1', 'offer_banner2', 'offer_banner3', 'trend_banner1', 'trend_banner2', 'action'])
                ->make(true);
        }

        $banner = Banner::first();
        return view('admin.banner.index', ['task' => 'List', 'page_title' => 'Banner', 'menu' => 'Banner', 'banner' => $banner]);
    }


    //********************** End Get all Slider ********************

    /*
     * * New Banner add/create and update
     */

    public function createStore(Request $request)
    {
        if ($request->isMethod('POST')) {

            app(BannerCreateRequeast::class);

            $banner = $this->bannerService->store($request); // call store function from Slider service class to save slider

            if ($banner['success'] == true) {

                toast($banner['message'], 'success');
                return redirect()->route('admin.banner');
            }

            toast($banner['message'], 'warning');
            return redirect()->back();
        }

        return view('admin.banner.create', ['task' => 'Create', 'menu' => 'Banner', 'page_title' => 'Banner',]);
    }


    // ************************** End store ******************

    /*
     * * Find Banner by editID and pass banner information to edit page and update
     */

    public function editUpdate(Request $request, $id = null)
    {
        if ($request->isMethod('POST')) {

            app(BannerCreateRequeast::class);
            $banner = $this->bannerService->update($request); // call update function from banner service class to update banner

            if ($banner['success'] == true) {

                toast($banner['message'], 'success');
                return redirect()->route('admin.banner');
            }

            toast($banner['message'], 'warning');
            return redirect()->back();

        } else {

            try {

                $banner = Banner::where('id', decrypt($id))->first();
                return view('admin.banner.edit', ['banner' => $banner, 'page_title' => 'Banner', 'menu' => 'Banner']);

            } catch (\Exception $e) {

                toast("Banner doesn't exists", 'warning');
                return redirect()->back();

            }
        }

    }

    //************************End Edit banner ******************

    /*
     * * Find Product by ID DELETE it
     */

    public function delete($id)
    {
        $banner = $this->bannerService->delete($id);

        if ($banner['success'] == true) {

            toast($banner['message'], 'success');
            return redirect()->route('admin.banner');
        }

        toast($banner['message'], 'warning');
        return redirect()->back();
    }

    //************************End Delete Slider ******************


}
