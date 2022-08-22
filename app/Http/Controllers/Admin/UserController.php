<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Order;
use App\Model\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /*
     * * Get all admin and vendor
     */

    public function index(Request $request)
    {
        if ($request->ajax()) {


            $users = User::all();

            return datatables($users)->editColumn('created_at', function ($orders) {
                return Carbon::parse($orders->created_at)->format('d M, Y');


            })->addColumn('phone_number', function ($users) {
                return '<level class = "btn btn-info">'.$users->phone_number. '</level>';

            })->addColumn('address', function ($users) {
                return $users->address ? $users->address->city . ', ' . $users->address->area : '';

            })->addColumn('orders', function ($users) {
                return $users->successOrder ? count($users->successOrder) : '';

            })->addColumn('transaction', function ($users) {
                return $users->successOrder ?'<level class = "btn btn-warning">'. number_format($users->successOrder->sum('total_payable_amount'),2).' &#2547;'.'</level>' : '';

            })->editColumn('image', function ($users) {
                return '<img src="'.$users->image.'" alt="No Image" width="40" height="40"v/>' ;

            })->addColumn('action', function ($users) {

                $button = '&nbsp;&nbsp;&nbsp;<a type="button" href="javascript:;" data-id="' . $users->id . '" class="send_sms btn btn-info btn-sm "><i class="fas fa-sms"></i></a>';
                $button .= '&nbsp;&nbsp;&nbsp;<a type="button" href="'.route('admin.user.orders',$users->id ).'" class="btn btn-success  btn-sm"><i class="fas fa-eye"></i></a>';

                return $button;

            })
                ->addIndexColumn()
                ->rawColumns(['created_at', 'address', 'orders', 'transaction','image', 'action','phone_number'])
                ->make(true);
        }



        return view('admin.users.users')->with(['menu' => 'Users', 'page_title' => 'All Users']);
    }



    public function userOrders(Request $request, $user_id)
    {
        if ($request->ajax()) {


            $orders = Order::where('user_id', $user_id);

            return datatables($orders)->editColumn('created_at', function ($orders) {
                return Carbon::parse($orders->created_at)->format('d M Y  H:i');


            })->editColumn('shipping_id', function ($orders) {
                return $orders->shipping->city . ', ' . $orders->shipping->area;


            })->editColumn('payment_id', function ($orders) {
                return $orders->payment_id ? '' : 'no payment';

            })->addColumn('payment_method', function ($orders) {
                return $orders->is_order_successful ? ($orders->is_cash_on_delivery ? '<level class = "btn btn-info">COD</level>' : '<level class = "btn btn-success">Online</level>') : '<level class = "btn btn-warning">Pending</level>';

            })->editColumn('order_status', function ($orders) {

                if ($orders->order_status == ORDER_PENDING) {
                    $status = '<level class ="btn btn-warning">' . orderStatus($orders->order_status) . '</level>';

                } elseif ($orders->order_status == ORDER_PROCESSING) {
                    $status = '<level class ="btn btn-info">' . orderStatus($orders->order_status) . '</level>';

                } elseif ($orders->order_status == ORDER_SHIPPED) {
                    $status = '<level class ="btn btn-secondary">' . orderStatus($orders->order_status) . '</level>';

                } elseif ($orders->order_status == ORDER_DELIVERED) {
                    $status = '<level class ="btn btn-success">' . orderStatus($orders->order_status) . '</level>';

                } elseif ($orders->order_status == ORDER_RETURN) {
                    $status = '<level class ="btn btn-danger">' . orderStatus($orders->order_status) . '</level>';
                }

                return $status;

            })->addColumn('action', function ($orders) {

                $button = '<a type="button"  href="' . route('admin.user.orders.invoice', $orders->id) . '" class=" btn btn-info btn-sm"><i class="fas fa-file-invoice"></i></a>';

                return $button;

            })
                ->addIndexColumn()
                ->rawColumns(['created_at', 'shipping_id', 'payment_method', 'order_status', 'action'])
                ->make(true);
        }
        return view('admin.users.orders',['user_id' => $user_id,'menu' => 'Users', 'page_title' => 'User Orders' ]);
    }


    # send sms

    public function sendSms(Request $request)
    {
        if (empty($request->message))
        {
            Alert::error('Oofs', 'Message field can not be empty');
            return redirect()->route('admin.all.users');
        }

        $sendSms = send_sms($request->phone_number, $request->message);
        if ($sendSms)
        {
            return redirect()->route('admin.all.users')->with('success', 'message send successful to '.$request->phone_number);
        }

        Alert::error('Oofs', 'Someting went wrong');
        return redirect()->route('admin.all.users');
    }


    public function userOrdersInvoice($id)
    {
        $order = Order::where('id', $id)->with('order_details')->first();
        $items = $order->order_details;

        return view('admin.users.invoice', ['order' => $order, 'items' => $items, 'menu' => 'Users', 'page_title' => 'User Orders']);
    }

    # lottery

    public function luckyWinner(Request $request)
    {
        if ($request->isMethod('post'))
        {


           $startTime =Carbon::parse($request->date)->startOfDay()->toDateTimeString() ;
            $endTime =Carbon::parse($request->date)->endOfDay()->toDateTimeString() ;

           $user =  User::where('created_at' , '>=', $startTime)->where('created_at' , '<', $endTime)->inRandomOrder()->first();
           $total  =  User::where('created_at' , '>=', $startTime)->where('created_at' , '<', $endTime)->count();

            return view('admin.users.lucky_draw', ['user' => $user, 'total' => $total, 'date' => $request->date] );

        }

        return view('admin.users.lucky_draw');

    }

}
