@extends('admin.layouts.master')
@section('post_header')
    <link rel="stylesheet" href="{{asset('SuperAdmin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet"
          href="{{asset('SuperAdmin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <style>
        a.disabled {
            pointer-events: none;
            color: #ccc;
        }
    </style>

@endsection
@section('page_title', 'Order Details')
@section('task', 'List' )

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- Main content -->
                    <div class="invoice p-3 mb-3">
                        <!-- title row -->
                        <div class="row">

                            <div class="" style="margin: 0; width: 100% !important">
                                <div class="row">
                                    <div class="col-1 float-left">
                                        <div class="float-left">
                                            <i class="fas fa-globe"></i> .
                                        </div>
                                    </div>
                                    <div class="col-9 text-center">
                                        <span>
                                        <strong> Order : {{$order->is_order_successful ? 'Confirmed' : 'Not confirmed'}} </strong>
                                         <br>
                                            Order Status: {{orderStatus($order->order_status)}}
                                        </span>
                                    </div>
                                    <div class="col-2 float-right">
                                        <span>
                                            Order  Date: {{date("d M Y", strtotime($order->created_at))}}
                                        </span>
                                    </div>
                                </div>
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
                                        City : {{$order->shipping->city }}<br>
                                        Area : {{$order->shipping->area }}<br>
                                        @if(isset($order->shipping->postal_code))    Post Code
                                        : {{$order->shipping->postal_code }} <br>@endif
                                        @if(isset($order->shipping->details)) Address : {{$order->shipping->details }}
                                        <br> @endif
                                    @else
                                        <strong class="text-danger"> Address not exists <br></strong>
                                    @endif
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                Invoice No: <strong>{{$order->order_number}}</strong><br>

                                Coupon Code: <strong>{{$order->coupon_code}}</strong><br>
                                Coupon Discount:
                                <strong>{{ isset($order->coupon_code) && $order->coupon_discount == 0.0 && $order->delivery_charge == 0.0  ? 'Free Delivery' : $order->coupon_discount }}</strong><br>
                                Delivery Charge : <strong>{{$order->delivery_charge}}</strong><br>
                                Total Order Amount: <strong>{{$order->total_order_amount}}</strong><br>
                                Total Payable Amount: <strong>{{$order->total_payable_amount}}</strong><br>

                                Expected Delivery date:
                                <strong>{{ isset($order->preferable_date) ? \Carbon\Carbon::parse($order->preferable_date)->format('d M, Y') : ''}}</strong><br>
                                Expected Delivery Time:
                                <strong>{{ isset($order->preferable_time) ? \Carbon\Carbon::parse($order->preferable_time)->format('H:i') : ''}}</strong><br>

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
                                        <th>
                                            Vendor address
                                        </th>
                                        <th> Vendor order status</th>
                                        <th> Admin order status</th>
                                    </tr>
                                    </thead>
                                    {{--                                    {{dd($purchase->purchaseDetails)}}--}}
                                    <tbody>
                                    @if(isset($items) && count($items)> 0)
                                        @foreach($items as $item)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>
                                                    {{$item->name}}
                                                    <small>&nbsp;
                                                        {{$item->brand ? ' ('.$item->brand.')' : ''}}
                                                    </small>
                                                </td>
                                                <td><img src="{{$item->image}}" height="120" width="100"
                                                         alt="not available"></td>
                                                <td>{{$item->unit}}</td>
                                                <td>{{$item->quantity}}</td>
                                                <td>{{$item->product_price}}</td>
                                                <td>{{$item->total_amount}}</td>

                                                <td>
                                                    @if(isset($item->vendor))

                                                        {{$item->vendor->shop_name}} <br>
                                                        {{$item->vendor->owner_name}} <br>
                                                        {{$item->vendor->phone}}
                                                        , {{$item->vendor->email}} <br>
                                                        {{$item->vendor->city }}
                                                        , {{$item->vendor->area }}<br>
                                                        {{$item->vendor->address }} <br>

                                                    @endif
                                                </td>
                                                @if($order->order_status != ORDER_PENDING)
                                                    <td>
                                                        {{vendorOrderStatus($item->vendor_side_status)}}
                                                    </td>
                                                    <td>
                                                        <form action="{{route('admin.order.product.status.update')}}"
                                                              method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            {{--                                                            <?php  $status = adminOrderStatus()?>--}}
                                                            {{--                                                            <?php  $status = adminOrderStatus()?>--}}

                                                            @if($item->vendor_side_status == PRODUCT_SHIPPING_TO_SHOPSTICK)

                                                                <input type="hidden" name="admin_side_status"
                                                                       value="{{PRODUCT_RECEIVED_FROM_SELLER}}">
                                                                <input type="hidden" name="o_details_id"
                                                                       value="{{$item->id}}">

                                                                <strong>Seller has shipped the Product to shopstick,
                                                                    <br>
                                                                    Do you have accepted it ?</strong>
                                                                <br>
                                                                <button class="btn btn-warning"
                                                                        onclick="if(!confirm('Have you received the product from the seller?')){
                 return  false;
             }">
                                                                    Accept from seller
                                                                </button>

                                                            @elseif($item->admin_side_status == PRODUCT_RECEIVED_FROM_SELLER)

                                                                <button type="button" class="btn btn-warning" disabled>
                                                                    Already accepted from seller
                                                                </button>


                                                            @elseif($item->is_received_from_shopstick == false)

                                                                <input type="hidden" name="admin_side_status"
                                                                       value="{{PRODUCT_RECEIVED_FROM_SHOPSTICK}}">
                                                                <input type="hidden" name="o_details_id"
                                                                       value="{{$item->id}}">
                                                            @if(isset($item->product) && $item->product->vendor_id == OWN_VENDOR)
                                                                    <input type="number" step="any" name="packaging_cost" placeholder="Packaging cost">
                                                                    <br>
                                                                <?php

                                                                    $stocks = productStock($item->product->id);

                                                                    ?>
                                                                    <select name="stock_id" id="">
                                                                        <option value="">Select Stock</option>
                                                                        @if(isset($stocks[0]))
                                                                            @foreach($stocks as $stock)
                                                                        <option value="{{$stock->id}}">Qty: {{$stock->quantity - $stock->sold}} - Price {{$stock->purchase_price}}</option>
                                                                            @endforeach
                                                                            @endif
                                                                    </select>  <br>
                                                                @endif

                                                                <strong>Seller does not ship the Product yet, <br>
                                                                    do you want to manage product from shopstick
                                                                    ?</strong>
                                                                <br>
                                                                <button class="btn btn-danger"
                                                                        onclick="if(!confirm('Do you want to manage the product from shopstick ?')){
                 return  false;
             }"
                                                                        class="btn btn-primary">
                                                                    Received from ShopStick
                                                                </button>


                                                            @elseif($item->is_received_from_shopstick == true)
                                                                <button type="button" class="btn btn-primary" disabled>
                                                                    Already accepted from ShopStick
                                                                </button>

                                                            @endif

                                                        </form>

                                                    </td>
                                                @endif

                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td>

                                            <a href="{{route('admin.orders')}}"
                                               class="btn btn-info"> Back</a>
                                        </td>
                                        @if($order->deleted_at)
                                            <td>

                                                <a href="{{route('admin.order.force.delete',encrypt($order->id))}}"
                                                   class="btn btn-danger"
                                                   onclick="if(!confirm('Do you want to permanently Delete the order ?')){
                                                return  false;
             }">Permanently deleted</a>
                                            </td>
                                            <td>

                                                <a href="{{route('admin.order.restore',encrypt($order->id))}}"
                                                   class="btn btn-secondary"
                                                   onclick="if(!confirm('Do you want to restore the order ?')){
                                                return  false;
             }">Restore</a>
                                            </td>

                                        @else
                                            <td>

                                                <a href="{{route('admin.order.delete',encrypt($order->id))}}"
                                                   class="btn btn-danger" onclick="if(!confirm('Do you want to Delete the order ?'))
                                        {
                                               return  false;
                                         }"> Delete </a>
                                            </td>
                                            <td>
                                                @if($order->order_status == ORDER_PROCESSING )

                                                <form action="{{route('admin.order.status.update')}}"
                                                      style="text-align: end" method="post"
                                                      enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="order_id" value="{{$order->id}}">
                                                    <input type="hidden" name="order_status"
                                                           value="{{ORDER_CANCELLED}}">
                                                    <button class="btn btn-warning" onclick="if(!confirm('Do you want to cancel the order ?')){
                 return  false;
             }">Cancel Order
                                                    </button>

                                                </form>
                                                @endif

                                            </td>
                                        <td colspan="6"></td>
                                            <td> <level class="btn btn-secondary float-right"> Order Status</level></td>

                                        @endif
                                    </tr>


                                    <tr>
                                        <td colspan="9"></td>
                                        <td>
                                            <form action="{{route('admin.order.status.update')}}"
                                                  style="text-align: end"
                                                  method="post" enctype="multipart/form-data">
                                                @csrf
                                                <?php  $status = adminOrderStatus()?>

                                                @if($order->order_status == ORDER_PENDING )
                                                    <input type="hidden" name="order_id" value="{{$order->id}}">
                                                    <input type="hidden" name="order_status" value="">
                                                    <button type="button" class="btn btn-info" disabled>Order Pending
                                                    </button>

                                                @elseif($order->order_status == ORDER_PROCESSING)

                                                    <input type="hidden" name="order_id" value="{{$order->id}}">
                                                    <input type="hidden" name="order_status" value="{{ORDER_SHIPPED}}">
                                                    <strong>Order is processing, do you want to shipped it</strong><br>
                                                    <button class="btn btn-info"
                                                            onclick="if(!confirm('Do you want to shipping the order ?')){
                                                return  false;
             }" {{$notReceivedItem ? 'disabled' : ''}}>
                                                        Shipped now
                                                    </button>

                                                @elseif($order->order_status == ORDER_SHIPPED)
                                                    <input type="hidden" name="order_id" value="{{$order->id}}">
                                                    <input type="hidden" name="order_status"
                                                           value="{{ORDER_DELIVERED}}">
                                                    <strong>Order has already Shipped, it is delivered to
                                                        customer?</strong> <br>
                                                    <button class="btn btn-info" onclick="if(!confirm('Has the order delivered to the customer ?')){
                 return  false;
             }">Delivered Confirm
                                                    </button>

                                                @elseif($order->order_status == ORDER_DELIVERED_FAILED)

                                                    <button class="btn btn-danger" disabled>Delivery Failed</button>

                                                @elseif($order->order_status == ORDER_CANCELLED)

                                                    <button class="btn btn-warning" disabled>Order Cancelled</button>

                                                @elseif($order->order_status == ORDER_DELIVERED)

                                                    <input type="hidden" name="order_id" value="{{$item->id}}">
                                                    <input type="hidden" name="order_status"
                                                           value="{{ORDER_DELIVERED}}">
                                                    <strong>Order has already delivered</strong> <br>
                                                    <button class="btn btn-info" disabled>Order completed</button>

                                                @endif


                                            </form>
                                            {{--                            </span>--}}

                                            @if($order->order_status== ORDER_SHIPPED)


                                                <form action="{{route('admin.order.delivery.failed')}}"
                                                      style="text-align: end"
                                                      method="post" enctype="multipart/form-data">
                                                    @csrf

                                                    <input type="hidden" name="order_id" value="{{$order->id}}">
                                                    <input type="hidden" name="order_status"
                                                           value="{{ORDER_DELIVERED_FAILED}}">
                                                    <strong class="text-danger"> Has Customer not received the order
                                                        ?</strong> <br>

                                                    <button class="btn btn-warning" onclick="if(!confirm('Are you sure that order is delivered failed')){
                                 return  false;
                                            }">Delivered Failed
                                                    </button>

                                                </form>
                                            @endif</td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->


                    </div>
                    <!-- /.invoice -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

@endsection
@section('post_script')
    <script>
        function confirmDelete() {
            return confirm('Do you want to delete it ?');

        }

        function confirmUpdateStatus(status) {
            if (!confirm('Do you want Order status update to ' + status + ' ?')) {
                return false;
            }

        }


    </script>
@endsection
