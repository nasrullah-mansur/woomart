<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Order;
use App\Model\Order_detail;

class ReportController extends Controller
{

    /*
     * * Get different Report from date to target date
     *
     * * * order_status = 1 ; Processing Order
     * * * order_status = 2 ; shipped Order
     * * * order_status = 3 ; Delivered Order
     * * * order_status = 4 ; Cancelled Order
     * * * order_status = 3 ; Not Paid Order
     */

    public function orderReport(Request $request)
    {
        if ($request->isMethod('POST')) {
            $ToDate = ($request->toDate . ' ' . '23:59:59');
            $orderReports = Order::where('order_status', decrypt($request->order_status))->whereBetween('Created_at', array(request('fromDate'), $ToDate))->orderBy('id', 'desc')->with('order_details')->get();
            //dd($orderReports);
            $orderStatus = decrypt($request->order_status);
            return view('admin.report.order', compact('orderReports', 'orderStatus'));

        } else {
            return view('admin.report.order');
        }

    }
}
