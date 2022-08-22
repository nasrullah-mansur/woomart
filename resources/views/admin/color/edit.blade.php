@extends('admin.layouts.master')
@section('page_title', isset($menu) ? $menu:'Products')
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
                            <h3 class="card-title">{{isset($page_title) ? $page_title:'Color'}}</h3>
                        </div>

                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="POST" action="{{route('admin.color.update')}}"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">


                                <div class="form-row">
                                    <div class="form-group col-md-6">

                                        <label for="exampleInputEmail1">Name <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="name"
                                               id="exampleInputEmail1"
                                               value="{{$color->name}}">
                                        <span class="text-danger">{{$errors->first('name')}}</span>
                                    </div>


                                    <div class="form-group col-md-6">

                                        <label for="exampleInputEmail1">Color <span class="text-danger">*</span>
                                        </label>
                                        <input class="simple_color form-control" value="{{$color->color_code}}"
                                               type="text" name="color_code"
                                               id="exampleInputEmail1"/>
                                        <span class="text-danger">{{$errors->first('color_code')}}</span>
                                    </div>

                                </div>

                                <input type="hidden" name="edit_id" value="{{$color->id}}">

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



@section('post_script')

    <script src="{{asset('assets/admin/plugins/jquery/jquery.simple-color.min.js')}}"></script>

    <script>
        $(function () {
            $('.simple_color').simpleColor();
        });
    </script>
@endsection


