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
                            <h3 class="card-title">{{isset($page_title) ? $page_title:'About Us'}}</h3>
                        </div>

                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="POST" action="{{route('admin.page.about_us.update')}}"
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

                                        <img id="target" src="{{isset($about_us) ? $about_us->image : '' }}" width="120" height="80">

                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="exampleInputEmail1">About Us <span class="text-danger">*</span>
                                        </label>
                                        <textarea class="textarea" placeholder="Place some text here" name="about_us"
                                                  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{isset($about_us) ? $about_us->about_us : ''}}</textarea>
                                        <span class="text-danger">{{$errors->first('about_us')}}</span>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail1"> {!! isset($about_us) ? $about_us->middle_section_title.' section title' : 'Our Mission & Vision section title' !!} <span class="text-danger">*</span>
                                        </label>

                                        <textarea class="textarea" placeholder="Place some text here" name="middle_section_title"
                                                  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{isset($about_us) ? $about_us->middle_section_title : ''}}</textarea>

                                        <span class="text-danger">{{$errors->first('middle_section_title')}}</span>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail1"> {!! isset($about_us) ? $about_us->middle_section_title.' description' : 'Our Mission & Vision description' !!} <span class="text-danger">*</span>
                                        </label>

                                        <textarea class="textarea" placeholder="Place some text here" name="middle_section_description"
                                                  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{isset($about_us) ? $about_us->middle_section_description : ''}}</textarea>

                                        <span class="text-danger">{{$errors->first('middle_section_description')}}</span>
                                    </div>
                                </div>

                                <!--our mission and vision section1 start-->
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputFile">{!!  isset($about_us) ? $about_us->middle_section_title.' section1 icon' : 'Our Mission & Vision section1 icon' !!} </label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <label class="custom-file-label" for="middle_section_content1_icon">Choose
                                                    file</label>
                                                <input type="file" id="middle_section_content1_icon" name="middle_section_content1_icon"
                                                       onchange="putImage(this, 'target2')"/>

                                                <span class="text-danger">{{$errors->first('middle_section_content1_icon')}}</span>


                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">

                                        <img id="target2" src="{{isset($about_us) ? $about_us->middle_section_content1_icon : '' }}" width="120" height="80">

                                    </div>
                                </div>


                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail1">{!!  isset($about_us) ? $about_us->middle_section_title.' section1 title' : 'Our Mission & Vision section1 title' !!} <span class="text-danger">*</span>
                                        </label>

                                        <textarea class="textarea" placeholder="Place some text here" name="middle_section_content1_title"
                                                  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{isset($about_us) ? $about_us->middle_section_content1_title : ''}}</textarea>

                                        <span class="text-danger">{{$errors->first('middle_section_content1_title')}}</span>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail1"> {!!  isset($about_us) ? $about_us->middle_section_title.' section1 description' : 'Our Mission & Vision section1 description' !!} <span class="text-danger">*</span>
                                        </label>

                                        <textarea class="textarea" placeholder="Place some text here" name="middle_section_content1_description"
                                                  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{isset($about_us) ? $about_us->middle_section_content1_description : ''}}</textarea>

                                        <span class="text-danger">{{$errors->first('middle_section_content1_description')}}</span>
                                    </div>
                                </div>
                                <!--our mission and vision section1 end-->


                                <!--our mission and vision section2 start-->
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputFile">{!!  isset($about_us) ? $about_us->middle_section_title.' section2 icon' : 'Our Mission & Vision section2 icon' !!} </label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <label class="custom-file-label" for="middle_section_content2_icon">Choose
                                                    file</label>
                                                <input type="file" id="middle_section_content2_icon" name="middle_section_content2_icon"
                                                       onchange="putImage(this, 'target3')"/>

                                                <span class="text-danger">{{$errors->first('middle_section_content2_icon')}}</span>


                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">

                                        <img id="target3" src="{{isset($about_us) ? $about_us->middle_section_content2_icon : '' }}" width="120" height="80">

                                    </div>
                                </div>


                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail1"> {!!  isset($about_us) ? $about_us->middle_section_title.' section2 title' : 'Our Mission & Vision section2 title' !!} <span class="text-danger">*</span>
                                        </label>

                                        <textarea class="textarea" placeholder="Place some text here" name="middle_section_content2_title"
                                                  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{isset($about_us) ? $about_us->middle_section_content2_title : ''}}</textarea>

                                        <span class="text-danger">{{$errors->first('middle_section_content2_title')}}</span>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail1"> {!!  isset($about_us) ? $about_us->middle_section_title.' section2 description' : 'Our Mission & Vision section2 description' !!} <span class="text-danger">*</span>
                                        </label>

                                        <textarea class="textarea" placeholder="Place some text here" name="middle_section_content2_description"
                                                  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{isset($about_us) ? $about_us->middle_section_content2_description : ''}}</textarea>

                                        <span class="text-danger">{{$errors->first('middle_section_content2_description')}}</span>
                                    </div>
                                </div>
                                <!--our mission and vision section2 end-->


                                <!--our mission and vision section3 start-->
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputFile">{!!  isset($about_us) ? $about_us->middle_section_title.' section3 icon' : 'Our Mission & Vision section3 icon' !!} </label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <label class="custom-file-label" for="middle_section_content3_icon">Choose
                                                    file</label>
                                                <input type="file" id="middle_section_content3_icon" name="middle_section_content3_icon"
                                                       onchange="putImage(this, 'target4')"/>

                                                <span class="text-danger">{{$errors->first('middle_section_content3_icon')}}</span>


                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">

                                        <img id="target4" src="{{isset($about_us) ? $about_us->middle_section_content3_icon : '' }}" width="120" height="80">

                                    </div>
                                </div>


                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail1"> {!!  isset($about_us) ? $about_us->middle_section_title.' section3 title' : 'Our Mission & Vision section3 title'!!} <span class="text-danger">*</span>
                                        </label>

                                        <textarea class="textarea" placeholder="Place some text here" name="middle_section_content3_title"
                                                  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{!!  isset($about_us) ? $about_us->middle_section_content3_title : '' !!}</textarea>

                                        <span class="text-danger">{{$errors->first('middle_section_content3_title')}}</span>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail1"> {!!  isset($about_us) ? $about_us->middle_section_title.' section3 description' : 'Our Mission & Vision section3 description' !!} <span class="text-danger">*</span>
                                        </label>

                                        <textarea class="textarea" placeholder="Place some text here" name="middle_section_content3_description"
                                                  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{isset($about_us) ? $about_us->middle_section_content3_description : ''}}</textarea>

                                        <span class="text-danger">{{$errors->first('middle_section_content3_description')}}</span>
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


