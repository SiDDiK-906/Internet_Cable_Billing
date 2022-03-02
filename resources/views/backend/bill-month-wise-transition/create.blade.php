@extends('backend.layouts.master')

@section('content')

    <div class="col-md-12 col-sm-10">

        <div class="row">
            <div class="col-md-12 col-sm-10">

                <div class="clearfix">
                    <div class="pull-right tableTools-container"></div>
                </div>

                {{-- Form Start --}}
                <form action="{{ route('store-bill-month-wise') }}" method="POST">
                    @csrf

                    {{-- Select Part --}}
                    <div class="form-group margin-top margin-bottom">
                        <div class="flex flex-position">
                            <div class="area">
                                <div class="label-position"><strong>Select Area</strong></div>
                                <div class="main-select">
                                    <select name="area" class="new-area" id="area">
                                        @if (Auth()->user()->type == 1)
                                            @if (staff_id_check(Auth()->id()) == NULL)
                                                <option value=""> You dont have any Staff Credential </option>
                                                <option disabled>{{ 'You dont have any Staff Credential' }}</option>

                                            @else

                                                <option value=""> Select a Area </option>
                                                <option value="{{ role(Auth()->user()->fk_staff_id)->id }}">{{ role(Auth()->user()->fk_staff_id)->area_name }}</option>

                                            @endif


                                        @else

                                            <option value=""> Select a Area </option>
                                            @foreach ($areas as $area)
                                                <option value="{{ $area->id }}">{{ $area->area_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="customers">
                                <div class="main-select">
                                    <div class="label-position"><strong>Select Customer Name</strong></div>

                                    <select name="customer_id" id="customer_name">
                                        <option value="">Select an Area First</option>
                                    </select>

                                </div>
                            </div>

                            <div class="date">
                                <div class="label-position"><strong>Date* :</strong></div>
                                <div class="my-date">
                                    <input type="date" name="date" id="datepicker">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Customer Details --}}
                    <div class="customer-details" id="customer-details" style="display: none">
                        <div class="row border">
                            {{-- <label style="margin-top: 10px; margin-left: 40%;"><h4>Customer Details</h4></label> --}}
                            <div class="main" style="display: flex; justify-content: space-evenly;">

                                <div class="col-lg-4 common common-1">
                                    <div class="form-group">
                                        <div for="" >Mobile Phone :  <strong class="customer_phone"><span id="customer_phone"></span></strong></div>
                                    </div>
                                    <div class="form-group">
                                        <div for="">Customer ID : <strong class="customer_id"><span id="customer_id"></span></strong></div>
                                    </div>
                                    <div class="form-group">
                                        <div for="">Line Package Name : <strong class="fk_line_id"><span id="fk_line_id"></span></strong></div>
                                    </div>
                                    <div class="form-group">
                                        <div for="">Line Amount : <strong class="line_amount">৳ <span id="line_amount"></span></strong></div>
                                    </div>
                                </div>

                                <div class="col-lg-4 common common-2">
                                    <div class="form-group">
                                        <div for="" >Customer Address : <strong class="customer_address"><span id="customer_address"></span></strong> </div>
                                    </div>
                                    <div class="form-group">
                                        <div for="">Area Name : <strong class="fk_area_id"><span id="fk_area_id"></span></strong></div>
                                    </div>
                                    <div class="form-group">
                                        <div for="">Staff Name : <strong class="fk_staff_id"><span id="fk_staff_id"></span></strong></div>
                                    </div>
                                    <div class="form-group">
                                        <div style="display: flex;">
                                            <span>Payment Method:</span>
                                            <div class="payment_method">
                                                <input type="radio" id="contactChoice1"name="payment_method" value="cash" style="cursor: pointer" checked>
                                                <label for="contactChoice1" style="cursor: pointer">Cash</label>

                                                <input type="radio" id="contactChoice2" name="payment_method" value="online" style="cursor: pointer">
                                                <label for="contactChoice2" style="cursor: pointer">Online</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>


                        {{-- Table Start --}}
                        <div class="tile " id="main-table">
                            <div class="tile-body">
                                <table class="table table-hover table-bordered datatable table-striped" id="tbl_posts">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Year</th>
                                            <th>Select Month</th>
                                            <th>Type</th>
                                            <th>Payble</th>
                                            @if (Auth()->user()->type == 0)
                                            <th>Discount</th>
                                            @endif
                                            <th>Paid</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbl_posts_body">
                                        <tr id="" class="mgrid">
                                            <td><span>1</span></td>

                                            <td class="new-select">
                                                <select name="year[]">
                                                    <option value=""> Select a Year </option>
                                                    @for($i= date("Y"); $i >= date("Y") - 3; $i--)
                                                        <option value="{{ $i }}" {{ old('year',date('Y')) == $i ? 'selected' : '' }}>{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </td>

                                            <td class="new-select">
                                                <select name="month[]">
                                                    <option value=""> Select a Month </option>
                                                    @for($i = 1; $i <= 12; $i++)

                                                        @php
                                                            $m = str_pad($i, 2, "0", STR_PAD_LEFT);
                                                            $month = date("Y-") . $m;
                                                        @endphp

                                                        <option value="{{ $i }}" {{ old('month',date('m')) == $m ? 'selected' : '' }}>{{ Carbon::parse($month)->format("F") }}</option>
                                                    @endfor
                                                </select>
                                            </td>

                                            <td class="new-select">
                                                <select name="transition_type[]" class="trans_types" onchange="updateCart(this)">
                                                    <option value="">Select a Type</option>
                                                    @foreach ($transition_types as $transition_type)
                                                        <option value="{{ $transition_type->id }}" data-cost_amount="{{ $transition_type->cost_amount }}">{{ $transition_type->cost_category_name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>

                                        {{-- payble amount --}}
                                            <td>
                                                <div class="flex">
                                                    <div class="div taka">
                                                        <span >৳</span>
                                                    </div>
                                                    <div class="payble">
                                                        <input type="text" value="0" class="form-control paybles" name="payble[]" readonly onkeyup="calculateTotal(this)">
                                                    </div>
                                                </div>
                                            </td>

                                        {{-- Discount --}}
                                            @if (Auth()->user()->type == 0)
                                                <td>
                                                    <div class="flex">
                                                        <div class="div taka">
                                                            <span >৳</span>
                                                        </div>
                                                        <input id="d_apply" onkeyup="calculateDiscounts(this)" onkeyup="discountTopaid(this)" type="text" value="0" class="form-control discountzzz" name="discount_amount[]" placeholder="Discount Amount">
                                                    </div>
                                                </td>
                                            @endif

                                        {{-- Paid Amount --}}
                                            <td>
                                                <div class="flex">
                                                    <div class="div taka">
                                                        <span >৳</span>
                                                    </div>
                                                    <input id="pa_apply" onkeyup="calculatePaid(this)" type="text" value="0" class="form-control paids_amountz" name="paid_amount[]" placeholder="Paid Amount">
                                                </div>
                                            </td>


                                            {{-- Remove Row --}}
                                            <td class="text-center flex" style="align-items: center;">
                                                <button type="button" class="ibtnDel btn btn-sm btn-danger delete_row" onclick="removeRow(this)"><i class="fa fa-trash"></i></button>
                                            </td>

                                        </tr>
                                    </tbody>
                                </table>

                                {{-- add more button --}}
                                <div class="clearfix">
                                    <a class="my-button pull-right add-record" style="cursor: pointer; width: 98px;"><i class="fa fa-plus"></i> Add row</a>
                                </div>


                                {{-- Down display part of accounts --}}
                                <div class="row gap">
                                    <div class="col-lg-7">
                                        <div class="form-group">
                                            <textarea  cols="20" rows="5" class="form-control">Dear Customer, Thank you for Paying the bill.</textarea>
                                        </div>
                                        <div class="form-group">
                                            <input type="checkbox" > <span>Send SMS</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="item " style="margin-top: -8px">
                                            <label for=""><strong>Total Amount</strong></label>
                                            <div class="flex">
                                                <div class="div taka">
                                                    <span >৳</span>
                                                </div>
                                                <div class="total_amount" style="width: 100%;">
                                                    <input name="total_amountd" type="text" class="form-control my-form padding-input" id="total_amount" value="0" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item margin">
                                            <label for=""><strong>Paid Amount</strong></label>
                                            <div class="flex">
                                                <div class="div taka">
                                                    <span >৳</span>
                                                </div>
                                                <input name="paid_amountd" id="paid_result" type="text" class="form-control my-form padding-input" value="0" readonly>
                                            </div>
                                        </div>
                                        @if (Auth()->user()->type == 0)
                                        <div class="item margin">
                                            <label for=""><strong>Discount Amount</strong></label>
                                            <div class="flex">
                                                <div class="div taka">
                                                    <span >৳</span>
                                                </div>
                                                <input name="discount_amountd" id="discount_result" type="text" class="keyup-paste form-control my-form padding-input" value="0" readonly>
                                            </div>
                                        </div>
                                        @endif
                                        <div class="item margin">
                                            <label for=""><strong>Due Amount</strong></label>
                                            <div class="flex">
                                                <div class="div taka">
                                                    <span >৳</span>
                                                </div>
                                                <input name="due_amountd" id="due_amount"type="text" class="form-control my-form padding-input" value="0" readonly>
                                            </div>
                                        </div>
                                        <div class="confirm-button">
                                            <button type="submit" class="my-button generate-button" id="confirm-btn">Confirm</button>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>


@endsection
@section('scripts')
<script src="{{ asset('assets/backend/js/jquery-1.12.4.min.js') }}"></script>
<script src="{{ asset('assets/backend/js/select2.min.js') }}"></script>
<script>



    /*
    |--------------------------------------------------------------------------
    | get customer name ajax METHOD
    |--------------------------------------------------------------------------
    */
    $(document).ready(function() {

        $('#customer_name span').prop('disabled',true);

        $('#customer_name').select2();

        $('#area').change(function(){
            // $('#customer_name').attr('disabled',false);

            var area_id = $(this).val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type:'POST',
                url:'/get/customer/name',
                data:{area_id:area_id},
                success:function(data){
                    $('#customer_name').html(data);

                }
            });

        });

    });




    /*
    |--------------------------------------------------------------------------
    | customer details METHOD
    |--------------------------------------------------------------------------
    */
    $(document).ready(function() {

        $('#customer_name').change(function(){

            $('#customer-details').attr('style','display: visible');

            var customer_id = $(this).val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type:'POST',
                url:'/get/customer/details',
                data:{customer_id:customer_id},
                success:function(data){

                    $('#customer-details').attr('style','display: visible');
                    $('#main-table').attr('style','display: visible');

                    $('#cust_name').html(data.customer_name);
                    $('#customer_email').html(data.customer_email);
                    $('#customer_address').html(data.customer_address);
                    $('#customer_phone').html(data.customer_phone);
                    $('#fk_line_id').html(data.fk_line_id);
                    $('#fk_area_id').html(data.fk_area_id);
                    $('#fk_staff_id').html(data.fk_staff_id);
                    $('#line_amount').html(data.line_amount);
                    $('#customer_due').html(data.customer_due);
                    $('#total_paid').html(data.total_paid);
                    // $('#bill_start_date').html(data.bill_start_date);
                    // $('#connection_date').html(data.connection_date);
                    $('#customer_id').html(data.customer_id);


                }
            });
        });

    });





    /*
    |--------------------------------------------------------------------------
    | ADD MORE ROW METHOD
    |--------------------------------------------------------------------------
    */
    jQuery(document).delegate('a.add-record', 'click', function(e) {

        e.preventDefault();

        let show_tr = `
                    <tr class="mgrid">
                        <td><span class="serial_tr"></span></span></td>
                        <td class="new-select">
                            <select name="year[]">
                                <option value=""> Select a Year </option>
                                @for($i= date("Y"); $i >= date("Y") - 3; $i--)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </td>
                        <td class="new-select">
                            <select name="month[]" class="month_btn">
                                <option value=""> Select a Month </option>
                                @for($i = 1; $i <= 12; $i++)

                                    @php
                                        $m = str_pad($i, 2, "0", STR_PAD_LEFT);
                                        $month = date("Y-") . $m;
                                    @endphp

                                    <option value="{{ $i }}">{{ Carbon::parse($month)->format("F") }}</option>
                                @endfor
                            </select>
                        </td>


                        <td class="new-select">
                            <select name="transition_type[]" class="trans_types" onchange="updateCart(this)">
                                <option value="">Select a Type</option>
                                @foreach ($transition_types as $transition_type)
                                    <option value="{{ $transition_type->id }}" data-cost_amount="{{ $transition_type->cost_amount }}">{{ $transition_type->cost_category_name }} </option>
                                @endforeach
                            </select>
                        </td>


                        <td>
                            <div class="flex">
                                <div class="div taka">
                                    <span >৳</span>
                                </div>
                                <div>
                                    <input type="text" value="0" class="form-control paybles" name="payble[]" readonly onkeyup="calculateTotal(this)">
                                </div>
                            </div>
                        </td>


                        @if (Auth()->user()->type == 0)
                            <td>
                                <div class="flex">
                                    <div class="div taka">
                                        <span >৳</span>
                                    </div>
                                    <input id="d_apply" onkeyup="calculateDiscounts(this)" onkeyup="discountTopaid(this)" type="text" value="0" class="form-control discountzzz" name="discount_amount[]" placeholder="Discount Amount">
                                </div>
                            </td>
                        @endif

                        <td>
                            <div class="flex">
                                <div class="div taka">
                                    <span >৳</span>
                                </div>
                                <input id="pa_apply" onkeyup="calculatePaid(this)" type="text" value="0" class="form-control paids_amountz" name="paid_amount[]" placeholder="Paid Amount">
                            </div>
                        </td>

                        <td class="text-center flex" style="align-items: center;">
                            <button type="button" class="ibtnDel btn btn-sm btn-danger delete_row" onclick="removeRow(this)"><i class="fa fa-trash"></i></button>
                        </td>

                    </tr>
        `;






        $('#tbl_posts_body').append(show_tr);

        $('.serial_tr').map(function(index, value) {
            $(this).text(index + 2);
        })

        size = jQuery('#tbl_posts >tbody >tr').length + 1,

        element = null,
        element = content.clone();
        element.attr('id', 'rec-'+size);
        element.find('.delete-record').attr('data-id', size);
        element.appendTo('#tbl_posts_body');


    });



    /*
    |--------------------------------------------------------------------------
    | TRANSACTION TYPE  to  PAYBLE
    |--------------------------------------------------------------------------
    */
    $(document).ready(function(){

        $('.trans_type').change(function(){

            var trans_id = $(this).val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type:'POST',
                url:'/get/payment/amount',
                data:{trans_id:trans_id},
                success:function(data){
                    $('.payble').html(data.all_payble);
                    // $('.total_amount').html(data.total_amount);
                    calculateTotal();
                    calculateDiscounts();
                    calculatePaid();
                    updateCart();
                    getTotalDue();
                    discountTopaid()
                }
            });

        })


    });





    /*
    |--------------------------------------------------------------------------
    | calculateTotalDue METHOD
    |--------------------------------------------------------------------------
    */


        function getTotalDue(){

            total_amount =  parseFloat($('#total_amount').val());
            discount_result =  parseFloat($('#discount_result').val());
            paid_result = parseFloat($('#paid_result').val());

            let total_paid = paid_result + discount_result;

            let final_due = total_amount - total_paid;

            $('#due_amount').val(final_due);
            discountTopaid()
        }




    /*
    |--------------------------------------------------------------------------
    | calculateTotal METHOD
    |--------------------------------------------------------------------------
    */
    function calculateTotal() {

        let grand_total_amount = 0

        $('.paybles').each(function() {

            grand_total_amount += Number($(this).val());
            getTotalDue();
            discountTopaid()

        })

        $('#total_amount').val(grand_total_amount)

        calculateDiscounts();
        calculatePaid();
        updateCart();
        getTotalDue();
        discountTopaid()
    }




    /*
    |--------------------------------------------------------------------------
    | calculateDiscounts METHOD
    |--------------------------------------------------------------------------
    */
    function calculateDiscounts() {

        let grand_total_amount = 0

        $('.discountzzz').each(function() {

            grand_total_amount += Number($(this).val());
            getTotalDue();
            discountTopaid()

        })

        $('#discount_result').val(grand_total_amount)

        calculateTotal();
        calculatePaid();
        updateCart();
        getTotalDue();
        discountTopaid()
    }




    /*
    |--------------------------------------------------------------------------
    | calculatePaid METHOD
    |--------------------------------------------------------------------------
    */
    function calculatePaid() {

        let grand_total_amount = 0

        $('.paids_amountz').each(function() {

            grand_total_amount += Number($(this).val());
            getTotalDue();
            discountTopaid()

        })

        $('#paid_result').val(grand_total_amount)

        calculateDiscounts();
        calculateTotal();
        updateCart();
        getTotalDue();
        discountTopaid()
    }





    /*
    |--------------------------------------------------------------------------
    | discountTopaid METHOD
    |--------------------------------------------------------------------------
    */
    function discountTopaid() {

        // var x = document.getElementById("d_apply").value;
        // document.getElementById("pa_apply").value=x;

        // let discount =  $("#d_apply").val();

        // $('#pa_apply').val(discount);


    }






    /*
    |--------------------------------------------------------------------------
    | UPDATECART METHOD
    |--------------------------------------------------------------------------
    */
    function updateCart(object) {


        let _this = $(object).closest('tr');


        var cost_amount = _this.find('.trans_types').find(':selected').data('cost_amount');


        if (cost_amount != 0) {

            _this.find('.paybles').val(cost_amount);

            calculateTotal();
            calculateDiscounts();
            calculatePaid();
            getTotalDue();
            discountTopaid()
        }
        else{

            var trans_id = _this.find('.trans_types').find(':selected').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type:'POST',
                url:'/get/payment/amounts',
                data:{trans_id:trans_id},
                success:function(data){

                    _this.find('.paybles').val(data.all_payble);

                    calculateTotal();
                    calculateDiscounts();
                    calculatePaid();
                    getTotalDue();
                    discountTopaid()
                }
            });

        }



    }




/*
    |--------------------------------------------------------------------------
    | REMOVE ROW METHOD
    |--------------------------------------------------------------------------
    */
    function removeRow(object) {

        if ($('#tbl_posts tr').length > 1) {

            $(object).closest("tr").remove()

        }
        calculateTotal();
        calculateDiscounts();
        calculatePaid();
        updateCart();
        getTotalDue();
        discountTopaid()
    }








    /*
    |--------------------------------------------------------------------------
    | datepicker for current date METHOD
    |--------------------------------------------------------------------------
    */
    var now = new Date();
    var day = ("0" + now.getDate()).slice(-2);
    var month = ("0" + (now.getMonth() + 1)).slice(-2);
    var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
    $('#datepicker').val(today);








    /*
    |--------------------------------------------------------------------------
    | delete button in table METHOD
    |--------------------------------------------------------------------------
    */
    jQuery(document).delegate('a.delete-record', 'click', function(e) {
        e.preventDefault();
        var didConfirm = confirm("Are you sure You want to delete");

        if (didConfirm == true) {
            var id = jQuery(this).attr('data-id');
            var targetDiv = jQuery(this).attr('targetDiv');
            jQuery('#rec-' + id).remove();

            //regnerate index number on table
            $('#tbl_posts_body tr').each(function(index) {
            //alert(index);
            $(this).find('span.sn').html(index+1);
            });
            return true;
        }
        else {
            return false;
        }
        calculateTotal();
        calculateDiscounts();
        calculatePaid();
        updateCart();
    });






    /*
    |--------------------------------------------------------------------------
    | SERIAL METHOD
    |--------------------------------------------------------------------------
    */
    // function serial() {
        //     $('.serial_tr').map(function(index, value) {
        //         $(this).text(index + 1);
        //     })
    // }





</script>

{{-- /*
|--------------------------------------------------------------------------
| On Key Up Example
|--------------------------------------------------------------------------
*/ --}}
<script>
    // on keyup
    // function myFunction() {

    //     var x = document.getElementById("d_apply").value;
    //     document.getElementById("d_result").value=x;


    //     var x = document.getElementById("pa_apply").value;
    //     document.getElementById("pa_result").value=x;

    // }
</script>

@endsection
