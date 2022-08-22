@extends('admin.layouts.master')
@section('page_title', isset($page_title) ? $page_title:'Category')
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
                            <h3 class="card-title">Category</h3>
                        </div>

                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="POST" action="{{route('admin.blog.add')}}"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail1">Title <span class="text-danger">*</span> </label>
                                        <input type="text" class="form-control" name="title" id="exampleInputEmail1"
                                               placeholder="Blog Title">
                                        <span class="text-danger">{{$errors->first('title')}}</span>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail1">Quotation </label>
                                        <input type="text" class="form-control" name="quotation" id="exampleInputEmail1"
                                               placeholder="Quotation">
                                        <span class="text-danger">{{$errors->first('quotation')}}</span>
                                    </div>

                                </div>


                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail1">Description <span class="text-danger">*</span>
                                        </label>
                                        <textarea type="text" class="form-control" name="description"
                                                  id="exampleInputEmail1"> </textarea>
                                        <span class="text-danger">{{$errors->first('description')}}</span>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="exampleInputFile">Image</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <label class="custom-file-label" for="image">Choose
                                                    file</label>
                                                <input type="file" id="image" name="image" onchange="putImage(this, 'target1')"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">

                                        <img id="target1">

                                    </div>

                                </div>


                                <div class="form-check">
                                    <div class="form-group col-md-6">
                                        <input class="form-check-input" type="radio" name="active_status"
                                               value="{{STATUS_ACTIVE}}" checked="">
                                        <label class="form-check-label">Active</label>
                                        <span class="ml-4">
                                            <input class="form-check-input" type="radio" name="active_status"
                                                   value="{{STATUS_INACTIVE}}">
                                            <label class="form-check-label">InActive</label>
                                            </span>
                                    </div>


                                    <div class="form-group col-md-6">
                                    <input class="form-check-input" type="checkbox" name="popular">
                                        <label class="form-check-label">Popular Blog</label>

                                    </div>
                                </div>
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
            fr.onload = function(){
                target.src = fr.result;
            }
            fr.readAsDataURL(src.files[0]);
        }

        function putImage(src, target) {
            let imagesrc = src.getAttribute('id')
            var src = document.getElementById(imagesrc);
            var target = document.getElementById(target);
            target.style.width = '120px';
            target.style.height= '80px';
            showImage(src, target);
        }
    </script>

@endsection


