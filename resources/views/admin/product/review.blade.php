@extends('admin.layouts.master')
@section('post_header')
    <link rel="stylesheet" href="{{asset('SuperAdmin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet"
          href="{{asset('SuperAdmin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endsection
@section('page_title', isset($page_title) ? $page_title :'Reviews')
@section('task', isset($task) ? $task:'List' )
@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">@yield('page_title')</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped" id="table">
                <thead>
                <tr class="text-center">
                    <th>
                       Sl
                    </th>
                    <th>
                       Seller
                    </th>
                    <th>
                       Image
                    </th>
                    <th>
                       Product Name
                    </th>
                    <th>
                       Rating
                    </th>
                    <th>
                       Title
                    </th>
                    <th>
                       Customer
                    </th>
                    <th>
                       Date
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
    <script src="{{asset('SuperAdmin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('SuperAdmin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('SuperAdmin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('SuperAdmin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {

            $('#table').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 25,
                responsive: true,
                searchable:false,
                orderable: false,

                ajax: "{{ route('admin.productReview.list') }}",
                order: [1, 'desc'],
                autoWidth: false,
                columns: [

                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable:false,
                        orderable: false,

                    },

                    {
                        data: 'vendor',
                        name: 'vendor',
                        searchable:false,
                        orderable: false,
                    },

                    {
                        data: 'image',
                        name: 'image',
                        searchable:false,
                        orderable: false,
                    },

                    {
                        data: 'product_name',
                        name: 'product_name'
                    },

                    {
                        data: 'rating',
                        name: 'rating'
                    },

                    {
                        data: 'title',
                        name: 'title'
                    },

                    {
                        data: 'customer_name',
                        name: 'customer_name',
                    },

                    {
                        data: 'date',
                        name: 'date'
                    }
                ],
                createdRow:function (row,data,index)
                {
                    // $('td',row).eq(0).addClass(' text-center');
                    // $('td',row).eq(1).addClass(' text-center');
                    // $('td',row).eq(2).addClass(' text-center');
                    $('td',row).eq(4).addClass('text-center');
                    // $('td',row).eq(4).addClass('text-danger text-center');
                }
            });



        });
    </script>
@endsection

