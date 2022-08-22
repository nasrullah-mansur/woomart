@extends('admin.layouts.master')
@section('post_header')
    <link rel="stylesheet" href="{{asset('SuperAdmin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet"
          href="{{asset('SuperAdmin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endsection
@section('page_title', isset($pageSettings['page_title']) ? $pageSettings['page_title']:'Admins')
@section('task', isset($pageSettings['task']) ? $pageSettings['task']: 'List' )
@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{isset($page_title) ? $page_title : 'Account Summery'}}</h3>
        </div>
        <div class="card-body">
            <div class="row">

                <div class="col-md-12">
                    <!-- Widget: user widget style 1 -->
                    <div class="card card-widget widget-user">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div
                            class="widget-user-header bg-secondary">
{{--                            <h3 class="widget-user-username">{{isset($accountSummery) ? $accountSummery->vendor->shop_name : '' }}</h3>--}}
{{--                            <h5 class="widget-user-desc">{{isset($vendorAccountSummery) ? $vendorAccountSummery->vendor->owner_name : ''}}</h5>--}}
                        </div>

                        <div class="card-footer">
                            <div class="row">

                                <div class="col-sm-3 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header">{{isset($accountSummery) ? $accountSummery->total_received : 0}}</h5>
                                        <span class="description-text">Total Received</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-3 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header">{{isset($accountSummery) ? $accountSummery->online_received : 0}}
                                            &#2547;</h5>
                                        <span class="description-text">Online Received</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <div class="col-sm-3 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header">{{isset($accountSummery) ? $accountSummery->cod_received : 0}}
                                            &#2547;</h5>
                                        <span class="description-text">COD Received</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>



                                <div class="col-sm-3 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header">{{isset($accountSummery) ? $accountSummery->order_amount : 0}}
                                            &#2547;</h5>
                                        <span class="description-text">Order Amount</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-sm-3 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header">{{isset($accountSummery) ? $accountSummery->coupon_discount : 0}} &#2547;</h5>
                                        <span class="description-text">Coupon Discount </span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>



                                <div class="col-sm-3 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header">{{isset($accountSummery) ? $accountSummery->delivery_charge : 0}}
                                            &#2547;</h5>
                                        <span class="description-text">Delivery Charge</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>

                                    <div class="col-sm-3 border-right">
                                        <div class="description-block">
                                            <h5 class="description-header">{{isset($accountSummery) ? $accountSummery->commission_amount : 0}}
                                                &#2547;</h5>
                                            <span class="description-text">Commission</span>
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                <div class="col-sm-3 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header">{{isset($accountSummery) ? $accountSummery->seller_amount : 0}}
                                            &#2547;</h5>
                                        <span class="description-text">Seller Amount</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                            </div>
                                <hr>
                            <div class="row">
                                <div class="col-sm-3 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header">{{isset($accountSummery) ? $accountSummery->cash_in_hand : 0}}
                                            &#2547;</h5>
                                        <span class="description-text text-success">Cash in Hand</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>


                                <div class="col-sm-3 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header">{{isset($accountSummery) ? $accountSummery->payable_to_seller : 0}}
                                            &#2547;</h5>
                                        <span class="description-text text-danger">Payable to seller</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>


                                <div class="col-sm-3 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header">{{isset($accountSummery) ? $accountSummery->paid : 0}}
                                            &#2547;</h5>
                                        <span class="description-text text-primary">Paid</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>


                                <div class="col-sm-3 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header">{{isset($accountSummery) ? $accountSummery->payable_to_shopstick : 0}}
                                            &#2547;</h5>
                                        <span class="description-text ">Shopstick amount <br>(manage order)</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                            </div>
                            </div>


                        </div>
                        <!-- /.row -->
                    </div>
{{--                    <a href="{{route('vendor.account.received')}}" class="btn btn-info float-right"><i class="far fa-eye"></i> VIEW DETAILS</a>--}}

                </div>
                <!-- /.widget-user -->
            </div>
            <!-- /.col -->


        </div>
        <!-- /.row -->
    </div>

@endsection
