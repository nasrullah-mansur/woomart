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
                            <h3 class="card-title">{{isset($page_title) ? $page_title:'Error 404'}}</h3>
                        </div>

                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="POST" action="{{route('admin.page.404.update')}}"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputFile">Image</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <label class="custom-file-label" for="image">Choose
                                                    file</label>
                                                <input type="file" id="image" name="image"
                                                       onchange="putImage(this, 'target')"/>

                                                <span class="text-danger">{{$errors->first('image')}}</span>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">

                                        <img id="target" src="{{isset($error404) ? $error404->image : '' }}" width="120" height="80" alt="no image">

                                    </div>
                                </div>


                                <div class=" card-footer text-center">
                                    <button type="submit" class="btn btn-info">Submit</button>
                                </div>


                            </div>
                        </form>
                        <!-- /.card -->
                    </div>


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


