<?php

namespace App\Http\Controllers\Admin;

use App;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\ManagerService;
use App\Http\Requests\ManagerCreateRequest;
use App\Http\Repository\ManagerRepository;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;


class ManagerController extends Controller
{
    private $managerService;

    public function __construct(ManagerService $managerService, Request $request)
    {
        $this->managerService = $managerService;

        $this->route = $request->route()->getAction();
        $this->page_title = isset($this->route['page_title']) ? $this->route['page_title'] : null;
        $this->task = isset($this->route['task']) ? $this->route['task'] : null;
        $this->pageSettings = array('page_title' => $this->page_title, 'task' => $this->task);
    }

    /*
    Admin List
    */

    public function index(Request $request)
    {
        if ($request->ajax()) {
//            $managers = App::make(ManagerService::class)->getManagerForDatatable();
            $admin_id = Auth::guard('admin')->id();
            $managers = $this->managerService->getManagerForDatatable(['admin_id' => $admin_id]);
            return datatables($managers)->editColumn('status', function ($managers) {

                $button = ''.$managers->status== STATUS_ACTIVE ?'<label class="text-success">Active</label>':'<label class="text-danger">Inactive</label>'.'';

                return $button;
            })->addColumn('action', function ($managers) {
                $button = $managers->status == STATUS_ACTIVE ? '<a type="button"  href="' . route('admin.managerStatus', [app()->getLocale(), encrypt($managers->id), encrypt(STATUS_INACTIVE)]) . '" class="btn btn-info btn-sm"><i class="fas fa-lock"></i></a>' : '<a type="button"  href="' . route('admin.managerStatus', [app()->getLocale(), encrypt($managers->id), encrypt(STATUS_ACTIVE)]) . '" class=" btn btn-success btn-sm"><i class="fas fa-lock-open"></i></a>';
                $button .= '&nbsp;&nbsp;&nbsp;<a type="button" name="edit" href="' . route('admin.managerEdit',[app()->getLocale(), encrypt($managers->id)]) . '" class="edit btn btn-primary btn-sm">Edit</a>';
                $button .= '&nbsp;&nbsp;&nbsp;<a type="button" name="delete" href="' . route('admin.managerDelete',[app()->getLocale(),  encrypt($managers->id)]) . '" class="delete btn btn-danger btn-sm">Delete</a>';

                return $button;
            })
                ->addIndexColumn()
                ->rawColumns(['status','action'])
                ->make(true);
        }

        return view('admin.manager.index', ['pageSettings' => $this->pageSettings]);
    }

    /*
    Admin Create and edit
    */

    public function StoreOrUpdate(Request $request)
    {

        if ($request->isMethod('POST')) {

            app(ManagerCreateRequest::class);
            $manager = $this->managerService->storeOrUpdate($request);

            if ($manager['success'] == true) {
                return redirect()->route('admin.managers', app()->getLocale())->with('success', $manager['message']);
            }

            Alert::error('ops',$manager['message']);
            return redirect()->route('admin.managers', app()->getLocale())->with('error', $manager['message']);

        }
        return view('admin.manager.create')->with(['pageSettings' => $this->pageSettings]);
    }

//edit

    public function edit($lang, $id)
    {
        $manager = app(ManagerRepository::class)->first(['id'=> decrypt($id)]);
        if ($manager) {
            return view('admin.manager.edit', ['manager' => $manager]);
        }
        return redirect()->route('admin.managers', app()->getLocale())->with('error', __('Something went wrong, please try again, thanks!!'));
    }

    /*
    Admin delete
    */

    public function delete($lang, $id)
    {

        $manager = $this->managerService->delete($id);

        if ($manager['success'] == true) {

            return redirect()->route('admin.managers', app()->getLocale())->with('success', $manager['message']);
        }
        return redirect()->route('admin.managers', app()->getLocale())->with('dismiss', $manager['message']);
    }


    public function changeStatus($lang, $id, $status)
    {
        $admins = $this->managerService->changeStatus($id, $status);

        if ($admins['success'] == true) {
            return redirect()->route('admin.managers', app()->getLocale())->with('success', $admins['message']);
        }
        return redirect()->route('admin.managers', app()->getLocale())->with('dismiss', $admins['message']);
    }

}
