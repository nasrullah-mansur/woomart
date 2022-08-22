@extends('admin.layouts.master')
@section('post_header')
    <link rel="stylesheet" href="{{asset('SuperAdmin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet"
          href="{{asset('SuperAdmin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('SuperAdmin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('SuperAdmin/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('SuperAdmin/custome/style.css')}}">
    <link rel="stylesheet" href="{{asset('SuperAdmin/sweetalert2/dist/sweetalert.min.css')}}">
@endsection
@section('page_title', isset($pageSettings['page_title']) ? $pageSettings['page_title']:'Admins')
@section('task', isset($pageSettings['task']) ? $pageSettings['task']: 'List' )

@section('content')

    <div class="card card-solid">
        <form role="form" method="POST" action="{{route('admin.account.expense.addEdit')}}"
              enctype="multipart/form-data" onsubmit="return validateForm()">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-3">
                        <!-- Ingredient input -->
                        <div class="form-group">
                            <label>Expense</label><code>*</code>

                            <select class="form-control select2bs4" style="width: 100%;" name="ingredient"
                                    id="ingredient">
                                <option value="">Select</option>
                                @if(isset($expense_heads))
                                    @foreach($expense_heads as $exp_head )
                                        <option
                                            value="<?php echo $exp_head->id . '|' . $exp_head->name ?>">{{$exp_head->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row mt-1" id="purchase_cart">
                    <table class="table">
                        <thead>
                        <tr>
                            <th style="width: 10px">SN</th>
                            <th class="text-center">Expense list</th>
                            <th>Amount</th>
                            <th>Description</th>
                            <th>Total</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>


                <div class="row">
                    <div class="col-md-8"></div>
                    <div class="col-md-3">
                        <div class="form-group">

                            <table style="width: 80%">
                                <tr>
                                    <td><label class="text-success">G.Total <code>*</code></label></td>
                                    <td style="width: 70%"><input
                                            class="form-control text-right font-weight-bold text-success" readonly
                                            type="text" name="grand_total" id="grand_total"></td>
                                    <td style="width: 5%;text-align: right"> <span class="label_aligning_total_loss">
                                               &#2547;

                                            </span></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-8"></div>
                </div>
                <div class="col-md-1"></div>
                <!--                         <div class="clearfix"></div>
                 -->
                <div class="col-md-8"></div>
                <div class="col-md-1"></div>
            </div>

    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-info">Submit</button>
{{--        <a type="submit" class="btn btn-default float-right" href="{{route('admin.products.purchase')}}">Back</a>--}}
    </div>

    </form>
    <!-- /.card-body -->
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
    <script src="{{asset('SuperAdmin/plugins/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('SuperAdmin/sweetalert2/dist/sweetalert.min.js')}}"></script>

    <script type="text/javascript">

        $(function () {
            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })

        });

        var ingredient_id_container = [];
        var suffix = 0;
        var tab_index = 0;
        var currency = '&#2547;';
        $('#ingredient').change(function () {
            var ingredient = $('#ingredient').val();
            if (ingredient != '') {
                var ingredient_details_array = ingredient.split('|');


                var index = ingredient_id_container.indexOf(ingredient_details_array[0]);

                if (index > -1) {
                    swal({
                        title: "<?php echo 'Warning'; ?>!",
                        text: "<?php echo 'Item Already Exists!'; ?>",
                        confirmButtonText: '<?php echo 'ok'; ?>',
                        confirmButtonColor: '#3c8dbc'
                    });
                    $('#ingredient_id').val('').change();
                    return false;
                }

                suffix++;
                tab_index++;

                var cart_row = '<tr class="rowCount text-center" data-id="' + suffix + '" id="row_' + suffix + '">' +
                    '<td style="padding-left: 10px;"><p id="sl_' + suffix + '">' + suffix + '</p></td>' +
                    '<td class="font-weight-bold"><span style="padding-bottom: 5px;">' + ingredient_details_array[1] + '</span></td>' +
                    '<input type="hidden" id="ingredient_id_' + suffix + '" name="ingredient_id[]" value="' + ingredient_details_array[0] + '"/>' +
                    '<td><input type="text" tabindex="' + tab_index + '" id="unit_price_' + suffix + '" name="unit_price[]" onfocus="this.select();" class="form-control aligning" placeholder="Unit Price"/ value="' + ingredient_details_array[2] + '" onkeyup="return calculateAll();"/><span class="label_aligning">' + currency + '</span></td>' +
                    '<td><input type="text" data-countID="' + suffix + '" tabindex="' + tab_index + 1 + '" id="description_' + suffix + '" name="description[]" onfocus="this.select();" class="form-control integerchk aligning countID aligning"  onkeyup="return calculateAll();" ><span class="label_aligning text-info">' + ingredient_details_array[3] + '</span></td>' +
                    '<td><input type="text" id="total_' + suffix + '" name="total[]" class="form-control aligning text-right font-weight-bold" placeholder="Total" readonly /><span class="label_aligning">' + currency + '</span></td>' +
                    '<td><a class="btn btn-danger btn-xs" style="margin-left: 5px; margin-top: 10px;" onclick="return deleter(' + suffix + ',' + ingredient_details_array[0] + ');" ><i style="color:white" class="fa fa-trash"></i> </a></td>' +
                    '</tr>';
                tab_index++;

                $('#purchase_cart tbody').append(cart_row);

                ingredient_id_container.push(ingredient_details_array[0]);
                $('#ingredient').val('').change();
                calculateAll();


            }
        });


        function calculateAll() {
            var subtotal = 0;
            var i = 1;
            $(".rowCount").each(function () {
                var id = $(this).attr("data-id");
                var unit_price = $("#unit_price_" + id).val();
                var temp = "#sl_" + id;
                $(temp).html(i);
                i++;
                var quantity_amount = 1;
                if ($.trim(unit_price) == "" || $.isNumeric(unit_price) == false) {
                    unit_price = 0;
                }
                if ($.trim(quantity_amount) == "" || $.isNumeric(quantity_amount) == false) {
                    quantity_amount = 0;
                }

                var quantity_amount_and_unit_price = parseFloat($.trim(unit_price)) * parseFloat($.trim(quantity_amount));

                $("#total_" + id).val(quantity_amount_and_unit_price.toFixed(2));
                subtotal += parseFloat($.trim($("#total_" + id).val()));
            });


            if (isNaN(subtotal)) {
                subtotal = 0;
            }


            $("#subtotal").val(subtotal);

            var other = parseFloat($.trim($("#other").val()));

            if ($.trim(other) == "" || $.isNumeric(other) == false) {
                other = 0;
            }

            var grand_total = parseFloat(subtotal) + parseFloat(other);

            grand_total = grand_total.toFixed(2);

            $("#grand_total").val(grand_total);

            var paid = $("#paid").val();

        }


        function deleter(suffix, ingredient_id) {


            swal({
                title: "<?php echo 'Warning'; ?>",//lang
                text: "<?php echo 'Are you sure want to delete?'; ?>?",//lang
                confirmButtonColor: '#3c8dbc',
                cancelButtonText: '<?php echo 'Cancel'; ?>',//lang
                confirmButtonText: '<?php echo 'Ok'; ?>',//lang
                showCancelButton: true
            }, function () {


                $("#row_" + suffix).remove();
                $("#paid").val('');
                var ingredient_id_container_new = [];
                for (var i = 0; i < ingredient_id_container.length; i++) {
                    if (ingredient_id_container[i] != ingredient_id) {
                        ingredient_id_container_new.push(ingredient_id_container[i]);
                    }
                }
                ingredient_id_container = ingredient_id_container_new;
                calculateAll();
            });
        }


        function validateForm() {
            var paid = $('#paid').val();
            if ($('#voucher_no').val() == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Voucher no is requred!',
                })
                return false;
            } else if ($('#supplier').val() == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Supplier is requred!',
                })
                return false;
            } else if ($('#date').val() == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Date is requred!',
                })
                return false;
            } else if (suffix < 1) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Ingredient is required!',
                })
                return false;
            } else if (suffix > 0) {

                for (var i = 1; i <= suffix; i++) {
                    if ($('#quantity_amount_' + i).val() == '') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Quantity of Ingredient ' + i + ' Must not be Empty!',
                        })
                        return false;
                    }
                }
            } else {
                return true;
            }


        }

    </script>
@endsection
