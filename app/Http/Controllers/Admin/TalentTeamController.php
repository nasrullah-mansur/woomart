<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Http\Requests\TalentTeamRequest;
use App\Http\Services\TalentTeamService;
use App\Models\Brand;
use App\Http\Services\BrandService;
use App\Models\TalentTeam;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class TalentTeamController extends Controller
{
    private $talentTeamService;

    public function __construct(TalentTeamService $talentTeamService)
    {
        return $this->talentTeamService = $talentTeamService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {

            $talent = TalentTeam::select('*');

            return datatables($talent)->editColumn('image', function ($talent) {
                $logo = '<img src="' . $talent->image . '" height="70" width="90" alt="No Image"/>';
                return $logo;

            })->editColumn('active_status', function ($talent) {

                $button = '' . $talent->active_status == STATUS_ACTIVE ? '<label class="text-success">Active</label>' : '<label class="text-danger">Inactive</label>' . '';
                return $button;

            })->addColumn('action', function ($talent) {

                $button = $talent->active_status == STATUS_ACTIVE ? '<a type="button"  href="' . route('admin.talent.team.status', [encrypt($talent->id), encrypt(STATUS_INACTIVE)]) . '" class="btn btn-info btn-sm"><i class="fas fa-lock"></i></a>' : '<a type="button"  href="' . route('admin.talent.team.status', [encrypt($talent->id), encrypt(STATUS_ACTIVE)]) . '" class=" btn btn-success btn-sm"><i class="fas fa-lock-open"></i></a>';
                $button .= '&nbsp;&nbsp;&nbsp;<a type="button" name="edit" href="' . route('admin.talent.team.edit', encrypt($talent->id)) . '" class="edit btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>';
                $button .= '&nbsp;&nbsp;&nbsp;<a type="button" name="delete" href="' . route('admin.talent.team.delete', encrypt($talent->id)) . '" class="delete btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>';

                return $button;
            })
                ->addIndexColumn()
                ->rawColumns(['image', 'active_status', 'action'])
                ->make(true);
        }

        return view('admin.pages.talent_team.index', ['page_title' => 'Talent Team', 'menu' => 'Pages']);
    }


    //********************** End Get all Brand ********************

    /*
     * * New Brand create/store
     */

    public function createStore(Request $request)
    {
        if ($request->isMethod('POST')) {
            app(TalentTeamRequest::class);

            $talent = $this->talentTeamService->store($request); // call store function from Brand service class to save brand

            if ($talent['success'] == true) {

                toast($talent['message'], 'success');
                return redirect()->route('admin.talent.team');
            }

            toast($talent['message'], 'warning');
            return redirect()->back();
        }
        return view('admin.pages.talent_team.create', ['task' => 'Create', 'menu' => 'Pages', 'page_title' => 'Talent Team',]);
    }

    // ************************** End create/store brand ******************

    /*
     * * Find brand by editID and and pass brand information to edit page and update
     */

    public function editUpdate(Request $request, $id = null)
    {
        if ($request->isMethod('POST')) {

            app(TalentTeamRequest::class);

            $talent = $this->talentTeamService->update($request); // call store function from Brand service class to update brand

            if ($talent['success'] == true) {

                toast($talent['message'], 'success');
                return redirect()->route('admin.talent.team');
            }

            toast($talent['message'], 'warning');
            return redirect()->back();

        } else {

            $talent = TalentTeam::where('id', decrypt($id))->first();
            if ($talent) {
                return view('admin.pages.talent_team.edit', ['talent' => $talent, 'task' => 'Edit', 'page_title' => 'Talent Team', 'menu' => 'Pages']);

            } else {

                toast("Talent doesn't exists", 'warning');
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
        $talent = $this->talentTeamService->delete($id);

        if ($talent['success'] == true) {

            toast($talent['message'], 'success');
            return redirect()->route('admin.talent.team');
        }

        toast($talent['message'], 'warning');
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
        $talent = TalentTeam::where('id', decrypt($id))->first();

        if ($talent) {

            $success = $talent->update(['active_status' => decrypt($status)]);
            $message = decrypt($status) == STATUS_ACTIVE ? 'Active' : 'inActive';

            if ($success) {
                toast('Talent successfully ' . $message, 'success');
                return redirect()->route('admin.talent.team');
            }

            toast($message, 'success');
            return redirect()->back();

        }

        toast("Talent doesn't exists", 'warning');
        return redirect()->back();

    }


    //************************End status active/inActive ******************


}
