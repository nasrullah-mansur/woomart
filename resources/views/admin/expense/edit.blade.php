@extends('admin.layouts.master')
@section('page_title', isset($pageSettings['page_title']) ? $pageSettings['page_title']:'Food')
@section('task', isset($pageSettings['task']) ? $pageSettings['task']: 'create' )
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <form role="form" method="POST" action="{{route('admin.foodStoreOrUpdate')}}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Foods</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                           placeholder="Name" value="{{ old('name') }}">
                                </div>


                                <div class="form-group">
                                    <label for="exampleInputEmail1">Category</label>
                                    <select class="form-control" name="category_id" id="category_id">
                                        <option value="{{$food->category_id}}" selected>{{$food->category->name}}</option>
                                        @if(!empty($categories) && count($categories) >0 )
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Sub Category</label>
                                    <select class="form-control" name="subcategory_id" id="subcategory_id">
                                        <option value="{{$food->subcategory_id}}" selected>{{$food->subcategory->name}}</option>


                                    </select>
                                </div>


                                <div class="form-group">
                                    <label for="exampleInputFile">File</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="image"
                                                   id="image">
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                        {{--                                        <div class="input-group-append">--}}
                                        {{--                                            <span class="input-group-text" id="">Upload</span>--}}
                                        {{--                                        </div>--}}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Description</label>
                                    <input type="text" class="form-control" name="description" id="description"
                                           placeholder="Description" value="{{ old('description') }}">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Quantity</label>
                                    <input type="text" class="form-control" name="quantity" id="quantity"
                                           placeholder="Quantity" value="{{ old('quantity') }}">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Price</label>
                                    <input type="text" class="form-control" name="price" id="price"
                                           placeholder="Price" value="{{ old('price') }}">
                                </div>


                                <div class="form-group">
                                    <label for="exampleInputEmail1">Discount</label>
                                    <input type="text" class="form-control" name="discount" id="Discount"
                                           placeholder="discount" value="{{ old('discount') }}">
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status"
                                           value="{{STATUS_ACTIVE}}" checked="">
                                    <label class="form-check-label">Active</label>
                                    <span class="ml-4">
                                            <input class="form-check-input" type="radio" name="status"
                                                   value="{{STATUS_INACTIVE}}">
                                            <label class="form-check-label">InActive</label>
                                            </span>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>

                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

@endsection

@section('post_script')

    <script type="text/javascript">

        $(document).ready(function() {

            $("#category_id").change(function() {

                var category_id = $(this).val();

                $.ajaxSetup({

                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }

                });
                $.ajax({

                    type:"POST",
                    url:'{{URL::route('admin.foodSubCategory')}}',
                    data: {
                        'category_id': category_id,
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(data) {

                        var $subcategory_id = $('#subcategory_id');
                        $subcategory_id.empty();
                        if (data.length <1)
                        {
                            $subcategory_id.append('<option  value= '+ +' >' + 'No subCaegory' + '</option>');

                        }

                        for (var i = 0; i < data.length; i++) {
                            $subcategory_id.append('<option id=' + data[i].id + ' value=' + data[i].id + '>' + data[i].name + '</option>');
                        }
                        //manually trigger a change event for the contry so that the change handler will get triggered
                        $subcategory_id.change();d();
                    }
                });
            });

        });
    </script>

@endsection
