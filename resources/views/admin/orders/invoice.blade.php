@extends('admin.layouts.master')
@section('post_header')
    <link rel="stylesheet" href="{{asset('SuperAdmin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet"
          href="{{asset('SuperAdmin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endsection
@section('page_title', 'Invoice')
@section('task', 'Details' )

@section('content')
    <section class="content" >
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <!-- Main content -->
                    <div class="invoice p-3 mb-3">

                        <div class="row">
                            <div class="col-6">
                                <img src="{{asset('SuperAdmin/dist/img/Invoice.png')}}" alt="Invoice" style="width:300px;"> <br/>
                                <span style="font-size:20px"><strong>Invoice No : </strong> &nbsp; {{isset($order) ? $order->order_number : ''}} </span> <br/>
                                <span style="font-size:20px"><strong style="margin-right: 56px;">Date</strong><strong>: </strong> &nbsp;{{isset($order) ? \Carbon\Carbon::parse($order->created_at)->format('d M, Y') : ''}}  </span> <br/> <br/>
                            </div>
                            <div class="col-6">
                                <img src="{{asset('SuperAdmin/dist/img/ShopstickLogo.png')}}" alt="Invoice" style="width:200px; float:right;">
                            </div>
                        </div>
                        <!-- /.row -->
                        <div class="row invoice-info " style="margin-top: 40px;">
                            <div class="col-3 invoice-col">
                                Customer Name: <br/> <strong>{{isset($order->user) ? $order->user->name : ''}}</strong> <br/>
                                Customer Mobile No: <br/> <strong> {{isset($order->user) ? $order->user->phone_number : ''}} </strong> <br/>
                                Shipping Method: <br/> <strong> Home Delivery </strong> <br/>
                                Payment Method: <br/> <strong> {{isset($order) &&  $order->is_cash_on_delivery ? 'Cash On Delivery' : 'Online'}} </strong> <br/>
                            </div>
                            <div class="col-sm-9 invoice-col" style="border: 2px solid #dee2e6; padding: 15px; border-radius: 5px;">
                                <div class="row">
                                    @if(isset($order->shipping))

                                    <div class="col-6 invoice-column-1" >
                                        <p class="invoice-column-1-p">Shipping Address</p>

                                        <p> <strong> {{ $order->shipping->name }}</strong> <br/>

                                        @if(isset($order->shipping->details))  {{$order->shipping->details }}
                                        <br> @endif

                                            {{ $order->shipping->area }}
                                            @if(isset($order->shipping->postal_code))
                                                - {{$order->shipping->postal_code }} @endif <br>
                                            {{ $order->shipping->city }} <br>
                                       <strong>Mobile No</strong>:{{ $order->shipping->phone_number }}</p>
                                    </div>


                                    <div class="col-6 invoice-column-2" >
                                        <p class="invoice-column-2-p">Billing Address</p>
                                        <p> <strong> {{ $order->shipping->name }}</strong> <br/>

                                            @if(isset($order->shipping->details))  {{$order->shipping->details }}
                                            <br> @endif

                                            {{ $order->shipping->area }}
                                            @if(isset($order->shipping->postal_code))
                                                - {{$order->shipping->postal_code }} @endif <br>
                                            {{ $order->shipping->city }} <br>
                                            <strong>Mobile No</strong>:{{ $order->shipping->phone_number }}</p>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        <!-- /.row -->
                        <!-- Table row -->
                        <div class="row" style="margin-top: 40px;">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped" id="table1">
                                   <thead>
                                      <tr>
                                        
                                        <th style="background-color: #CCCCCC;  border-top-right-radius: 14px; border-bottom-right-radius: 60px;">
                                          Item Description
                                        </th>
                                        <th style="background-image: url({{asset('SuperAdmin/dist/img/rightArrow.png')}}); text-align: center; background-position: right;
                                          background-repeat: no-repeat; background-size: 30px;" >
                                          Unit Price
                                        </th>
                                        <th style="background-image: url({{asset('SuperAdmin/dist/img/rightArrow.png')}}); text-align: center; background-position: right;
                                          background-repeat: no-repeat; background-size: 30px;" >
                                          Quantity
                                        </th>
                                        <th style="background-image:url({{asset('SuperAdmin/dist/img/rightArrow.png')}}); text-align: center; background-position: right;
                                          background-repeat: no-repeat; background-size: 30px;" >
                                          Total
                                        </th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    @if(isset($order->order_details) && count($order->order_details) > 0)
                                        @foreach($order->order_details as $item)
                                    <tr>
                                        
                                        <td>{{$item->name}}</td>
                                        <td style="text-align: center;">{{$item->product_price}} tk</td>
                                        <td style="text-align: center;">{{$item->quantity}}</td>
                                        <td style="text-align: center;">{{$item->total_amount}} tk</td>
                                    </tr>
                                        @endforeach
                                    @endif

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row" style="margin-top: 20px;">
                            <div class="col-6">
                            </div>
                            <div class="col-6" style="text-align:right; padding-right: 40px; ">

                                <table class="table">
                                    <tbody>
                                        <tr style="font-size: 20px; font-weight: 600;">
                                            <td style="width: 100px;"></td>
                                            <td  style="text-align:left;">Sub Total</td>
                                            <td>:</td>
                                            <td style="text-align:right;">{{isset($order) ? $order->total_order_amount : 0 }} tk</td>
                                        </tr>
                                        <tr style="font-size: 20px; font-weight: 600;">
                                            <td style="width: 100px;"></td>
                                            <td style="text-align:left;">Coupon Discount</td>
                                            <td>:</td>
                                            <td style="text-align:right;">{{isset($order) ? $order->coupon_discount : 0 }} tk</td>
                                        </tr>
                                        <tr style="font-size: 20px; font-weight: 600;">
                                            <td style="width: 100px;"></td>
                                            <td style="text-align:left;">Delivery Fee</td>
                                            <td>:</td>
                                            <td style="text-align:right;">{{isset($order) ? $order->delivery_charge : 0 }}  tk</td>
                                        </tr>
                                        <tr style="font-size: 20px;font-weight: 600;">
                                            <td style="width: 100px;"></td>
                                            <td style="text-align:left;background-color: #CCCCCC;border-top-right-radius: 14px; border-bottom-right-radius: 60px;"> Grand Total</td>
                                            <td>:</td>
                                            <td style="text-align:right;">{{isset($order) ? $order->total_payable_amount : 0 }}  tk</td>
                                        </tr>
                                    </tbody>
                                </table>
                               
                            </div>
                        </div>
                        <!-- /.row -->



                        <!-- this row will not appear when printing -->
                        <div class="row no-print">
                            <div class="col-12">
                                <button class="btn btn-default" onclick="printme()"><i class="fas fa-print"></i> Print</button>
                                <!--
                                <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                                  Payment
                                </button>
                                <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                                  <i class="fas fa-download"></i> Generate PDF
                                </button> -->

                            </div>
                        </div>
                    </div>
                    <!-- /.invoice -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

@endsection

@section('post_script')
    <script type="text/javascript">

            function printme()
            {   
                $(".main-footer").hide();
                window.print();
            }
    </script>
@endsection

