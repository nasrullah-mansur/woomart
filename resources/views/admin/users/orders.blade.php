@extends('admin.layouts.master')
@section('post_header')
    <link rel="stylesheet" href="{{asset('SuperAdmin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet"
          href="{{asset('SuperAdmin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endsection
@section('page_title', isset($page_title) ? $page_title :'Orders')
@section('task', isset($pageSettings['task']) ? $pageSettings['task']: 'List' )

@section('content')
{{--@include('message.message')--}}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">list</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped" id="table">
                <thead>
                <tr>

                    <th>
                        SL.
                    </th>
                    <th>
                        Order Date
                    </th>
                    <th>
                        Order Number
                    </th>

                    <th>
                        Shipping Address
                    </th>
                    <th>
                        Payment ID
                    </th>
                    <th>
                        Payment_method
                    </th>
                    <th>
                       Order Status
                    </th>
                    <th>
                        Delivery Charge
                    </th>
                    <th>
                      Order Amount
                    </th>
                    <th>
                        Total Payable amount
                    </th>
                    <th>
                        Action
                    </th>

                </tr>
                </thead>

                <tbody>

                </tbody>
            </table>

           <a class="btn btn-info" href="{{route('admin.all.users')}}">Back</a>
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
                searchable: false,
                orderable: false,

                ajax: "{{ route('admin.user.orders', $user_id) }}",
                order: [1, 'desc'],
                autoWidth: false,
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',

                        searchable: false,
                        orderable: false,
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'order_number',
                        name: 'order_number'
                    },
                    {
                        data: 'shipping_id',
                        name: 'shipping_id'
                    },
                    {
                        data: 'payment_id',
                        name: 'payment_id'
                    },
                    {
                        data: 'payment_method',
                        name: 'payment_method'
                    },
                    {
                        data: 'order_status',
                        name: 'order_status'
                    },
                    {
                        data: 'delivery_charge',
                        name: 'delivery_charge'
                    },
                    {
                        data: 'total_order_amount',
                        name: 'total_order_amount'
                    },

                    {
                        data: 'total_payable_amount',
                        name: 'total_payable_amount'
                    },
                    {
                        data: 'action',
                        name: 'action',
                    }
                ]
            });

            $(document).on('click', '.delete', function () {

                return confirm("Are You Sure To Delete This!");

            });

        });
    </script>
@endsection
