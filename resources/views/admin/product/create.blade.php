@extends('admin.layouts.master')
@section('page_title', isset($page_title) ? $page_title :' Product')
@section('task', isset($task) ? $task: 'create' )

@section ('post_header')
    <link rel="stylesheet" href="{{asset('assets/admin/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection
@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->

                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">@yield('page_title')</h3>
                        </div>

                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="POST" action="{{route('admin.product.store')}}"
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

                                    <div class="col-md-6">
                                        <label>Brand</label>
                                        <select data-placeholder="Select Brand"
                                                style="width: 100%;" name="brand">

                                            <option value="{{null}}">Select Brand</option>

                                        @if(isset($brands[0]))

                                                @foreach($brands as $brand)

                                                    <option value="{{$brand->name}}">{{$brand->name}} </option>

                                                @endforeach
                                            @endif
                                        </select>

                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail1">Category <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-control" name="category_id" id="category_id"
                                                style="width: 100%;"
                                                data-dropdown-css-class="select2-purple">
                                            <option value="{{null}}">Select Category</option>
                                            @if(isset($categories[0]))

                                                @foreach($categories as $category)

                                                    <option value="{{$category->id}}">{{$category->name}} </option>

                                                @endforeach
                                            @endif
                                        </select>

                                        <span class="text-danger">{{$errors->first('category_id')}}</span>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="sub_category_id">SubCategory </label>
                                        <select class="form-control" name="sub_category_id" id="sub_category_id"
                                                style="width: 100%;"
                                                data-dropdown-css-class="select2-purple">

                                        </select>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-md-6">
                                        <label>Colors</label>
                                        <select class="select2bs4" multiple="multiple" data-placeholder="Select Color"
                                                style="width: 100%;" name="color[]">
                                            @if(isset($colors[0]))

                                                @foreach($colors as $color)

                                                    <option value="{{$color->id.'-'.$color->name.'-'.$color->color_code}}">{{$color->name}} </option>

                                                @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label>Sizes</label>
                                        <select class="select2bs4" multiple="multiple" data-placeholder="Select Brand"
                                                style="width: 100%;" name="size[]">
                                            @if(isset($sizes[0]))

                                                @foreach($sizes as $size)

                                                    <option value="{{$size->id.'-'.$size->size}}">{{$size->size}} </option>

                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>


                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail1">Price <span class="text-danger">*</span>
                                        </label>
                                        <input type="number" step="any" class="form-control" name="price" id="price"
                                               value="{{old('price')}}">
                                        <span class="text-danger">{{$errors->first('price')}}</span>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="discount">Discount <small>(%)</small> </label>
                                        <input type="number"  step="any" class="form-control" name="discount" id="discount"
                                               value="{{old('discount')}}">
                                        <span class="text-danger">{{$errors->first('discount')}}</span>
                                    </div>


                                    <div class="form-group col-md-3">
                                        <label for="discount_price">Discount Price</label>
                                        <input type="number"  step="any" class="form-control" name="discount_price"
                                               id="discount_price" readonly>
                                        <span class="text-danger">{{$errors->first('discount_price')}}</span>
                                    </div>
                                </div>


                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">About Product
                                    </label>
                                    <textarea class="textarea" placeholder="Place some text here" name="about_product"
                                              style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{old('about_product')}}</textarea>

                                        <span class="text-danger">{{$errors->first('about_product')}}</span>

                                    </div>

                                    <div class="form-group col-md-6">
                                    <label for="exampleInputEmail1">Description <span class="text-danger">*</span>
                                    </label>
                                    <textarea class="textarea" placeholder="Place some text here" name="description"
                                              style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{old('description')}}</textarea>
                                </div>
                                </div>



                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="exampleInputFile">Primary Image <span class="text-danger">*</span> </label>
                                    <div class="input-group">
                                            <label class="custom-file-label" for="primary_image">Choose
                                                file</label>
                                            <input type="file" id="primary_image" name="primary_image"
                                                   onchange="putImage(this, 'target1')"/>

                                            <span class="text-danger d-block w-100 mt-1 mb-2">{{$errors->first('primary_image')}}</span>

                                    </div>

                                </div>
                                <div class="form-group col-md-2">

                                    <img id="target1">

                                </div>

                                <div class="form-group col-md-4">
                                    <label for="exampleInputFile">Image2 </label>
                                    <div class="input-group">
                                            <label class="custom-file-label" for="image2">Choose
                                                file</label>
                                            <input type="file" id="image2" name="image2"
                                                   onchange="putImage(this, 'target2')"/>
                                        <span class="text-danger d-block w-100 mt-1 mb-2">{{$errors->first('image2')}}</span>

                                    </div>
                                </div>
                                <div class="form-group col-md-2">

                                    <img id="target2">

                                </div>

                            </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="exampleInputFile">Image3 </label>
                                        <div class="input-group">
                                                <label class="custom-file-label" for="image3">Choose
                                                    file</label>
                                                <input type="file" id="image3" name="image3"
                                                       onchange="putImage(this, 'target3')"/>
                                            <span class="text-danger d-block w-100 mt-1 mb-2">{{$errors->first('image3')}}</span>

                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">

                                        <img id="target3">

                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="exampleInputFile">Image4 </label>
                                        <div class="input-group">
                                                <label class="custom-file-label" for="image4">Choose
                                                    file</label>
                                                <input type="file" id="image4" name="image4"
                                                       onchange="putImage(this, 'target4')"/>
                                            <span class="text-danger d-block w-100 mt-1 mb-2">{{$errors->first('image4')}}</span>

                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">

                                        <img id="target4">

                                    </div>
                                </div>


                            <div class="form-check">
                                <div class="form-group col-md-3">
                                    <input class="form-check-input" type="radio" name="active_status"
                                           value="{{STATUS_ACTIVE}}" checked="">
                                    <label class="form-check-label">Active</label>
                                    <span class="ml-4">
                                            <input class="form-check-input" type="radio" name="active_status"
                                                   value="{{STATUS_INACTIVE}}">
                                            <label class="form-check-label">InActive</label>
                                            </span>
                                </div>


                                <div class="form-group col-md-3">
                                    <input class="form-check-input" type="checkbox" name="first_section">
                                    <label class="form-check-label">{{allSettings('first_section') ? allSettings('first_section') : 'Featured Product'}}</label>

                                </div>


                                <div class="form-group col-md-3">
                                    <input class="form-check-input" type="checkbox" name="second_section">
                                    <label class="form-check-label">{{allSettings('second_section') ? allSettings('second_section') : 'Best Selling Products'}}</label>

                                </div>

                                <div class="form-group col-md-3">
                                    <input class="form-check-input" type="checkbox" name="third_section">
                                    <label class="form-check-label">{{allSettings('third_section') ? allSettings('third_section') : 'New Arrivals'}}</label>

                                </div>
                            </div>

                                <div class="form-check">
                                <div class="form-group col-md-3">
                                    <input class="form-check-input" type="checkbox" name="is_new">
                                    <label class="form-check-label">Mark as "New" product</label>

                                </div>


                                <div class="form-group col-md-3">
                                    <input class="form-check-input" type="checkbox" name="is_trending">
                                    <label class="form-check-label">Trending</label>


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



@section('post_script')

    <script src="{{asset('assets/admin/plugins/select2/js/select2.full.min.js')}}"></script>
    <script>

        $(function ()
        {
            $('.select2bs4').select2({
                theme:'bootstrap4'
            })
        } );

        // sub category
        $("#category_id").change(function() {

            var category_id = $(this).val();
            var sub_category =  $('#sub_category_id');

           sub_category.empty();

            $.ajax({
                url: "{{URL::route('admin.product.subcategory')}}",
                method: "POST",
                data: {
                    'category_id' : category_id,
                    '_token' : "{{csrf_token()}}"
                },

                success: function (data) {

                  if(data.length > 0)
                  {
                      sub_category.append('<option value=' + null + '>Select Sub Category</option>');
                      for (var i = 0; i<data.length ; i++)
                      {
                          sub_category.append('<option value=' + data[i].id+ '>'+ data[i].name + '</option>');
                      }

                  } else {
                      sub_category.append('<option value=' + null + '>Select Sub Category</option>');
                  }
                }
            });
        });


        // discount

        $('#discount').on('keyup', function () {

            var price = $('#price').val();
            var discount = $('#discount').val();

            var discount_price = (price * (100 - discount)) /100 ;

            $('#discount_price').val(discount_price);

        })

        // show selected image
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


