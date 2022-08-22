@extends('admin.layouts.master')
@section('page_title', isset($pageSettings['page_title'])? $pageSettings['page_title']:'Dashboard')
@section('task', isset($pageSettings['task'])? $pageSettings['task']: '' )
@section('content')
    @include('message.message')

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="card card-info card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">

                                @if(!empty($admin->image))

                                    <img class="profile-user-img img-fluid img-circle"
                                         src="{{$admin->image}}"
                                         alt="User profile picture">
                                @else
                                    <img class="profile-user-img img-fluid img-circle"
                                         src="{{asset('assets/admin/dist/img/user2-160x160.jpg')}}"

                                         alt="User profile picture">
                                @endif
                            </div>

                            <h3 class="profile-username text-center">{{ isset($admin) ? $admin->name : 'Md. Admin' }}</h3>

                            <p class="text-muted text-center">{{'Admin'}}</p>


                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                {{--<li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Activity</a>--}}
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#passwordChange" data-toggle="tab">Password
                                        Change</a>
                                </li>
                                <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Settings</a>
                                </li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="passwordChange">
                                    <form class="form-horizontal" method="post" action="{{route('admin.password.update')}}"
                                          enctype="multipart/form-data">
                                        @csrf
{{--                                        <div class="form-group row">--}}
{{--                                            <label for="inputName" class="col-sm-2 col-form-label">Current password</label>--}}
{{--                                            <div class="col-sm-10">--}}
{{--                                                <input type="password" name="old_password" class="form-control"--}}
{{--                                                       id="new_password"--}}
{{--                                                       placeholder="">--}}
{{--                                                <p class="text-danger">{{$errors->first('old_password')}}</p>--}}

{{--                                            </div>--}}
{{--                                        </div>--}}


                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-2 col-form-label">New password</label>
                                            <div class="col-sm-10">
                                                <input type="password" name="password" class="form-control"
                                                       id="new_password"
                                                       placeholder="">
                                                <p class="text-danger">{{$errors->first('password')}}</p>

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Retype
                                                Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" name="password_confirmation"
                                                       id="password_confirmation"
                                                       placeholder="">
                                            </div>
                                        </div>
                                        <input type="hidden" name="edit_id" value="{{$admin->id}}">

                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->

                                <div class="tab-pane active" id="settings">
                                    <form class="form-horizontal" method="post" action="{{route('admin.profile.update')}}"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" name="name" class="form-control" id="inputName"
                                                       placeholder="Name" value="{{$admin->name}}">
                                                <p class="text-danger">{{$errors->first('name')}}</p>

                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="email" id="inputEmail"
                                                       placeholder="Email" value="{{$admin->email}}">
                                                <p class="text-danger">{{$errors->first('last_name')}}</p>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Phone</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="phone" id="inputEmail"
                                                       placeholder="mobile no" value="{{$admin->phone}}">
                                                <p class="text-danger">{{$errors->first('phone')}}</p>

                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Country</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="country" id="inputEmail"
                                                       placeholder="Country" value="{{$admin->country}}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">City</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="city" id="inputEmail"
                                                       placeholder="city" value="{{$admin->city}}">

                                            </div>
                                        </div>
{{--                                        <div class="form-group row">--}}
{{--                                            <label for="inputName2" class="col-sm-2 col-form-label">Nationality</label>--}}
{{--                                            <div class="col-sm-10">--}}
{{--                                                <input type="text" name="nationality" class="form-control"--}}
{{--                                                       id="inputName2"--}}
{{--                                                       placeholder="nationality">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}


                                        <div class="form-group row">
                                            <label for="inputSkills" class="col-sm-2 col-form-label">Image</label>
                                            <div class="col-sm-10">
                                                <input type="file" name="image" class="form-control" id="inputSkills"
                                                       placeholder="Skills">
                                                <p class="text-danger">{{$errors->first('image')}}</p>

                                            @if(isset($admin->image))
                                                    <img src="{{$admin->image}}"
                                                         height="90" width="60" alt="">
                                                @endif

                                            </div>
                                        </div>

                                        <input type="hidden" name="edit_id" value="{{$admin->id}}">
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                {{--<div class="checkbox">--}}
                                                {{--<label>--}}
                                                {{--<input type="checkbox"> I agree to the <a href="#">terms and--}}
                                                {{--conditions</a>--}}
                                                {{--</label>--}}
                                                {{--</div>--}}
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
