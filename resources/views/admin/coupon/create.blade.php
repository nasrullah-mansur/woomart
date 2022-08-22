@extends('admin.layouts.master')

@section('page_title', isset($pageSettings) ? $pageSettings['page_title'] :'Coupon')
@section('task', isset($pageSettings) ? $pageSettings['task']:'' )

@section('post_header')
    <link rel="stylesheet" href="{{asset('SuperAdmin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('SuperAdmin/plugins/select2/css/select2.min.css')}}">
@endsection

@section('content')


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">

                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                <!--Left Ber Verticle Tab-->
                                <div class="col-5 col-sm-3 ">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            <i class="fas fa-bullhorn"></i>
                                            Coupon Information
                                        </h3>
                                    </div>
                                    <div class="nav flex-column nav-tabs bg-light" id="vert-tabs-tab"
                                         role="tablist" aria-orientation="vertical">
                                        <a class="nav-link active" id="vert-tabs-general-tab" data-toggle="pill"
                                           href="#vert-tabs-home" role="tab" aria-controls="vert-tabs-home"
                                           aria-selected="true">
                                            <div class="custome_verticle_tab cvt-info text-info">
                                                General
                                            </div>
                                        </a>
                                        <a class="nav-link" id="vert-tabs-restriction-tab" data-toggle="pill"
                                           href="#vert-tabs-profile" role="tab"
                                           aria-controls="vert-tabs-profile" aria-selected="false">
                                            <div class="custome_verticle_tab cvt-danger text-danger">
                                                Usage Restrictions
                                            </div>
                                        </a>

                                    </div>
                                </div>
                                <!--Left Ber Verticle Tab End-->

                                <div class="col-7 col-sm-9">
                                    <form role="form" method="POST" action="{{route('admin.coupon.add')}}"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <div class="tab-content" id="vert-tabs-tabContent">
                                            <!-- *********** General  ****************** -->
                                            <div class="tab-pane text-left fade active show" id="vert-tabs-home"
                                                 role="tabpanel" aria-labelledby="vert-tabs-home-tab">
                                                <div class="card-header">
                                                    <h2 class="card-title text-info">
                                                        General
                                                    </h2>
                                                </div>

                                                <div class="card-body col-8">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-3"><label for="exampleInputEmail1">Name
                                                                    <span
                                                                        class="text-danger">*</span> </label>
                                                            </div>
                                                            <div class="col-8">
                                                                <input type="text" class="form-control" name="name"
                                                                       id="exampleInputEmail1"
                                                                       placeholder="name"
                                                                       value="{{isset($coupon)  ? $coupon->name : old('name')}}">
                                                                <p class="text-danger"> {{$errors->first('name')}}</p>
                                                            </div>
                                                        </div>


                                                    </div>

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-3">
                                                                <label for="exampleInputEmail1">Code <span
                                                                        class="text-danger">*</span> </label>
                                                            </div>
                                                            <div class="col-8">
                                                                <input type="text" class="form-control" name="code"
                                                                       id="exampleInputEmail1"
                                                                       placeholder="code"
                                                                       value="{{isset($coupon)  ? $coupon->code :old('code')}}">
                                                                <p class="text-danger"> {{$errors->first('code')}}</p>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-3">
                                                                <label for="exampleInputEmail1">Discount Type <span
                                                                        class="text-danger">*</span> </label>
                                                            </div>
                                                            <div class="col-8">
                                                                <select class="form-control" name="is_percentage"
                                                                        id="is_percentage">
                                                                    @if(isset($coupon))
                                                                        @if($coupon->is_percentaqge)
                                                                            <option value="{{$coupon->is_percentage}}"
                                                                                    selected>
                                                                                Percentage
                                                                            </option>
                                                                        @else
                                                                            <option value="{{$coupon->is_percentage}}"
                                                                                    selected>
                                                                                Fixed
                                                                            </option>
                                                                        @endif
                                                                    @endif
                                                                    <option value="{{FIXED}}">Fixed</option>
                                                                    <option value="{{PERCENTAGE}}">Percentage</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-3">
                                                                <label for="exampleInputEmail1">Value </label>
                                                            </div>
                                                            <div class="col-8">
                                                                <input type="text" class="form-control" name="value"
                                                                       id="exampleInputEmail1"
                                                                       placeholder="value"
                                                                       value="{{isset($coupon)  ? $coupon->value : old('value')}}">
                                                                <p class="text-danger"> {{$errors->first('value')}}</p>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-3">
                                                                <label for="exampleInputEmail1">Free shipping</label>
                                                            </div>
                                                            <div class="col-8">
                                                                <div class="custom-control custom-checkbox">

                                                                    <input type="checkbox" class="custom-control-input"
                                                                           id="defaultChecked2"
                                                                           name="free_shipping" {{isset($coupon) ? isset($coupon->free_shipping) ? 'checked' : '' : '' }}>

                                                                    <label class="custom-control-label"
                                                                           for="defaultChecked2"> Allow
                                                                        free shipping</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-3">
                                                                <label for="exampleInputEmail1">Start Date</label>
                                                            </div>
                                                            <div class="col-8">
                                                                <input type="date" class="form-control"
                                                                       name="start_date"
                                                                       id="exampleInputEmail1"
                                                                       placeholder="start date"
                                                                       value="{{isset($coupon)  ? $coupon->start_date : ''}}">
                                                                <p class="text-danger"> {{$errors->first('start_date')}}</p>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-3">
                                                                <label for="exampleInputEmail1">End Date <span
                                                                        class="text-danger">*</span> </label>
                                                            </div>
                                                            <div class="col-8">
                                                                <input type="date" class="form-control" name="end_date"
                                                                       id="exampleInputEmail1"
                                                                       value="{{isset($coupon)  ? $coupon->end_date : ''}}">
                                                                <p class="text-danger"> {{$errors->first('end_date')}}</p>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-3">
                                                                <label for="exampleInputEmail1">Active status <span
                                                                        class="text-danger">*</span> </label>
                                                            </div>
                                                            <div class="col-8">
                                                        <span class="ml-4">
                                                        <input class="form-check-input" type="radio"
                                                               name="active_status"
                                                               value="{{STATUS_ACTIVE}}"
                                                               {{ isset($coupon) && $coupon->active_status == STATUS_ACTIVE ? 'checked' : '' }} checked>

                                                         <label class="form-check-label">Active</label>
                                                          </span>

                                                                <span class="ml-4">
                                                        <input class="form-check-input" type="radio"
                                                               name="active_status"
                                                               value="{{STATUS_INACTIVE}}" {{ isset($coupon) && $coupon->active_status == STATUS_INACTIVE ? 'checked' : '' }}>
                                                         <label class="form-check-label">InActive</label>
                                                          </span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <input type="hidden" name="edit_id"
                                                               value="{{isset($coupon)  ? $coupon->id : ''}}">
                                                        <input type="hidden" name="form" value="{{GENERAL}}">
                                                        <div class="row">
                                                            <div class="col-3">
                                                            </div>
                                                            <div class="col-5 text-left">
                                                                <a class="btn btn-info " id="user_restriction"
                                                                   href="javascript:;">Next</a>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <!-- ************ Usage Restrictions  ****************** -->
                                            <div class="tab-pane fade" id="vert-tabs-profile" role="tabpanel"
                                                 aria-labelledby="vert-tabs-profile-tab">
                                                <div class="card-header text-danger">Usage Restrictions</div>

                                                <div class="card-body col-8">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-3">
                                                                <label for="exampleInputEmail1">Minimum Spend </label>
                                                            </div>
                                                            <div class="col-8">
                                                                <input type="number" class="form-control"
                                                                       name="min_spend"
                                                                       id="exampleInputEmail1"
                                                                       value="{{isset($coupon)  ? $coupon->min_spend : 0}}">
                                                                <p class="text-danger"> {{$errors->first('min_spend')}}</p>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    {{--                                                    <div class="form-group">--}}
                                                    {{--                                                      <div class="row">--}}
                                                    {{--                                                      <div class="col-3">--}}
                                                    {{--                                                        <label for="exampleInputEmail1">Maximum Spend</label>--}}
                                                    {{--                                                      </div>--}}
                                                    {{--                                                      <div class="col-8">--}}
                                                    {{--                                                        <input type="number" class="form-control" name="max_spend"--}}
                                                    {{--                                                               id="exampleInputEmail1"--}}
                                                    {{--                                                               value="{{isset($coupon)  ? $coupon->max_spend : 0}}">--}}
                                                    {{--                                                        <p class="text-danger"> {{$errors->first('max_spend')}}</p>--}}
                                                    {{--                                                    </div>--}}
                                                    {{--                                                      </div>--}}
                                                    {{--                                                    </div>--}}

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-3">
                                                                <label for="exampleInputEmail1">Products</label>
                                                            </div>
                                                            <div class="col-8">
                                                                <input type="text" class="form-control"
                                                                       name="product_id">
                                                            </div>
                                                        </div>
                                                    </div>




                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-3">
                                                                <label for="exampleInputEmail1">Category</label>
                                                            </div>
                                                            <div class="col-8">
                                                                <div class="form-group select2-info">
                                                                    <select class="select2" name="category_id[]"
                                                                            multiple="multiple"
                                                                            data-placeholder="Select Category"
                                                                            style="width: 100%;">


                                                                        {{childs(0, '',isset($coupon_categories)==true?$coupon_categories:'')}}


                                                                    </select>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>


                                                    <?php
                                                    function childs($parent_id, $mark, $coupon_categories = null)
                                                    {


                                                        $select = 'selected';
                                                        $categories = \App\Model\Category::where('parent_id', $parent_id)->get();

                                                        if (!empty($categories) && count($categories) > 0) {

                                                            foreach ($categories as $category) {
                                                                $selected = '';
                                                                if ($coupon_categories != null) {
                                                                    //var_dump($category->id,$coupon_categories);
                                                                    $selected = in_array($category->id, $coupon_categories) == true ? $select : "";

                                                                }
                                                                echo '<option value="' . $category->id . '" ' . $selected . '>' . $mark . $category->name . '<option>';
                                                                childs($category->id, $mark . '|--', $coupon_categories);


                                                            }
                                                        }
                                                    }

                                                    ?>


                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-3">
                                                                <label for="exampleInputEmail1">Numbers of coupon  <span
                                                                        class="text-danger">*</span></label>
                                                            </div>
                                                            <div class="col-8">
                                                                <input type="number" class="form-control"
                                                                       name="usage_limit_per_coupon"
                                                                       value="{{isset($coupon)  ? $coupon->usage_limit_per_coupon : 0}}">
                                                                <p class="text-danger"> {{$errors->first('usage_limit_per_coupon')}}</p>
                                                            </div>
                                                        </div>
                                                    </div>


{{--                                                    <div class="form-group">--}}
{{--                                                        <div class="row">--}}
{{--                                                            <div class="col-3">--}}
{{--                                                                <label for="exampleInputEmail1">Usage Limit Per--}}
{{--                                                                    Customer <span--}}
{{--                                                                        class="text-danger">*</span> </label>--}}
{{--                                                            </div>--}}
{{--                                                            <div class="col-8">--}}
{{--                                                                <input type="number" class="form-control"--}}
{{--                                                                       name="usage_limit_per_customer"--}}
{{--                                                                       value="{{isset($coupon)  ? $coupon->usage_limit_per_customer : 0}}">--}}
{{--                                                                <p class="text-danger"> {{$errors->first('usage_limit_per_customer')}}</p>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}

                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-3">
                                                                <input type="hidden" name="edit_id"
                                                                       value="{{isset($coupon)  ? $coupon->id : ''}}">
                                                            </div>
                                                            <div class="col-8">
                                                                <button type="submit"
                                                                        class="btn btn-info">{{isset($coupon)  ?'Update' : 'Submit'}}</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                </div>
                                    </form>

                                </div>

                        </div>
                        <!-- /.card -->
                    </div>

                    <!--/.col (right) -->
                </div>
                <!-- /.row -->
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

@endsection

@section('post_script')
    <script src="{{asset('SuperAdmin/plugins/select2/js/select2.full.min.js')}}"></script>

    <script type="text/javascript">

        //Initialize Select2 Elements
        $(function () {
            $('.select2').select2()

        });


        $(document).on('click', '#user_restriction', function () {

            $("#vert-tabs-restriction-tab").trigger("click");
        });



    </script>
@endsection


