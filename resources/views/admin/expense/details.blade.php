@extends('admin.layouts.master')
@section('post_header')
    <link rel="stylesheet" href="{{asset('SuperAdmin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet"
          href="{{asset('SuperAdmin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endsection
@section('page_title', 'Purchase')
@section('task', 'Details' )

@section('content')
    <div class="card">
        <div class="card-body">

            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    Supplier
                    <address>
                        <strong>{{$supplier->name}}</strong><br>
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    Contact
                    <address>
                        Name :<strong> {{$supplier->contact_person}} <br></strong>
                        Email: {{$supplier->email}}<br>
                        Phone : {{$supplier->phone}}<br>
                        Address : {{$supplier->address}}<br>

                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">

                </div>
                <!-- /.col -->

            </div>
            <hr>
            <table class="table table-bordered table-striped" id="table">
                <thead>
                <tr>

                    <th>
                        SL.
                    </th>
                    <th>
                        Date
                    </th>
                    <th>
                        Invoice No
                    </th>
                    <th>
                       Total Amount
                    </th>
                    <th>
                       Paid amount
                    </th>
                    <th>
                       Adjustment
                    </th>
                    <th>
                       Due Amount
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
        <div class="card-footer">
                  <a type="submit" class="btn btn-info float-left" href="{{route('admin.Supplier.index', app()->getLocale())}}">Back</a>
        </div>
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

                ajax: "{{ route('admin.supplier.purchaseDetails',[$supplier_id]) }}",
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
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'invoice_no',
                        name: 'invoice_no'
                    },
                    {
                        data: 'total_amount',
                        name: 'total_amount'
                    },
                    {
                        data: 'paid_amount',
                        name: 'paid_amount'
                    },
                    {
                        data: 'adjustment',
                        name: 'adjustment'
                    },
                    {
                        data: 'due_amount',
                        name: 'due_amount'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }
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
