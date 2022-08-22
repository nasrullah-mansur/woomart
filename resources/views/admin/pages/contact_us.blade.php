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
                            <h3 class="card-title">{{isset($page_title) ? $page_title:'Contact us'}}</h3>
                        </div>

                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="POST" action="{{route('admin.contact.us.settings')}}"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail1">Contact title <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="contact_title"
                                               id="exampleInputEmail1"
                                               value="{{isset($contact_us) ? $contact_us->contact_title : ''}}">
                                        <span class="text-danger">{{$errors->first('contact_title')}}</span>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail1">Contact form title
                                        </label>
                                        <input type="text" class="form-control" name="form_title"
                                               id="exampleInputEmail1"
                                               value="{{isset($contact_us) ? $contact_us->form_title : ''}}">
                                        <span class="text-danger">{{$errors->first('form_title')}}</span>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail1">Why contact us <span class="text-danger">*</span>
                                        </label>
                                        <textarea class="textarea" placeholder="Place some text here" name="why_contact"
                                                  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{isset($contact_us) ? $contact_us->why_contact : ''}}</textarea>
                                        <span class="text-danger">{{$errors->first('why_contact')}}</span>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="exampleInputEmail1">Address <span class="text-danger">*</span>
                                        </label>
                                        <textarea class="textarea" placeholder="Place some text here" name="address"
                                                  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{isset($contact_us) ? $contact_us->address : ''}}</textarea>
                                        <span class="text-danger">{{$errors->first('address')}}</span>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="exampleInputEmail1">Phone <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="phone"
                                               id="exampleInputEmail1"
                                               value="{{isset($contact_us) ? $contact_us->phone : ''}}">
                                        <span class="text-danger">{{$errors->first('phone')}}</span>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="exampleInputEmail1">Email <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" name="email"
                                               id="exampleInputEmail1"
                                               value="{{isset($contact_us) ? $contact_us->email : ''}}">
                                        <span class="text-danger">{{$errors->first('email')}}</span>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="exampleInputEmail1">Url
                                        </label>
                                        <input type="text" class="form-control" name="site_url"
                                               id="exampleInputEmail1"
                                               value="{{isset($contact_us) ? $contact_us->site_url : ''}}">
                                        <span class="text-danger">{{$errors->first('site_url')}}</span>
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
    </section>

@endsection


