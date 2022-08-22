<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientFeedbackRequest;
use App\Http\Services\ClientFeedbackService;
use App\Models\ClientFeedback;
use Illuminate\Http\Request;

class ClientFeedbackController extends Controller
{
    private $clientFeedbackService;

    public function __construct(ClientFeedbackService $clientFeedbackService)
    {
        return $this->clientFeedbackService = $clientFeedbackService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {

            $feedbacks = ClientFeedback::select('*');

            return datatables($feedbacks)->editColumn('image', function ($feedbacks) {
                $image = '<img src="' . $feedbacks->image . '" height="70" width="90" alt="No Image"/>';
                return $image;

            })->editColumn('active_status', function ($feedbacks) {

                $button = '' . $feedbacks->active_status == STATUS_ACTIVE ? '<label class="text-success">Active</label>' : '<label class="text-danger">Inactive</label>' . '';
                return $button;

            })->addColumn('action', function ($feedbacks) {

                $button = $feedbacks->active_status == STATUS_ACTIVE ? '<a type="button"  href="' . route('admin.client.feedback.status', [encrypt($feedbacks->id), encrypt(STATUS_INACTIVE)]) . '" class="btn btn-info btn-sm"><i class="fas fa-lock"></i></a>' : '<a type="button"  href="' . route('admin.client.feedback.status', [encrypt($feedbacks->id), encrypt(STATUS_ACTIVE)]) . '" class=" btn btn-success btn-sm"><i class="fas fa-lock-open"></i></a>';
                $button .= '&nbsp;&nbsp;&nbsp;<a type="button" name="edit" href="' . route('admin.client.feedback.edit', encrypt($feedbacks->id)) . '" class="edit btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>';

                return $button;
            })
                ->addIndexColumn()
                ->rawColumns(['image', 'active_status', 'action'])
                ->make(true);
        }

        return view('admin.pages.client_feedback.index', [ 'section' => 'about us','page_title' => 'Client feedback', 'menu' => 'Pages']);
    }


    //********************** End Get all client feedback ********************


    /*
     * * Find client feedback by editID and and pass client feedback information to edit page and update
     */

    public function editUpdate(Request $request, $id = null)
    {
        if ($request->isMethod('POST')) {

            app(ClientFeedbackRequest::class);

            $feedbacks = $this->clientFeedbackService->update($request); // call store function from client feedback service class to update client feedback

            if ($feedbacks['success'] == true) {

                toast($feedbacks['message'], 'success');
                return redirect()->route('admin.client.feedback');
            }

            toast($feedbacks['message'], 'warning');
            return redirect()->back();

        } else {

            $feedback = ClientFeedback::where('id', decrypt($id))->first();
            if ($feedback) {
                return view('admin.pages.client_feedback.edit', ['feedback' => $feedback, 'task' => 'Edit', 'page_title' => 'Client feedback', 'menu' => 'Pages', 'section' => 'about us']);

            } else {

                toast("Client feedback doesn't exists", 'warning');
                return redirect()->back();
            }

        }
    }


    /*
     * * Find client feedback by ID and change active status,
     * * * if status is active; client feedback is active at this moment,
     * * * * Otherwise it active
     */

    public function changeStatus($id, $status)
    {
        $feedbacks = ClientFeedback::where('id', decrypt($id))->first();

        if ($feedbacks) {

            $success = $feedbacks->update(['active_status' => decrypt($status)]);
            $message = decrypt($status) == STATUS_ACTIVE ? 'Active' : 'inActive';

            if ($success) {
                toast('Client feedback successfully ' . $message, 'success');
                return redirect()->route('admin.client.feedback');
            }

            toast($message, 'success');
            return redirect()->back();

        }

        toast("Client feedback doesn't exists", 'warning');
        return redirect()->back();

    }


    //************************End status active/inActive ******************


}
