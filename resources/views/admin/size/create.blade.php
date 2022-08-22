@extends('admin.layouts.master')
@section('page_title', isset($menu) ? $menu:'Attribute')
@section('task', isset($task) ? $task: 'create' )
@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->

                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">{{isset($page_title) ? $page_title:'Size'}}</h3>
                        </div>

                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="POST" action="{{route('admin.size.store')}}"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">


                                <div class="form-row">

                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail1">Size <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="size"
                                               id="exampleInputEmail1"
                                               value="{{old('size')}}">
                                        <span class="text-danger">{{$errors->first('size')}}</span>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail1">Chest <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="chest"
                                               id="exampleInputEmail1"
                                               value="{{old('chest')}}">
                                        <span class="text-danger">{{$errors->first('chest')}}</span>
                                    </div>

                                </div>

                                <div class="form-row">

                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail1">Shoulder</label>
                                        <input type="text" class="form-control" name="shoulder"
                                               id="exampleInputEmail1"
                                               value="{{old('shoulder')}}">
                                        <span class="text-danger">{{$errors->first('shoulder')}}</span>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail1">Length <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="length"
                                               id="exampleInputEmail1"
                                               value="{{old('length')}}">
                                        <span class="text-danger">{{$errors->first('length')}}</span>
                                    </div>

                                </div>

                                <div class="form-row">

                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail1">Sleeve
                                        </label>
                                        <input type="text" class="form-control" name="sleeve"
                                               id="exampleInputEmail1"
                                               value="{{old('sleeve')}}">
                                        <span class="text-danger">{{$errors->first('sleeve')}}</span>
                                    </div>
                                </div>


                                <div class="card-footer text-center">
                                    <button type="submit" class="btn btn-info">Submit</button>
                                </div>


                            </div>
                        </form>
                        <!-- /.card -->


                    </div>

                    <!--/.col (right) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
    </section>

@endsection




