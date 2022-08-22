@extends('admin.layouts.master')
@section('post_header')
    <link rel="stylesheet" href="{{asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet"
          href="{{asset('assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endsection
@section('page_title', isset($menu) ? $menu :'Banner')
@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{isset($page_title) ? $page_title : 'Banner'}}</h3>
            @if(empty($banner))
            <div class="card-tools">
                <a type="button" class="btn btn-block btn-outline-info btn-sm"
                   href="{{route('admin.banner.create')}}">Add
                    new banner</a>
            </div>
                @endif
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped" id="table">
                <thead>
                <tr>
                    <th>
                        SL
                    </th>
                    <th>
                        Offer Banner1
                    </th>
                    <th>
                        Offer Banner2
                    </th>
                    <th>
                        Offer Banner3
                    </th>
                    <th>
                        Trend Banner1
                    </th>
                    <th>
                        Trend Banner2
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
                searchable: false,
                orderable: false,

                ajax: "{{ route('admin.banner') }}",
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
                        data: 'offer_banner1',
                        name: 'offer_banner1',
                        orderable:false,
                        searchable:false
                    },
                    {
                        data: 'offer_banner2',
                        name: 'offer_banner2',
                        orderable:false,
                        searchable:false
                    },

                    {
                        data: 'offer_banner3',
                        name: 'offer_banner3',
                        orderable:false,
                        searchable:false
                    },
                    {
                        data: 'trend_banner1',
                        name: 'trend_banner1',
                        orderable:false,
                        searchable:false
                    },
                    {
                        data: 'trend_banner2',
                        name: 'trend_banner2',
                        orderable:false,
                        searchable:false
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
