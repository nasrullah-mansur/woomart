@extends('admin.layouts.master')
@section('post_header')
    <link rel="stylesheet" href="{{asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet"
          href="{{asset('assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endsection
@section('page_title', isset($menu) ? $menu :'Products')
@section('task', isset($page_title) ? $page_title : 'Category' )
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{isset($page_title) ? $page_title : 'Category'}}</h3>

            <div class="card-tools">
                <a type="button" class="btn btn-block btn-outline-info btn-sm" href="{{route('admin.category.create')}}">Add
                    new category</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover" id="table">
                <thead>
                <tr>
                    <th>
                        SL
                    </th>
                    <th>
                      Category Name
                    </th>
                    <th>
                        Parent Category
                    </th>
                    <th>
                        Image
                    </th>
                    <th>
                        Icon
                    </th>
                    <th>
                        Description
                    </th>
                    <th>
                        {{allSettings('category_section') ? allSettings('category_section') : 'Top Category'}}
                    </th>
                    <th>
                        Active Status
                    </th>
                    <th>
                        Action
                    </th>

                </tr>
                </thead>

                <tbody>

                </tbody>
            </table>

            <!-- /.card-body -->
        </div>
    </div>
    <!-- /.modal -->
    <!-- /.End Package Assign Modal -->
@endsection

@section('post_script')

    <!-- DataTables -->
    <script src="{{asset('assets/admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {

            $('#table').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 25,
                responsive: true,
                searchable:false,
                orderable: false,

                ajax: "{{route('admin.category')}}",
                order: [1, 'desc'],
                autoWidth: false,
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable:false,
                        searchable:false
                    },

                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'parent',
                        name: 'parent'
                    },

                    {
                        data: 'image',
                        name: 'image',
                        orderable:false,
                        searchable:false
                    },

                    {
                        data: 'icon',
                        name: 'icon',
                        orderable:false,
                        searchable:false
                    },


                    {
                        data: 'description',
                        name: 'description'
                    },

                    {
                        data: 'top_category',
                        name: 'top_category',
                        orderable:false,
                        searchable:false
                    },

                    {
                        data: 'status',
                        name: 'status',
                        orderable:false,
                        searchable:false
                    },


                    {
                        data: 'action',
                        name: 'action',
                        orderable:false,
                        searchable:false
                    }
                ],
                createdRow:function(row,data,index){
                    $('td',row).eq(4).addClass('text-center');
                }
            });

            $(document).on('click', '.delete', function () {

                return confirm("Are You Sure To Delete This!");

            });

        });
    </script>
@endsection
