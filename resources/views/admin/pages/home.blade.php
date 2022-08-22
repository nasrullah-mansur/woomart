@extends('admin.layouts.master')
@section('page_title', isset($menu) ? $menu:'Pages')
@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->

                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">{{isset($page_title) ? $page_title:'Sign Up & Sign In'}}</h3>
                        </div>

                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="POST" action="{{route('admin.page.home.update')}}"
                              enctype="multipart/form-data">
                            @csrf

                            <div class="card-body">

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail1">Highlight category section name <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="category_section"
                                               id="exampleInputEmail1"
                                               value="{{isset($settings['category_section']) ? $settings['category_section'] : ''}}">
                                        <span class="text-danger">{{$errors->first('category_section')}}</span>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail1">First section product list name <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="first_section"
                                               id="exampleInputEmail1"
                                               value="{{isset($settings['first_section']) ? $settings['first_section']: ''}}">
                                        <span class="text-danger">{{$errors->first('first_section')}}</span>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail1">Second section product list name <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="second_section"
                                               id="exampleInputEmail1"
                                               value="{{isset($settings['second_section']) ? $settings['second_section'] : ''}}">
                                        <span class="text-danger">{{$errors->first('second_section')}}</span>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail1">Third section product list name <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="third_section"
                                               id="exampleInputEmail1"
                                               value="{{isset($settings['third_section']) ? $settings['third_section'] : ''}}">
                                        <span class="text-danger">{{$errors->first('third_section')}}</span>
                                    </div>

                                </div>

                                <div class=" card-footer text-center">
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



