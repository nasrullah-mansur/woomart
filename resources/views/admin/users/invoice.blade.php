@extends('admin.layouts.master')
@section('post_header')
    <link rel="stylesheet" href="{{asset('SuperAdmin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet"
          href="{{asset('SuperAdmin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endsection
@section('page_title', 'Invoice')
@section('task', 'Details' )

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- Main content -->
                    <div class="invoice p-3 mb-3">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <i class="fas fa-globe"></i> .
                                    <small
                                        class="float-right">Order
                                        Date: {{date("d M Y", strtotime($order->created_at))}}</small>
                                </h4>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- info row -->
                        {{--                        {{dd($purchaseDetails)}}--}}
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                Customer
                                <address>
                                    @if(isset($order->user))

                                        Name: <strong>{{$order->user->name}} </strong><br>
                                        Email :  {{$order->user->email}}<br>
                                        Phone:  {{$order->user->phone_number}} <br>
                                    @else
                                        <strong class="text-danger"> Customer not exists <br></strong>
                                    @endif
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                Shipping Address
                                <address>
                                    @if(isset($order->shipping))
                                        Name :<strong>  {{$order->shipping->name }} <br></strong>
                                        Phone : {{$order->shipping->phone_number }}<br>
                                        City : {{$order->shipping->name }}<br>
                                        Area : {{$order->shipping->area }}<br>
                                        Post Code : {{$order->shipping->postal_code }}<br>
                                        Address : {{$order->shipping->details }}<br>
                                    @else
                                        <strong class="text-danger">  Address not exists <br></strong>
                                    @endif
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                Order No: <strong>{{$order->order_number}}</strong><br>
                                Invoice No: <br>
                                {{--                                Invoice No: <b>{{isset($purchase->invoice_no) ? $purchase->invoice_no : ''}}</b><br>--}}
                                <br>
                            </div>
                            <!-- /.col -->
                        </div>

                        <!-- /.row -->
                        <!-- Table row -->
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Product</th>
                                        <th>Image</th>
                                        <th>Unit</th>
                                        <th>Qty</th>
                                        <th>Price/Unit</th>
                                        <th>total price</th>
                                    </tr>
                                    </thead>
                                    {{--                                    {{dd($purchase->purchaseDetails)}}--}}
                                    <tbody>
                                    @if(isset($items) && count($items)> 0)
                                        @foreach($items as $item)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$item->name}}<small>&nbsp;({{$item->brand ? $item->brand : ''}}
                                                        )</small>
                                                <td><img src="{{$item->image}}" height="120" width="100"
                                                         alt="not available"></td>
                                                <td>{{$item->unit}}</td>
                                                <td>{{$item->quantity}}</td>
                                                <td>{{$item->product_price}}</td>
                                                <td>{{$item->total_amount}}</td>

                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <!-- accepted payments column -->
                            <div class="col-6">
                                {{--                                <p class="lead">Payment Methods:</p>--}}
                                {{--                                <img src="../../dist/img/credit/visa.png" alt="Visa">--}}
                                {{--                                <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">--}}
                                {{--                                <img src="../../dist/img/credit/american-express.png" alt="American Express">--}}
                                {{--                                <img src="../../dist/img/credit/paypal2.png" alt="Paypal">--}}

                                {{--                                <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">--}}
                                {{--                                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem--}}
                                {{--                                    plugg--}}
                                {{--                                    dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.--}}
                                {{--                                </p>--}}
                            </div>
                            <!-- /.col -->
                            <div class="col-6">
                                <hr>
                                <div class="table-responsive">
                                    {{--                                    <table class="table">--}}
                                    {{--                                        <tbody>--}}
                                    {{--                                        <tr>--}}
                                    {{--                                            <th style="width:50%">Subtotal:</th>--}}
                                    {{--                                            <td>{{$purchase->total_amount}}</td>--}}
                                    {{--                                        </tr>--}}
                                    {{--                                        <tr>--}}
                                    {{--                                            <th>Paid</th>--}}
                                    {{--                                            <td>{{$purchase->paid_amount}}</td>--}}
                                    {{--                                        </tr>--}}
                                    {{--                                        <tr>--}}
                                    {{--                                            <th>Adjustment</th>--}}
                                    {{--                                            <td>{{$purchase->adjustment}}</td>--}}
                                    {{--                                        </tr>--}}
                                    {{--                                        <tr>--}}
                                    {{--                                            <th>Due</th>--}}
                                    {{--                                            <td>{{$purchase->due_amount}}</td>--}}
                                    {{--                                        </tr>--}}
                                    {{--                                        </tbody>--}}
                                    {{--                                    </table>--}}
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- this row will not appear when printing -->
                        <div class="col-12">
                            <a href="{{route('admin.user.orders', $order->user_id)}}" class="btn btn-info"> Back</a>
                            {{--                            <button type="button" class="btn btn-success float-right"><i class="fas fa-print"></i>Print--}}
                            </button>
                        </div>
                    </div>
                    <!-- /.invoice -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

@endsection
