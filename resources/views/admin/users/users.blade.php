@extends('admin.layouts.master')
@section('post_header')
    <link rel="stylesheet" href="{{asset('SuperAdmin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet"
          href="{{asset('SuperAdmin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endsection
@section('page_title', isset($page_title) ? $page_title :'Vendor')
@section('task', isset($task) ? $task:'List' )
@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{isset($page_title) ? $page_title : 'Vendor'}}</h3>
        </div>
        <div class="card-body">

            <div class="modal fade" id="modal-sm">
                <div class="modal-dialog modal-sm">
                    <form role="form" method="POST" action="{{route('admin.sendSms')}}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title text-info payment-modal-title"></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-sm-12">

                                        <div class="form-group">
                                            <label>Phone Number</label>
                                            <input type="text" class="form-control" name="phone_number" id="phone_number" readonly/>
                                        </div>
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Message</label>
                                            <textarea type="text" class="form-control" name="message"> </textarea>
                                        </div>

                                    </div>
                                </div>

                                <input type="hidden" name="user_id" id="user_id">
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-info">Send sms</button>
                            </div>
                        </div>
                    </form>
                    <!-- /.modal-content -->
                </div>
            </div>
            <table class="table cell-border table-compact  table-hover" id="table">
                <thead>
                <tr>
                    <th>
                        SL
                    </th>
                    <th>
                       image
                    </th>
                    <th>
                       Name
                    </th>
                    <th>
                       Email
                    </th>
                    <th>
                       Phone
                    </th>
                    <th>
                       Address
                    </th>
                    <th>
                        Orders
                    </th>
                    <th>
                        Transaction
                    </th>
                    <th>
                        Join Date
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

                ajax: "{{route('admin.all.users')}}",
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
                        data: 'image',
                        name: 'image'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'phone_number',
                        name: 'phone_number'
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },
                    {
                        data: 'orders',
                        name: 'orders'
                    },
                    {
                        data: 'transaction',
                        name: 'transaction'
                    },
                    {
                        data:'created_at',
                        name:'created_at'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        "targets": 0,
                        "orderable": false,
                         "searchable": false,
                    }
                ],

                createdRow: function ( row, data, index )
                {
                    $('td', row).eq(2).addClass('name');
                    $('td', row).eq(4).addClass('phone_number');
                }
            });

            $(document).on('click', '.delete', function () {

                return confirm("Are You Sure To Delete This!");

            });
// # send sms
            $(document).on('click', '.send_sms', function () {

                var user_id = $(this).data('id');

                var name = $(this).closest("tr").find(".name").text();
                var phone_number = $(this).closest("tr").find(".phone_number").text();

                    $('#phone_number').val(phone_number);
                    $('#user_id').val(user_id);

                $('.payment-modal-title').html('<i class="fas fa-sms"></i> '+name.toUpperCase());
                $("#modal-sm").modal('show');
            });

        });
    </script>
@endsection

