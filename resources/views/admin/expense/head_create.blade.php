@extends('admin.layouts.master')

@section('page_title', isset($menu) ? $menu :'Coupon')
@section('task', isset($page_title) ? $page_title : 'Coupon Information' )

@section('post_header')
    <link rel="stylesheet" href="{{asset('SuperAdmin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('SuperAdmin/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('SuperAdmin/dist/css/custome.css')}}">
@endsection

@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">

                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-5 col-sm-3 ">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            <i class="fas fa-bullhorn"></i>
                                           Expense Head information
                                        </h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="nav flex-column nav-tabs bg-light" id="vert-tabs-tab"
                                         role="tablist" aria-orientation="vertical">
                                        <a class="nav-link active" id="vert-tabs-home-tab" data-toggle="pill"
                                           href="#vert-tabs-home" role="tab" aria-controls="vert-tabs-home"
                                           aria-selected="true">
                                            <div class="custome_verticle_tab cvt-active cvt-info text-info">
                                                General
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-7 col-sm-9">
                                    <div class="tab-content" id="vert-tabs-tabContent">

 <!-- ****************** General  ****************** -->
                                      <form role="form" method="POST" action="{{route('admin.account.expense.head.addEdit')}}"
                                                  enctype="multipart/form-data">
                                                @csrf

                                        <div class="tab-pane text-left fade active show" id="vert-tabs-home"
                                             role="tabpanel" aria-labelledby="vert-tabs-home-tab">
                                            <div class="card-header">
                                                <h2 class="card-title text-info">
                                                    General
                                                </h2>
                                            </div>


                                                <div class="card-body col-8">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-3"><label for="exampleInputEmail1">Name
                                                                    <span
                                                                        class="text-danger">*</span> </label>
                                                            </div>
                                                            <div class="col-8">
                                                                <input type="text" class="form-control" name="name"
                                                                       id="exampleInputEmail1"
                                                                       placeholder="name"
                                                                       value="{{isset($expense_head)  ? $expense_head->name : null}}">
                                                                <p class="text-danger"> {{$errors->first('name')}}</p>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    @if(isset($expense_head))
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-3">
                                                                    <label for="exampleInputEmail1">Active status <span
                                                                            class="text-danger">*</span> </label>
                                                                </div>
                                                                <div class="col-8">
                                                        <span class="ml-4">

                                                        <input class="form-check-input" type="radio"
                                                               name="active_status"
                                                               value="{{STATUS_ACTIVE}}" {{$expense_head->active_status == STATUS_ACTIVE ? 'checked' : ''}}/>

                                                         <label class="form-check-label">Active</label>
                                                          </span>

                                                                    <span class="ml-4">
                                                        <input class="form-check-input" type="radio"
                                                               name="active_status"
                                                               value="{{STATUS_INACTIVE}}" {{$expense_head->active_status == STATUS_INACTIVE ? 'checked' : ''}}/>
                                                         <label class="form-check-label">InActive</label>

                                                          </span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    @else
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-3">
                                                                    <label for="exampleInputEmail1">Active status <span
                                                                            class="text-danger">*</span> </label>
                                                                </div>
                                                                <div class="col-8">
                                                        <span class="ml-4">

                                                        <input class="form-check-input" type="radio"
                                                               name="active_status"
                                                               value="{{STATUS_ACTIVE}}" checked/>

                                                         <label class="form-check-label">Active</label>
                                                          </span>

                                                                    <span class="ml-4">
                                                        <input class="form-check-input" type="radio"
                                                               name="active_status"
                                                               value="{{STATUS_INACTIVE}}"/>
                                                         <label class="form-check-label">InActive</label>

                                                          </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif

                                                    <div class="form-group">
                                                        <input type="hidden" name="edit_id"
                                                               value="{{isset($expense_head)  ? $expense_head->id : ''}}">
                                                        <div class="row">
                                                            <div class="col-3">
                                                            </div>
                                                            <div class="col-5 text-left">
                                                                <button type="submit" class="btn btn-info ">{{isset($expense_head)  ? 'Update' : 'Save'}}
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                        </div>

                                      </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.card -->

                    </div>

                    <!--/.col (right) -->
                </div>
                <!-- /.row -->
            </div>
        </div><!-- /.container-fluid -->
    </section>

@endsection

@section('post_script')
    <script src="{{asset('SuperAdmin/plugins/select2/js/select2.full.min.js')}}"></script>

    <script type="text/javascript">
        $(function () {
//Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })

        });

    </script>
@endsection


