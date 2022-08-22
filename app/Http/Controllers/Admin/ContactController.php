<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\ContactUs;
use App\Services\ContactService;
use App\User;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /*
     * * Get All categories order by id decrement
     */
    private $contactService;

    public function __construct(ContactService $contactService, Request $request)
    {
        return $this->contactService = $contactService;

    }

    public function index(Request $request)
    {
        if ($request->ajax()) {

            $contact = $this->contactService->getAllContactForDatatable();

            return datatables($contact)->editColumn('user_id', function ($contact) {
                $name = $contact->user_id ? $contact->user->name : '';
                return $name;

            })->editColumn('created_at', function ($contact) {
                $date = date('d-M-Y h:m', strtotime($contact->created_at));
                return $date;

            })->editColumn('message', function ($contact) {
                $message = substr($contact->message, 0, 32) . '....';
                return $message;

            })->editColumn('email', function ($contact) {
                $email = $contact->email ? $contact->email : 'Reply by Shopstick';
                return $email;

            })->addColumn('action', function ($contact) {

                $button = '<a type="button" name="delete" href="' . route('admin.contact.delete', [encrypt($contact->id)]) . '" class="btn-danger">Delete</a>';
                $button .= '&nbsp;&nbsp;&nbsp;<a type="button" name="edit" href="' . route('admin.contact.reply', [encrypt($contact->user_id)]) . '" class="edit btn btn-primary btn-sm">Reply</a>';

                return $button;
            })
                ->addIndexColumn()
                ->rawColumns(['user_id', 'created_at', 'action'])
                ->make(true);
        }

        return view('admin.contact.index', ['page_title' => 'Contact']);
    }

    /*
     * * Reply
     */

    public function Reply($user_id)
    {
        $contacts = ContactUs::where(['user_id' => decrypt($user_id)])->orderBy('id', 'asc')->get();
        $user = User::where('id', decrypt($user_id))->first();

        return view('admin.contact.reply', ['user' => $user, 'contacts' => $contacts, 'page_title' => 'Contact']);
    }

    public function sendReply(Request $request)
    {
        $save = $this->contactService->sendReply($request);

        if ($save['success'] == true) {
            return redirect()->route('admin.contact.index')->with('success', $save['message']);
        }
        return redirect()->route('admin.contact.index')->with('dismiss', $save['message']);
    }

    //************************End Reply ******************

    public function delete($id)
    {
        $contact = ContactUs::where('id', decrypt($id))->first();

        if ($contact) {

            $contact->delete();
            return redirect()->route('admin.contact.index')->with('success', 'message successfully deleted');
        }
        return redirect()->route('admin.contact.index')->with('dismiss', 'Message not found');
    }

    //************************End Delete category ******************


}

