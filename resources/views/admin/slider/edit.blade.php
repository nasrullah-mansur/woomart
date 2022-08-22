@extends('admin.layouts.master')
@section('page_title', isset($menu) ? $menu:'Slider')
@section('task', isset($task) ? $task: 'edit' )
@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->

                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">{{isset($page_title) ? $page_title:'Slider'}}</h3>
                        </div>

                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="POST" action="{{route('admin.slider.update')}}"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">


                                <div class="form-row">
                                    <div class="form-group col-md-6">

                                        <label for="exampleInputEmail1">Title <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="title"
                                               id="exampleInputEmail1"
                                               value="{{$slider->title}}">
                                        <span class="text-danger">{{$errors->first('title')}}</span>
                                    </div>



                                    <div class="form-group col-md-3">
                                        <label for="exampleInputFile">Slider Image</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <label class="custom-file-label" for="image">Choose
                                                    file</label>
                                                <input type="file" id="image" name="image" onchange="putImage(this, 'target')"/>

                                            </div>
                                        </div>
                                        <span class="text-danger">{{$errors->first('image')}}</span>

                                    </div>

                                    <div class="form-group col-md-2">
                                        <img id="target"  src="{{$slider->image}}" width="120" height="80"/>

                                    </div>
                                </div>


                                <div class="form-check">
                                    <div class="form-group col-md-6">
                                        <input class="form-check-input" type="radio" name="active_status"
                                               value="{{STATUS_ACTIVE}}" {{isset($slider->active_status) ? 'checked' : ''}}>
                                        <label class="form-check-label">Active</label>
                                        <span class="ml-4">
                                            <input class="form-check-input" type="radio" name="active_status"
                                                   value="{{STATUS_INACTIVE}}" {{isset($slider->active_status) ? '' : 'checked'}}>
                                            <label class="form-check-label">InActive</label>
                                            </span>
                                    </div>

                                </div>

                                <input type="hidden" name="edit_id" value="{{$slider->id}}">
                                <!-- /.card-body -->

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
    </section>

@endsection


@section('post_script')

    <script>
        function showImage(src, target) {
            var fr = new FileReader();
            fr.onload = function () {
                target.src = fr.result;
            }
            fr.readAsDataURL(src.files[0]);
        }

        function putImage(src, target) {
            let imagesrc = src.getAttribute('id')
            var src = document.getElementById(imagesrc);
            var target = document.getElementById(target);
            target.style.width = '120px';
            target.style.height = '80px';
            showImage(src, target);
        }
    </script>

@endsection

