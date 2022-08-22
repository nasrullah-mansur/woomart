@extends('admin.layouts.master')
@section('post_header')
    <link rel="stylesheet" href="{{asset('SuperAdmin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet"
          href="{{asset('SuperAdmin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endsection
@section('page_title', isset($menu) ? $menu :'Delivery Settings')
@section('task', isset($task) ? $task : 'List' )
@section('content')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{isset($page_title) ? $page_title : 'List'}}</h3>

             <div class="card-tools">

                        <form method="POST" action="{{route('admin.deliverySettings.edit')}}" class="form-group row">

                            @csrf
                        <label class="col-xl-2 col-md-2">District Id</label>
                        <input class="form-control col-md-2" type="hidden" data-language="en" name="district_id" id="district_id" required="">

                        <input class="form-control col-md-2" type="text" data-language="en" name="name" id="name" readonly>

                        <label class="col-xl-2 col-md-2">Delivery Charge</label>
                        <input class="form-control col-md-2" type="text" data-language="en" name="delivery_charge" id="delivery_charge" required="">
                        <label class="col-md-1"></label>
                        <input class=" btn btn-info form-control col-md-2" type="submit" data-language="en" name="Submit">
                        </form>
               
            </div>
            
        </div>
        <div class="card-body">
            <table class="table cell-border table-compact  table-striped table-hover" id="table">
                <thead>
                <tr>
                    <th>
                        SL
                    </th>
                    <th>
                       District
                    </th>
                    <th>
                       Delivery Charge
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

                ajax: "{{route('admin.deliverySettings')}}",
                order: [1, 'desc'],
                autoWidth: false,
                columns: [
                    {
                        data: 'id',
                        name: 'id',
                        "targets": 0,
                        "orderable": false,
                        "searchable": false,
                    },

                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'delivery_charge',
                        name: 'delivery_charge',
                        "orderable": false,
                        "searchable": false,
                    },{

                        data: 'action',
                        name: 'action',
                        "orderable": false,
                        "searchable": false,
                    }
                ],

                createdRow:function(row,data,index){
                    $('td',row).eq(0).addClass('district_id');
                    $('td',row).eq(1).addClass('name');
                    $('td',row).eq(2).addClass('delivery_charge');


                }
            });


             $(document).on('click', '.delivery', function () {

                    $('#district_id').val($(this).closest('tr').find('.district_id').text());
                    $('#name').val($(this).closest('tr').find('.name').text());
                    $('#delivery_charge').val($(this).closest('tr').find('.delivery_charge').text());

            });

            $(document).on('click', '.delete', function () {

                return confirm("Are You Sure To Delete This!");

            });


        });
    </script>
@endsection
