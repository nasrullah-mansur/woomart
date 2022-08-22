@extends('admin.layouts.master')
@section('page_title', isset($menu) ? $menu:'Settings')
@section('task', isset($task) ? $task: 'update' )
@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->

                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">{{isset($page_title) ? $page_title:'General Settings'}}</h3>
                        </div>

                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="POST" action="{{route('admin.general.settings.update')}}"
                              enctype="multipart/form-data">
                            @csrf

                            <div class="card-body">

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail1">Company name <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="company_name"
                                               id="exampleInputEmail1"
                                               value="{{isset($settings['company_name']) ? $settings['company_name'] : ''}}">
                                        <span class="text-danger">{{$errors->first('company_name')}}</span>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail1">About us <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="about_us"
                                               id="exampleInputEmail1"
                                               value="{{isset($settings['about_us']) ? $settings['about_us']: ''}}">
                                        <span class="text-danger">{{$errors->first('about_us')}}</span>
                                    </div>

                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail1">Meta Title <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="title"
                                               id="exampleInputEmail1"
                                               value="{{isset($settings['title']) ? $settings['title'] : ''}}">
                                        <span class="text-danger">{{$errors->first('title')}}</span>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail1">Meta description <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="meta_description"
                                               id="exampleInputEmail1"
                                               value="{{isset($settings['meta_description']) ? $settings['meta_description']: ''}}">
                                        <span class="text-danger">{{$errors->first('meta_description')}}</span>
                                    </div>

                                </div>


                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="exampleInputEmail1">Meta keywords <span class="text-danger">*</span>
                                        </label>
                                        <textarea class="textarea" placeholder="Place some text here" name="meta_keywords"
                                                  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{isset($settings['meta_keywords']) ? $settings['meta_keywords'] : ''}}</textarea>
                                        <span class="text-danger">{{$errors->first('meta_keywords')}}</span>
                                    </div>
                                </div>

                                <div class="form-row">

                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail1">Meta Author
                                        </label>
                                        <input type="text" class="form-control" name="meta_author"
                                               id="exampleInputEmail1"
                                               value="{{isset($settings['meta_author']) ? $settings['meta_author'] : ''}}">
                                        <span class="text-danger">{{$errors->first('meta_author')}}</span>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="exampleInputEmail1">Currency symbols <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="currency"
                                               id="exampleInputEmail1"
                                               value="{{isset($settings['currency']) ? $settings['currency']: ''}}">
                                        <span class="text-danger">{{$errors->first('currency')}}</span>
                                    </div>


                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="exampleInputFile">Fav icon</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <label class="custom-file-label" for="image">Choose
                                                    file</label>
                                                <input type="file" id="image" name="fav_icon"
                                                       onchange="putImage(this, 'target1')"/>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">

                                        <img id="target1" src="{{isset($settings['fav_icon']) ? $settings['fav_icon'] : ''}}" width="120" height="80">

                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="exampleInputFile">Company Logo</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <label class="custom-file-label" for="logo">Choose
                                                    file</label>
                                                <input type="file" id="logo" name="logo"
                                                       onchange="putImage(this, 'target2')"/>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">

                                        <img id="target2" src="{{isset($settings['logo']) ? $settings['logo'] : ''}}" width="120" height="80">

                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail1">Facebook link <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="facebook"
                                               id="exampleInputEmail1"
                                               value="{{isset($settings['facebook']) ? $settings['facebook'] : ''}}">
                                        <span class="text-danger">{{$errors->first('facebook')}}</span>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail1">Twitter link <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="twitter"
                                               id="exampleInputEmail1"
                                               value="{{isset($settings['twitter']) ? $settings['twitter']: ''}}">
                                        <span class="text-danger">{{$errors->first('twitter')}}</span>
                                    </div>

                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail1">Linkedin link <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="linkedin"
                                               id="exampleInputEmail1"
                                               value="{{isset($settings['linkedin']) ? $settings['linkedin'] : ''}}">
                                        <span class="text-danger">{{$errors->first('linkedin')}}</span>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail1">Pinterest link <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="pinterest"
                                               id="exampleInputEmail1"
                                               value="{{isset($settings['pinterest']) ? $settings['pinterest']: ''}}">
                                        <span class="text-danger">{{$errors->first('pinterest')}}</span>
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



