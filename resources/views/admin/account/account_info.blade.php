@extends('admin.layouts.master')
@section('post_header')
    <link rel="stylesheet" href="{{asset('SuperAdmin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet"
          href="{{asset('SuperAdmin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endsection
@section('page_title', isset($pageSettings['page_title']) ? $pageSettings['page_title']:'Admins')
@section('task', isset($pageSettings['task']) ? $pageSettings['task']: 'List' )

@section('content')
    <div class="card">
        <div class="card-body">

{{--            <div class="row invoice-info">--}}
{{--                <div class="col-sm-4 invoice-col">--}}
{{--                    Shop--}}
{{--                    <address>--}}
{{--                        <strong>{{$vendor->shop_name}}</strong><br>--}}
{{--                    </address>--}}
{{--                </div>--}}
{{--                <!-- /.col -->--}}
{{--                <div class="col-sm-4 invoice-col">--}}
{{--                    Contact--}}
{{--                    <address>--}}
{{--                        Name :<strong> {{$vendor->owner_name}} <br></strong>--}}
{{--                        Email: {{$vendor->email}}<br>--}}
{{--                        Phone : {{$vendor->phone}}<br>--}}
{{--                        city : {{$vendor->city}}<br>--}}
{{--                        city : {{$vendor->city}}<br>--}}
{{--                        Address : {{$vendor->city, $vendor->city}}<br>--}}
{{--                        --}}
{{--                        --}}

{{--                    </address>--}}
{{--                </div>--}}
{{--                <!-- /.col -->--}}
{{--                <div class="col-sm-4 invoice-col">--}}

{{--                </div>--}}
{{--                <!-- /.col -->--}}

{{--            </div>--}}
            <hr>
            <table class="table table-bordered table-striped" id="table">
                <thead>
                <tr>

                    <th>
                        SL.
                    </th>
                    <th>
                        Seller
                    </th>

                    <th>
                        Image
                    </th>
                    <th>
                        Date
                    </th>
                    <th>
                        Order Number
                    </th>

                    <th>
                        name
                    </th>

                    <th>
                        Brand
                    </th>

                    <th>
                        Unit
                    </th>

                    <th>
                        Price
                    </th>

                    <th>
                        Size
                    </th>

                    <th>
                        Color
                    </th>

                    <th>
                        Qty
                    </th>

                    <th>
                        Total Amount
                    </th>

                    <th>
                        Commission
                    </th>

                    <th>
                        Commission Amount
                    </th>

                    <th>
                        Shopstick Amount
                    </th>
                    <th>
                        Payment status
                    </th>
                    <th>
                        Payment Date
                    </th>
                </tr>
                </thead>

                <tbody>

                </tbody>
            </table>

            <!-- /.card-body -->
        </div>
{{--        <div class="card-footer">--}}
{{--            <a type="submit" class="btn btn-info float-left" href="{{route('vendor.account.summery')}}">Back</a>--}}
{{--        </div>--}}
    </div>

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


                ajax: "{{ route('admin.account.info') }}",
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
                        data: 'vendor_id',
                        name: 'vendor_id'
                    },
                    {
                        data: 'image',
                        name: 'image'
                    },
                    {
                        data: 'date',
                        name: 'date',

                    },
                    {
                        data: 'order_number',
                        name: 'order_number'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'brand',
                        name: 'brand'
                    },
                    {
                        data: 'unit',
                        name: 'unit'
                    },
                    {
                        data: 'price',
                        name: 'price'
                    },
                    {
                        data: 'size',
                        name: 'size'
                    },
                    {
                        data: 'color',
                        name: 'color'
                    },
                    {
                        data: 'quantity',
                        name: 'quantity'
                    },
                    {
                        data: 'total_amount',
                        name: 'total_amount'
                    },
                    {
                        data: 'commission',
                        name: 'commission'
                    },
                    {
                        data: 'shopstick_amount',
                        name: 'shopstick_amount'
                    },
                    {
                        data: 'seller_amount',
                        name: 'seller_amount'
                    },
                    {
                        data: 'payment_status',
                        name: 'payment_status'
                    },
                    {
                        data: 'payment_date',
                        name: 'payment_date'
                    },
                    // {
                    //     data: 'action',
                    //     name: 'action'
                    // }
                ],
                // createdRow:function (row,data,index)
                // {
                //     $('td',row).eq(4).addClass('text-info text-center');
                //     $('td',row).eq(5).addClass('text-success text-center');
                //     $('td',row).eq(6).addClass('text-center');
                //     $('td',row).eq(7).addClass('text-danger text-center');
                // }
            });

        });
    </script>
@endsection
