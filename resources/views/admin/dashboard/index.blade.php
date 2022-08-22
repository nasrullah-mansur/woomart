@extends('admin.layouts.master')
@section('page_title', isset($pageSettings['page_title'])? $pageSettings['page_title']:'Dashboard')
@section('task', isset($pageSettings['task'])? $pageSettings['task']: '' )
@section('content')

    <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-money-bill-wave"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total payment</span>
                        <span class="info-box-number">
                  {{isset($info['payments']) ? number_format($info['payments'],2) : 0.00 }}
                  <small></small>
                </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>

            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-cart-arrow-down"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total Orders</span>
                        <span class="info-box-number">
                            {{isset($info['total_orders']) ? $info['total_orders'] : 0}}
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fab fa-shopify"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total Products</span>
                        <span class="info-box-number">
                            {{isset($info['total_products']) ? $info['total_products'] : 0}}
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-white bg-dark elevation-1"><i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Customers</span>
                        <span class="info-box-number">
                            {{ isset($info['total_customer']) ? $info['total_customer'] : 0}}
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-shopping-cart"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total Processing orders</span>
                        <span class="info-box-number">
                            {{isset($info['processing_orders']) ? $info['processing_orders'] : 0}}
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-shipping-fast"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Shipping orders</span>
                        <span class="info-box-number">
                            {{ isset($info['shipped_orders']) ? $info['shipped_orders'] : 0}}
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon  bg-danger elevation-1"><i class="fas fa-shopping-basket"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Cancelled orders</span>
                        <span class="info-box-number">
                            {{isset($info['cancelled_orders']) ? $info['cancelled_orders'] : 0}}
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success  elevation-1"><i class="far fa-handshake"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Delivered orders</span>
                        <span class="info-box-number">
                            {{isset($info['delivered_orders']) ? $info['delivered_orders'] : 0}}
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>

        </div>
        <!-- /.row -->

        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <div class="col-md-8">
                <!-- /.card -->
                <div class="row">
                    <div class="col-md-12">

                        <!-- TABLE: LATEST ORDERS -->
                        <div class="card">
                            <div class="card-header border-transparent">
                                <h3 class="card-title">Latest Orders</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table m-0">
                                        <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Order Status</th>
                                            <th>Payment Status</th>
                                            <th>Address</th>
                                            <th>Time</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(isset($info['orders']) && count($info['orders'])  > 0)
                                            @foreach($info['orders'] as $order)
                                                <tr>
                                                    <td>
                                                        <a href="{{route('admin.order.details', encrypt($order->id))}}">{{$order->order_number}}</a>
                                                    </td>

                                                    <td>
                                                        @if($order->order_status == ORDER_PENDING)
                                                            <span class="badge badge-info">Pending</span>
                                                        @elseif($order->order_status == ORDER_PROCESSING)
                                                            <span class="badge badge-warning">Processing</span>

                                                        @elseif($order->order_status == ORDER_SHIPPED)
                                                            <span class="badge badge-secondary">Shipping</span>
                                                        @elseif($order->order_status == ORDER_DELIVERED)
                                                            <span class="badge badge-success">Delivered</span>
                                                        @elseif($order->order_status == ORDER_RETURN)
                                                            <span class="badge badge-danger">Delivered</span>
                                                        @elseif($order->order_status == ORDER_DELIVERED_FAILED)
                                                            <span class="badge badge-danger">Delivered Failed</span>
                                                        @elseif($order->order_status == ORDER_CANCELLED)
                                                            <span class="badge badge-danger">Cancelled</span>
                                                        @endif

                                                    </td>
                                                    <td>
                                                        @if($order->is_order_successful)
                                                            @if($order->is_cash_on_delivery)
                                                                <span class="badge badge-info">COD</span>
                                                            @else
                                                                <span class="badge badge-secondary">Online</span>

                                                            @endif
                                                        @else
                                                            <span class="badge badge-warning">Pending</span>

                                                        @endif

                                                    </td>
                                                    <td>
                                                        @if(isset($order->shipping))
                                                            <address>
                                                                <span class="badge badge-info">  {{$order->shipping->name.','.$order->shipping->phone_number}}</span>
                                                                <br>
                                                                <span class="badge badge-secondary">{{$order->shipping->city.','.$order->shipping->area}}</span>

                                                            </address>
                                                            @endif
                                                    </td>

                                                    <td>{{\Carbon\Carbon::parse($order->created_at)->diffForHumans()}}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                <a href="{{route('admin.orders')}}" class="btn btn-sm btn-secondary float-right">View
                                    All
                                    Orders</a>
                            </div>
                            <!-- /.card-footer -->
                        </div>
                        <!-- /.card -->
                        <!-- DIRECT CHAT -->
{{--                        <div class="card direct-chat direct-chat-warning">--}}
{{--                            <div class="card-header">--}}
{{--                                <h3 class="card-title">Direct Chat</h3>--}}

{{--                                <div class="card-tools">--}}
{{--                                    <span data-toggle="tooltip" title="3 New Messages"--}}
{{--                                          class="badge badge-warning">3</span>--}}
{{--                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i--}}
{{--                                            class="fas fa-minus"></i>--}}
{{--                                    </button>--}}
{{--                                    <button type="button" class="btn btn-tool" data-toggle="tooltip" title="Contacts"--}}
{{--                                            data-widget="chat-pane-toggle">--}}
{{--                                        <i class="fas fa-comments"></i></button>--}}
{{--                                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i--}}
{{--                                            class="fas fa-times"></i>--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <!-- /.card-header -->--}}
{{--                            <div class="card-body">--}}
{{--                                <!-- Conversations are loaded here -->--}}
{{--                                <div class="direct-chat-messages">--}}
{{--                                    <!-- Message. Default to the left -->--}}
{{--                                    <div class="direct-chat-msg">--}}
{{--                                        <div class="direct-chat-infos clearfix">--}}
{{--                                            <span class="direct-chat-name float-left">Alexander Pierce</span>--}}
{{--                                            <span class="direct-chat-timestamp float-right">23 Jan 2:00 pm</span>--}}
{{--                                        </div>--}}
{{--                                        <!-- /.direct-chat-infos -->--}}
{{--                                        <img class="direct-chat-img" src="dist/img/user1-128x128.jpg"--}}
{{--                                             alt="message user image">--}}
{{--                                        <!-- /.direct-chat-img -->--}}
{{--                                        <div class="direct-chat-text">--}}
{{--                                            Is this template really for free? That's unbelievable!--}}
{{--                                        </div>--}}
{{--                                        <!-- /.direct-chat-text -->--}}
{{--                                    </div>--}}
{{--                                    <!-- /.direct-chat-msg -->--}}

{{--                                    <!-- Message to the right -->--}}
{{--                                    <div class="direct-chat-msg right">--}}
{{--                                        <div class="direct-chat-infos clearfix">--}}
{{--                                            <span class="direct-chat-name float-right">Sarah Bullock</span>--}}
{{--                                            <span class="direct-chat-timestamp float-left">23 Jan 2:05 pm</span>--}}
{{--                                        </div>--}}
{{--                                        <!-- /.direct-chat-infos -->--}}
{{--                                        <img class="direct-chat-img" src="dist/img/user3-128x128.jpg"--}}
{{--                                             alt="message user image">--}}
{{--                                        <!-- /.direct-chat-img -->--}}
{{--                                        <div class="direct-chat-text">--}}
{{--                                            You better believe it!--}}
{{--                                        </div>--}}
{{--                                        <!-- /.direct-chat-text -->--}}
{{--                                    </div>--}}
{{--                                    <!-- /.direct-chat-msg -->--}}

{{--                                    <!-- Message. Default to the left -->--}}
{{--                                    <div class="direct-chat-msg">--}}
{{--                                        <div class="direct-chat-infos clearfix">--}}
{{--                                            <span class="direct-chat-name float-left">Alexander Pierce</span>--}}
{{--                                            <span class="direct-chat-timestamp float-right">23 Jan 5:37 pm</span>--}}
{{--                                        </div>--}}
{{--                                        <!-- /.direct-chat-infos -->--}}
{{--                                        <img class="direct-chat-img" src="dist/img/user1-128x128.jpg"--}}
{{--                                             alt="message user image">--}}
{{--                                        <!-- /.direct-chat-img -->--}}
{{--                                        <div class="direct-chat-text">--}}
{{--                                            Working with AdminLTE on a great new app! Wanna join?--}}
{{--                                        </div>--}}
{{--                                        <!-- /.direct-chat-text -->--}}
{{--                                    </div>--}}
{{--                                    <!-- /.direct-chat-msg -->--}}

{{--                                    <!-- Message to the right -->--}}
{{--                                    <div class="direct-chat-msg right">--}}
{{--                                        <div class="direct-chat-infos clearfix">--}}
{{--                                            <span class="direct-chat-name float-right">Sarah Bullock</span>--}}
{{--                                            <span class="direct-chat-timestamp float-left">23 Jan 6:10 pm</span>--}}
{{--                                        </div>--}}
{{--                                        <!-- /.direct-chat-infos -->--}}
{{--                                        <img class="direct-chat-img" src="dist/img/user3-128x128.jpg"--}}
{{--                                             alt="message user image">--}}
{{--                                        <!-- /.direct-chat-img -->--}}
{{--                                        <div class="direct-chat-text">--}}
{{--                                            I would love to.--}}
{{--                                        </div>--}}
{{--                                        <!-- /.direct-chat-text -->--}}
{{--                                    </div>--}}
{{--                                    <!-- /.direct-chat-msg -->--}}

{{--                                </div>--}}
{{--                                <!--/.direct-chat-messages-->--}}

{{--                                <!-- Contacts are loaded here -->--}}
{{--                                <div class="direct-chat-contacts">--}}
{{--                                    <ul class="contacts-list">--}}
{{--                                        <li>--}}
{{--                                            <a href="#">--}}
{{--                                                <img class="contacts-list-img" src="dist/img/user1-128x128.jpg">--}}

{{--                                                <div class="contacts-list-info">--}}
{{--                              <span class="contacts-list-name">--}}
{{--                                Count Dracula--}}
{{--                                <small class="contacts-list-date float-right">2/28/2015</small>--}}
{{--                              </span>--}}
{{--                                                    <span class="contacts-list-msg">How have you been? I was...</span>--}}
{{--                                                </div>--}}
{{--                                                <!-- /.contacts-list-info -->--}}
{{--                                            </a>--}}
{{--                                        </li>--}}
{{--                                        <!-- End Contact Item -->--}}
{{--                                        <li>--}}
{{--                                            <a href="#">--}}
{{--                                                <img class="contacts-list-img" src="dist/img/user7-128x128.jpg">--}}

{{--                                                <div class="contacts-list-info">--}}
{{--                              <span class="contacts-list-name">--}}
{{--                                Sarah Doe--}}
{{--                                <small class="contacts-list-date float-right">2/23/2015</small>--}}
{{--                              </span>--}}
{{--                                                    <span class="contacts-list-msg">I will be waiting for...</span>--}}
{{--                                                </div>--}}
{{--                                                <!-- /.contacts-list-info -->--}}
{{--                                            </a>--}}
{{--                                        </li>--}}
{{--                                        <!-- End Contact Item -->--}}
{{--                                        <li>--}}
{{--                                            <a href="#">--}}
{{--                                                <img class="contacts-list-img" src="dist/img/user3-128x128.jpg">--}}

{{--                                                <div class="contacts-list-info">--}}
{{--                              <span class="contacts-list-name">--}}
{{--                                Nadia Jolie--}}
{{--                                <small class="contacts-list-date float-right">2/20/2015</small>--}}
{{--                              </span>--}}
{{--                                                    <span class="contacts-list-msg">I'll call you back at...</span>--}}
{{--                                                </div>--}}
{{--                                                <!-- /.contacts-list-info -->--}}
{{--                                            </a>--}}
{{--                                        </li>--}}
{{--                                        <!-- End Contact Item -->--}}
{{--                                        <li>--}}
{{--                                            <a href="#">--}}
{{--                                                <img class="contacts-list-img" src="dist/img/user5-128x128.jpg">--}}

{{--                                                <div class="contacts-list-info">--}}
{{--                              <span class="contacts-list-name">--}}
{{--                                Nora S. Vans--}}
{{--                                <small class="contacts-list-date float-right">2/10/2015</small>--}}
{{--                              </span>--}}
{{--                                                    <span class="contacts-list-msg">Where is your new...</span>--}}
{{--                                                </div>--}}
{{--                                                <!-- /.contacts-list-info -->--}}
{{--                                            </a>--}}
{{--                                        </li>--}}
{{--                                        <!-- End Contact Item -->--}}
{{--                                        <li>--}}
{{--                                            <a href="#">--}}
{{--                                                <img class="contacts-list-img" src="dist/img/user6-128x128.jpg">--}}

{{--                                                <div class="contacts-list-info">--}}
{{--                              <span class="contacts-list-name">--}}
{{--                                John K.--}}
{{--                                <small class="contacts-list-date float-right">1/27/2015</small>--}}
{{--                              </span>--}}
{{--                                                    <span class="contacts-list-msg">Can I take a look at...</span>--}}
{{--                                                </div>--}}
{{--                                                <!-- /.contacts-list-info -->--}}
{{--                                            </a>--}}
{{--                                        </li>--}}
{{--                                        <!-- End Contact Item -->--}}
{{--                                        <li>--}}
{{--                                            <a href="#">--}}
{{--                                                <img class="contacts-list-img" src="dist/img/user8-128x128.jpg">--}}

{{--                                                <div class="contacts-list-info">--}}
{{--                              <span class="contacts-list-name">--}}
{{--                                Kenneth M.--}}
{{--                                <small class="contacts-list-date float-right">1/4/2015</small>--}}
{{--                              </span>--}}
{{--                                                    <span class="contacts-list-msg">Never mind I found...</span>--}}
{{--                                                </div>--}}
{{--                                                <!-- /.contacts-list-info -->--}}
{{--                                            </a>--}}
{{--                                        </li>--}}
{{--                                        <!-- End Contact Item -->--}}
{{--                                    </ul>--}}
{{--                                    <!-- /.contacts-list -->--}}
{{--                                </div>--}}
{{--                                <!-- /.direct-chat-pane -->--}}
{{--                            </div>--}}
{{--                            <!-- /.card-body -->--}}
{{--                            <div class="card-footer">--}}
{{--                                <form action="#" method="post">--}}
{{--                                    <div class="input-group">--}}
{{--                                        <input type="text" name="message" placeholder="Type Message ..."--}}
{{--                                               class="form-control">--}}
{{--                                        <span class="input-group-append">--}}
{{--                          <button type="button" class="btn btn-warning">Send</button>--}}
{{--                        </span>--}}
{{--                                    </div>--}}
{{--                                </form>--}}
{{--                            </div>--}}
{{--                            <!-- /.card-footer-->--}}
{{--                        </div>--}}
                        <!--/.direct-chat -->
                    </div>
                    <!-- /.col -->


                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.col -->

            <div class="col-md-4">
                <!-- Info Boxes Style 2 -->
                <a href="#">
                <div class="info-box mb-3 bg-warning">
                    <span class="info-box-icon"><i class="fas fa-tag"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total Purchase</span>
                        <span class="info-box-number"> {{isset($info['total_purchase_this_month']) ? $info['total_purchase_this_month'] : 0}} </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                </a>
                <!-- /.info-box -->
                <a href="{{route('admin.account.info')}}">
                <div class="info-box mb-3 bg-success">
                    <span class="info-box-icon"><i class="fab fa-sellcast"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total Sell</span>
                        <span class="info-box-number">{{isset($info['total_sell_this_month']) ? $info['total_sell_this_month'] : 0}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                </a>
                <!-- /.info-box -->
                {{--<div class="info-box mb-3 bg-danger">--}}
                    {{--<span class="info-box-icon"><i class="fas fa-tape"></i></span>--}}

                    {{--<div class="info-box-content">--}}
                        {{--<span class="info-box-text">Packaging Cost</span>--}}
                        {{--<span class="info-box-number">{{$info['total_packaging_cost_this_month']}}</span>--}}
                    {{--</div>--}}
                    {{--<!-- /.info-box-content -->--}}
                {{--</div>  <!-- /.info-box -->--}}

                <!-- /.info-box -->
                <a href="{{route('admin.account.info')}}">
                <div class="info-box mb-3 bg-info">
                    <span class="info-box-icon"><i class="fas fa-dollar-sign"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Total Profit</span>
                        <span class="info-box-number">{{isset($info['total_profit_this_month']) ? $info['total_profit_this_month'] : 0 }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                </a>
                <!-- /.info-box -->
                <div class="col-md-12">
                    <!-- USERS LIST -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Latest Members</h3>

                            <div class="card-tools">
                                <span class="badge badge-danger">8 New Members</span>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                                        class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <ul class="users-list clearfix">
                                @if(isset($info['users'][0]))
                                    @foreach($info['users'] as $user)
                                <li>
                                    @if($user->image != asset(path_user_image()))
                                    <img src="{{$user->image}}" width="40" height="45" alt="User Image">
                                    @else
                                    <img src="{{asset('docs\images/user.jpg')}}" width="40" height="45" alt="User Image">
                                    @endif
                                    <a class="users-list-name" href="#">{{$user->name}}</a>
                                    <span class="users-list-date">{{\Carbon\Carbon::parse($user->created_at)->diffForHumans()}}</span>
                                </li>
                                    @endforeach
                                    @endif

                            </ul>
                            <!-- /.users-list -->
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer text-center">
                            <a href="{{route('admin.all.users')}}">View All Users</a>
                        </div>
                        <!-- /.card-footer -->
                    </div>
                    <!--/.card -->
                </div>

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Total Report</h5>
{{--                        <div class="card-tools">--}}
{{--                            <button type="button" class="btn btn-tool" data-card-widget="collapse">--}}
{{--                                <i class="fas fa-minus"></i>--}}
{{--                            </button>--}}
{{--                            <div class="btn-group">--}}
{{--                                <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">--}}
{{--                                    <i class="fas fa-wrench"></i>--}}
{{--                                </button>--}}
{{--                                <div class="dropdown-menu dropdown-menu-right" role="menu">--}}
{{--                                    <a href="#" class="dropdown-item">Action</a>--}}
{{--                                    <a href="#" class="dropdown-item">Another action</a>--}}
{{--                                    <a href="#" class="dropdown-item">Something else here</a>--}}
{{--                                    <a class="dropdown-divider"></a>--}}
{{--                                    <a href="#" class="dropdown-item">Separated link</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <button type="button" class="btn btn-tool" data-card-widget="remove">--}}
{{--                                <i class="fas fa-times"></i>--}}
{{--                            </button>--}}
{{--                        </div>--}}
                    </div>
{{--                    <!-- /.card-header -->--}}
{{--                    <div class="card-body">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-md-8">--}}
{{--                                <p class="text-center">--}}
{{--                                    <strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>--}}
{{--                                </p>--}}
{{--                                <div class="chart">--}}
{{--                                    <!-- Sales Chart Canvas -->--}}
{{--                                    <canvas id="salesChart" height="180" style="height: 180px;"></canvas>--}}
{{--                                </div>--}}
{{--                                <!-- /.chart-responsive -->--}}
{{--                            </div>--}}
{{--                            <!-- /.col -->--}}
{{--                            <div class="col-md-4">--}}
{{--                                <p class="text-center">--}}
{{--                                    <strong>Goal Completion</strong>--}}
{{--                                </p>--}}

{{--                                <div class="progress-group">--}}
{{--                                    Add Products to Cart--}}
{{--                                    <span class="float-right"><b>160</b>/200</span>--}}
{{--                                    <div class="progress progress-sm">--}}
{{--                                        <div class="progress-bar bg-primary" style="width: 80%"></div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <!-- /.progress-group -->--}}

{{--                                <div class="progress-group">--}}
{{--                                    Complete Purchase--}}
{{--                                    <span class="float-right"><b>310</b>/400</span>--}}
{{--                                    <div class="progress progress-sm">--}}
{{--                                        <div class="progress-bar bg-danger" style="width: 75%"></div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <!-- /.progress-group -->--}}
{{--                                <div class="progress-group">--}}
{{--                                    <span class="progress-text">Visit Premium Page</span>--}}
{{--                                    <span class="float-right"><b>480</b>/800</span>--}}
{{--                                    <div class="progress progress-sm">--}}
{{--                                        <div class="progress-bar bg-success" style="width: 60%"></div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <!-- /.progress-group -->--}}
{{--                                <div class="progress-group">--}}
{{--                                    Send Inquiries--}}
{{--                                    <span class="float-right"><b>250</b>/500</span>--}}
{{--                                    <div class="progress progress-sm">--}}
{{--                                        <div class="progress-bar bg-warning" style="width: 50%"></div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <!-- /.progress-group -->--}}
{{--                            </div>--}}
{{--                            <!-- /.col -->--}}
{{--                        </div>--}}
{{--                        <!-- /.row -->--}}
{{--                    </div>--}}
                    <!-- ./card-body -->
                    <!-- /.card-footer -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!--/. container-fluid -->
@endsection
