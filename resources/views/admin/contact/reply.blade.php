@extends('admin.layouts.master')
@section('page_title', isset($page_title) ? $page_title:'Contact')
@section('task', isset($task) ? $task: 'reply' )
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->

                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">{{$user->name}}</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        @if(isset($contacts) && count($contacts) > 0)
                            <div class="card-body">

                                @foreach($contacts as $contact)
                                    @if($contact->is_question)
                                        <div class="form-row">
                                            <div class="form-group col-md-5 question"
                                                 style="background-color: #847f7f; padding: 21px; text-align: center; border-radius: 4px; margin-left: 8%;">
                                                {{$contact->message}}<br>
                                                <small>{{date('d-M-y h:m:s', strtotime($contact->created_at))}}</small>
                                            </div>
                                        </div>
                                    @else

                                        <div class="form-row">
                                            <div class="form-group col-md-5">
                                            </div>
                                            <div class="form-group col-md-5 reply"
                                                 style="background-color: #efdede; padding: 21px; text-align: center; border-radius: 4px;">
                                                {{$contact->message}} <br>
                                                <small>{{date('d-M-y h:m:s', strtotime($contact->created_at))}}</small>

                                            </div>

                                        </div>
                                    @endif
                                @endforeach

                            </div>
                    @endif
                    <!-- /.card-body -->
                        <div class="form-row">
                            <div class="form-group col-md-5 question">
                            </div>
                            <div class="form-group col-md-5 question">

                                <form role="form" method="POST" action="{{route('admin.contact.sendReply')}}"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{$user->id}}">
                                    <div class="col-8"> <textarea name="message" id="" cols="60" rows="3"></textarea></div>
                                    <div class="col-4"><button type="submit" class="btn btn-info">reply</button></div>


                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->

                    <div class="card-footer">


                    </div>

                    <!--/.col (right) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
    </section>

@endsection
