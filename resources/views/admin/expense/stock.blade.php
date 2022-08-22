@extends('admin.layouts.master')
@section('post_header')
    <link rel="stylesheet" href="{{asset('SuperAdmin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet"
          href="{{asset('SuperAdmin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endsection
@section('page_title', isset($menu) ? $menu :'Products')
@section('task', isset($page_title) ? $page_title : 'Products' )
@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{isset($page_title) ? $page_title : 'Stock'}}</h3>

        </div>
        <div class="card-body">
            <table class="table cell-border table-compact  table-hover" id="table">
                <thead>
                <tr>
                    <th>
                        SL
                    </th>
                    <th>
                        Product | <small>Brand</small>
                    </th>
                    <th>
                        Purchase Price <small>(avg)</small>
                    </th>
                    <th>
                        unit
                    </th>
                    <th>
                        Quantity
                    </th>
                    <th>
                        Sold
                    </th>
                    <th>
                        InStock
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
    <script src="{{asset('SuperAdmin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('SuperAdmin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('SuperAdmin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('SuperAdmin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {

            $('#table').DataTable({

                columnDefs: [
                    {"className": "dt-center hover", "targets": "_all"}
                ],
                processing: true,
                serverSide: true,
                pageLength: 25,
                responsive: true,
                searchable:false,
                orderable: false,

                ajax: "{{route('admin.products.stock')}}",
                order: [1, 'desc'],
                autoWidth: false,
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        "targets": 0,
                        "orderable": false,
                        "searchable": false,
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },

                    {
                        data: 'purchase_price',
                        name: 'purchase_price'
                    },

                    {
                        data: 'unit',
                        name: 'unit'
                    },

                    {
                        data: 'quantity',
                        name: 'quantity'
                    },
                    {
                        data: 'sold',
                        name: 'sold'
                    },

                    {
                        data: 'stock',
                        name: 'stock'
                    },

                    {
                        data: 'action',
                        name: 'action',
                        "targets": 0,
                        "orderable": false,
                        "searchable": false,
                    }
                ]
            });

            $(document).on('click', '.delete', function () {

                return confirm("Are You Sure To Delete This!");

            });

        });
    </script>
@endsection
