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
                                    <small
                                        class="float-center">Date: {{date("d M Y", strtotime($expenses->created_at))}}</small>
                                </h4>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- info row -->
                        <hr>
                        <!-- Table row -->
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Expense</th>
                                        <th>Description</th>
                                        <th>Cost</th>
                                    </tr>
                                    </thead>
                                    {{--                                    {{dd($purchase->purchaseDetails)}}--}}
                                    <tbody>
                                    @if(isset($expenses->expenseDetails) && count($expenses->expenseDetails)> 0)
                                        @foreach($expenses->expenseDetails as $exp_details)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$exp_details->expenseHead->name}}</td>
                                                <td>{{$exp_details->description}}</td>
                                                <td>{{$exp_details->value}}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                    <tfooter>
                                        <tr style="background-color: white; border:none; font-weight: bold; padding-top: 5px">
                                            <td></td>
                                            <td></td>
                                            <td>Total:</td>
                                            <td> {{$expenses->total}}</td>
                                        </tr>
                                    </tfooter>
                                </table>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- this row will not appear when printing -->
                        <div class="col-12">
                            <a href="{{route('admin.account.expense')}}" class="btn btn-info"> Back</a>
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
