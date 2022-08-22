@extends('SuperAdmin.layouts.master')
@section('page_title', isset($pageSettings['page_title']) ? $pageSettings['page_title']:'Ingredient Unit Edit')
@section('task', isset($pageSettings['task']) ? $pageSettings['task']: 'Edit' )
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <form role="form" method="POST" action="{{route('superAdmin.ingredient.update')}}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Units</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name</label>
                                    <input type="text" class="form-control" name="name" id="exampleInputEmail1" value="{{ $ingredient->name }}">
                                </div>
                                <p class="text-danger"> {{$errors->first('name')}}</p>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Full Name</label>
                                    <input type="text" class="form-control" name="full_name" id="exampleInputEmail1" value="{{ $ingredient->full_name }}">
                                </div>
                                <p class="text-danger"> {{$errors->first('full_name')}}</p>


                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                        <input type="hidden" name="edit_id" value="{{ $ingredient->id }}">

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
