@extends('admin.layouts.master')
@section('post_header')
    <link rel="stylesheet" href="{{asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet"
          href="{{asset('assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endsection
@section('page_title', isset($menu) ? $menu :'Attribute')
@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{isset($page_title) ? $page_title : 'Color'}}</h3>

            <div class="card-tools">
                <a type="button" class="btn btn-block btn-outline-info btn-sm"
                   href="{{route('admin.size.create')}}">Add
                    new size</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped" id="table">
                <thead>
                <tr>
                    <th>
                        SL
                    </th>
                    <th>
                        Size
                    </th>

                    <th>
                        Chest
                    </th>

                    <th>
                        Shoulder
                    </th>
                    <th>
                        Length
                    </th>
                    <th>
                        Sleeve
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
                searchable: false,
                orderable: false,

                ajax: "{{ route('admin.size') }}",
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
                        data: 'size',
                        name: 'size'
                    },
                    {
                        data: 'chest',
                        name: 'chest'
                    },

                    {
                        data: 'shoulder',
                        name: 'shoulder'
                    },

                    {
                        data: 'length',
                        name: 'length'
                    },

                    {
                        data: 'sleeve',
                        name: 'sleeve'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable:false,
                        searchable:false
                    }
                ]
            });

            $(document).on('click', '.delete', function () {

                return confirm("Are You Sure To Delete This!");

            });

        });
    </script>
@endsection
