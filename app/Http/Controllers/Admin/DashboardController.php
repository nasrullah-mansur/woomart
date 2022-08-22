<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\AccountInfo;
use App\Model\Order;
use App\Model\Payment;
use App\Model\Product;
use App\Model\Purchase;
use App\Model\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function home()
    {
//        $info['payments'] = Payment::whereMonth('created_at', Carbon::now()->month)->sum('amount'); // Get all payments of this month
//        $info['products'] = Product::count();       // Get all Products
////        $info['vendors'] = User::where('role', 2)->count(); // Get all vendors, if exists
////        $info['orders'] = Order::where('is_order_successful', true)->orderBy('id', 'desc')->take(7)->get(); // Get Recent 5 orders
//        $info['orders'] = Order::where('is_order_successful', true)->orderBy('id', 'desc')->take(7)->get();
//        $info['users'] = User::orderBy('id', 'desc')->take(8)->get();
//
//        $info['total_orders'] = Order::count();
//        $info['total_products'] = Product::count();
//        $info['total_customer'] = User::count();
//
//        $info['pending_orders'] = $this->orderStatus(ORDER_PENDING);
//        $info['processing_orders'] = $this->orderStatus(ORDER_PROCESSING);
//        $info['shipped_orders'] = $this->orderStatus(ORDER_SHIPPED);
//        $info['delivered_orders'] = $this->orderStatus(ORDER_DELIVERED);
//        $info['cancelled_orders'] = $this->orderStatus(ORDER_CANCELLED);
//        $info['not_paid_orders'] = $this->orderStatus(ORDER_NOT_PAYMENT_YET);
//
//        #total
//        $info['total_purchase'] = number_format(Purchase::where('vendor_id' , OWN_VENDOR)->sum('total_amount'),2);
//
//        $accountInfo = AccountInfo::where('is_managed_by_shopstick', true)->where('delivery_to_customer_date', '!=', null)->get();
//
//        $info['total_sell'] = number_format( $accountInfo->sum('total_amount'), 2);
//        $info['total_packaging_cost'] = number_format($accountInfo->sum('packaging_cost'), 2);
////        $info['total_profit'] =number_format( $accountInfo->sum('total_amount') - $accountInfo->sum('total_purchase_price') - $accountInfo->sum('packaging_cost'), 2);
//        $info['total_profit'] =number_format( $accountInfo->sum('total_amount') - $accountInfo->sum('total_purchase_price'), 2);
//        $info['total_stock'] =number_format( Purchase::where('vendor_id' , OWN_VENDOR)->sum('total_amount') - $accountInfo->sum('total_purchase_price'), 2);
//
//        # just this month
//
//        $info['total_purchase_this_month'] = number_format(Purchase::where('vendor_id' , OWN_VENDOR)->whereMonth('date',Carbon::now()->format('m'))->whereYear('date',Carbon::now()->format('Y'))->sum('total_amount'),2);
//        $accountInfoThisMonth = AccountInfo::where('is_managed_by_shopstick', true)->where('delivery_to_customer_date', '!=', null)->whereMonth('created_at',Carbon::now()->format('m'))->whereYear('created_at',Carbon::now()->format('Y'))->get();
//        $info['total_sell_this_month'] = number_format( $accountInfoThisMonth->sum('total_amount'), 2);
//        $info['total_packaging_cost_this_month'] = number_format($accountInfoThisMonth->sum('packaging_cost'), 2);
//        $info['total_profit_this_month'] =number_format( $accountInfoThisMonth->sum('total_amount') - $accountInfoThisMonth->sum('total_purchase_price'), 2);

//dd($info);
        return view('admin.dashboard.index', ['title' => 'Dashboard', 'menu' => 'Dashboard']);
    }


    protected function orderStatus($order_status)
    {
        try {
            $orders = Order::where('order_status', $order_status)->count('id');
            return $orders;

        } catch (\Exception $e) {
            return false;
        }
    }

    #notification

    public function notification()
    {
        return view('notification.notification');
    }
}
