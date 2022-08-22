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
                        <form role="form" method="POST" action="{{route('admin.page.sign_up_sign_in.update')}}"
                              enctype="multipart/form-data">
                            @csrf

                            <div class="card-body">

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail1">Sign Up page title
                                        </label>
                                        <input type="text" class="form-control" name="sign_up_title"
                                               id="exampleInputEmail1"
                                               value="{{isset($settings['sign_up_title']) ? $settings['sign_up_title'] : ''}}">
                                        <span class="text-danger">{{$errors->first('sign_up_title')}}</span>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail1">Why Sign Up (<small>short message around 32 words</small>)
                                        </label>
                                        <input type="text" class="form-control" name="why_sign_up"
                                               id="exampleInputEmail1"
                                               value="{{isset($settings['why_sign_up']) ? $settings['why_sign_up']: ''}}">
                                        <span class="text-danger">{{$errors->first('why_sign_up')}}</span>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail1">Agree for
                                        </label>
                                        <input type="text" class="form-control" name="agree_for"
                                               id="exampleInputEmail1"
                                               value="{{isset($settings['agree_for']) ? $settings['agree_for'] : ''}}">
                                        <span class="text-danger">{{$errors->first('agree_for')}}</span>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="exampleInputFile">Sing Up Image</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <label class="custom-file-label" for="sign_up_image">Choose
                                                    file</label>
                                                <input type="file" id="sign_up_image" name="sign_up_image"
                                                       onchange="putImage(this, 'target')"/>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">

                                        <img id="target" src="{{isset($settings['sign_up_image']) ? $settings['sign_up_image'] : ''}}" alt=" " width="120" height="80">

                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail1">Sign In page title
                                        </label>
                                        <input type="text" class="form-control" name="sign_in_title"
                                               id="exampleInputEmail1"
                                               value="{{isset($settings['sign_in_title']) ? $settings['sign_in_title'] : ''}}">
                                        <span class="text-danger">{{$errors->first('sign_in_title')}}</span>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail1">Welcome message (<small>short message around 32 words</small>)
                                        </label>
                                        <input type="text" class="form-control" name="welcome_message"
                                               id="exampleInputEmail1"
                                               value="{{isset($settings['welcome_message']) ? $settings['welcome_message']: ''}}">
                                        <span class="text-danger">{{$errors->first('welcome_message')}}</span>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputFile">Sing In Image</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <label class="custom-file-label" for="sign_in_image">Choose
                                                    file</label>
                                                <input type="file" id="sign_in_image" name="sign_in_image"
                                                       onchange="putImage(this, 'target2')"/>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">

                                        <img id="target2" src="{{isset($settings['sign_in_image']) ? $settings['sign_in_image'] : ''}}"  alt=" " width="120" height="80">

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



