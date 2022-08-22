@extends('admin.layouts.master')
@section('post_header')
    <link rel="stylesheet" href="{{asset('SuperAdmin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet"
          href="{{asset('SuperAdmin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endsection
@section('page_title', isset($menu) ? $menu :'Stock')
@section('task', isset($page_title) ? $page_title : 'details' )
@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <strong>{{$stocks->product->name}} | {{isset($stocks->product->brand_id) ? strtolower($stocks->product->brand->name) : ''}}</strong>
            </h3>
        </div>
        <div class="card-body">

            <hr>
            <table class="table cell-border table-compact  table-hover" id="table">
                <thead>
                <tr>
                    <th>
                        SL
                    </th>
                    <th>
                        Date
                    </th>
                    <th>
                        Invoice no
                    </th>
                    <th>
                       Purchase Price
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

                </tr>
                </thead>

                <tbody>

                </tbody>
            </table>

            <!-- /.card-body -->
        </div>
        <div class="card-footer">
            <a type="submit" class="btn btn-info float-left" href="{{route('admin.products.stock')}}">Back</a>
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

                ajax: "{{route('admin.products.stock.details', $product_id)}}",
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
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'purchase_id',
                        name: 'purchase_id'
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
                    }
                ]
            });

            $(document).on('click', '.delete', function () {

                return confirm("Are You Sure To Delete This!");

            });

        });
    </script>
@endsection
