@extends('admin.layouts.master')
@section('page_title', isset($menu) ? $menu:'Banner')
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
                            <h3 class="card-title">{{isset($page_title) ? $page_title:'Banner'}}</h3>
                        </div>

                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="POST" action="{{route('admin.banner.update')}}"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label for="exampleInputFile">Offer Banner1</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <label class="custom-file-label" for="offer_banner1">Choose
                                                    file</label>
                                                <input type="file" id="offer_banner1" name="offer_banner1" onchange="putImage(this, 'target1')"/>
                                            </div>
                                        </div>
                                        <span class="text-danger">{{$errors->first('offer_banner1')}}</span>

                                    </div>
                                    <div class="form-group col-md-4">

                                        <img id="target1"  src="{{$banner->offer_banner1}}" width="120" height="80"/>
                                    </div>

                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label for="exampleInputFile">Offer Banner2</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <label class="custom-file-label" for="offer_banner2">Choose
                                                    file</label>
                                                <input type="file" id="offer_banner2" name="offer_banner2" onchange="putImage(this, 'target2')"/>
                                            </div>
                                        </div>
                                        <span class="text-danger">{{$errors->first('offer_banner2')}}</span>

                                    </div>
                                    <div class="form-group col-md-4">
                                        <img id="target2"  src="{{$banner->offer_banner2}}" width="120" height="80" />
                                    </div>

                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label for="exampleInputFile">Offer Banner3</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <label class="custom-file-label" for="offer_banner3">Choose
                                                    file</label>
                                                <input type="file" id="offer_banner3" name="offer_banner3" onchange="putImage(this, 'target3')"/>
                                            </div>
                                        </div>
                                        <span class="text-danger">{{$errors->first('offer_banner3')}}</span>

                                    </div>
                                    <div class="form-group col-md-4">

                                        <img id="target3" src="{{$banner->offer_banner3}}" width="120" height="80"/>
                                    </div>

                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label for="exampleInputFile">Trend Banner1</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <label class="custom-file-label" for="trend_banner1">Choose
                                                    file</label>
                                                <input type="file" id="trend_banner1" name="trend_banner1" onchange="putImage(this, 'target4')"/>
                                            </div>
                                        </div>
                                        <span class="text-danger">{{$errors->first('trend_banner1')}}</span>

                                    </div>
                                    <div class="form-group col-md-4">
                                        <img id="target4"  src="{{$banner->trend_banner1}}" width="120" height="80"/>
                                    </div>

                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label for="exampleInputFile">Trend Banner2</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <label class="custom-file-label" for="trend_banner2">Choose
                                                    file</label>
                                                <input type="file" id="trend_banner2" name="trend_banner2" onchange="putImage(this, 'target5')"/>
                                            </div>
                                        </div>
                                        <span class="text-danger">{{$errors->first('trend_banner2')}}</span>

                                    </div>
                                    <div class="form-group col-md-4">
                                        <img id="target5"  src="{{$banner->trend_banner2}}" width="120" height="80"/>
                                    </div>

                                </div>

                                <input type="hidden" name="edit_id" value="{{$banner->id}}">
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

