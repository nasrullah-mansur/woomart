@extends('admin.layouts.master')
@section('page_title', isset($page_title) ? $page_title:'Lucky Draw')
@section('task', isset($task) ? $task: 'reply' )
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->

                    <div class="card card-info">
                        <div class="card-header">
{{--                            <h3 class="card-title">Select winner</h3>--}}
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                    </div>
                        <form role="form" method="POST" action="{{route('admin.lottery')}}"
                              enctype="multipart/form-data">
                            @csrf
                    <!-- /.card-body -->
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-3">
                                            <label for="exampleInputEmail1">select date</label>
                                        </div>
                                        <div class="col-8">
                                            <input type="date" class="form-control"
                                                   name="date"
                                                   id="exampleInputEmail1">


                                        </div>

                                    </div>
                                </div>



                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-3">
                                        </div>
                                        <div class="col-5 text-left">
                                            <button type="submit" class="btn btn-info ">submit
                                            </button>
                                        </div>
                                    </div>
                                </div>


                        </form>

                    @isset($user)
                        <div class="form-group">
                            <div class="row col-4">
                                Date : <strong>{{\Carbon\Carbon::parse($date)->format('d M Y')}} </strong>
                            </div>   <div class="row col-4">
                                Total : <strong>{{$total}} </strong>
                            </div>
                                <address>
                                    @if(isset($user))
                                        Name :<strong>  {{$user->name }} <br></strong>
                                        Phone : {{$user->phone_number }}<br>

                                        @if(isset($user->address))    City : {{$user->address->city }} <br>@endif
                                        @if(isset($user->address))    Area : {{$user->address->area }} <br>@endif
                                        @if(isset($user->address))    Post Code : {{$user->address->postal_code }} <br>@endif
                                        @if(isset($order->address)) Address : {{$user->address->details }}<br> @endif
                                    @else
                                        <strong class="text-danger">  Address not exists <br></strong>
                                    @endif
                                </address>

                        </div>
                        @endif

                    </div>
                    <!-- /.card -->

                    <div class="card-footer">


                    </div>

                    <!--/.col (right) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
    </section>

@endsection
