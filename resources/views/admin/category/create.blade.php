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
                        <form role="form" method="POST" action="{{route('admin.category.store')}}"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail1">Name <span class="text-danger">*</span> </label>
                                        <input type="text" class="form-control" name="name" id="exampleInputEmail1"
                                             value="{{old('name')}}">
                                        <span class="text-danger">{{$errors->first('name')}}</span>
                                    </div>


                                    <!--                                 --><?php
                                    //                            function childs($parent_id, $mark)
                                    //                            {
                                    //                                $categories = \App\Models\Category::where('parent_id', $parent_id)->get();
                                    //
                                    //                                if (!empty($categories) && count($categories) > 0) {
                                    //
                                    //                                    foreach ($categories as $category) {
                                    //
                                    //                                        echo '<option value="' . $category->id . '" >' . $mark . $category->name . '<option>';
                                    //
                                    //                                        childs($category->id, $mark.'|--');
                                    //
                                    //                                    }
                                    //                                }
                                    //                            }
                                    //
                                    //                            ?>

                                    <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">Root Category <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-control" name="parent_id"
                                                data-placeholder="Select Category"
                                                style="width: 100%;"
                                                data-dropdown-css-class="select2-purple">
                                            <option value="0">As Parent Category</option>
                                            @if(isset($categories[0]))

                                            @foreach($categories as $category)

                                                    <option value="{{$category->id}}">{{$category->name}} </option>

                                                @endforeach
                                            @endif
                                            {{--{{childs(0, '')}}--}}
                                        </select>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Description <span class="text-danger">*</span>
                                    </label>
                                    <textarea class="textarea" placeholder="Place some text here" name="description"
                                              style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                </div>

                                <div class="form-row">
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

                                    <div class="form-group col-md-4">
                                        <label for="exampleInputFile">Icon</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <label class="custom-file-label" for="icon">Choose
                                                    file</label>
                                                <input type="file" id="icon" name="icon" onchange="putImage(this, 'target2')"/>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <img id="target2">
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
                                    <input class="form-check-input" type="checkbox" name="top_category">
                                        <label class="form-check-label">{{allSettings('category_section') ? allSettings('category_section') : 'Top Category'}}</label>

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
        </div>
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


