@extends('backend.layouts.master')

@section('content')

    <div class="col-md-12 col-sm-10">

        <div class="row">
            <div class="col-md-12 col-sm-10">


                <div class="clearfix">
                    <div class="pull-right tableTools-container"></div>
                </div>

                {{-- Form Start --}}
                <form action="{{ route('update-bill-payment',$bill_generate_id) }}" method="POST">
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

                                                <option value="{{ role(Auth()->user()->fk_staff_id)->id }}"  {{ $area->id == $bill_month_wise->fk_area_id ? 'selected' : ''}}>{{ role(Auth()->user()->fk_staff_id)->area_name }}</option>

                                            @endif


                                        @else

                                            @foreach ($areas as $area)
                                                <option value="{{ $area->id }}" {{ $area->id == $bill_month_wise->fk_area_id ? 'selected' : ''}}>{{ $area->area_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="customers">
                                <div class="main-select">
                                    <div class="label-position"><strong>Select Customer Name</strong></div>

                                    <select name="customer_id" id="customer_name">
                                        <option value="{{ $customer->id }}">{{ $customer->customer_name }}</option>
                                    </select>

                                </div>
                            </div>

                            <div class="date">
                                <div class="label-position"><strong>Date* :</strong></div>
                                <div class="my-date">
                                    <input type="date" name="date" value="{{ $bill_generate->payment_date }}">
                                </div>
                            </div>
                        </div>
                    </div>


                    {{-- Customer Details --}}
                    <div class="customer-details" id="customer-details">
                        <div class="row border">
                            {{-- <label style="margin-top: 10px; margin-left: 40%;"><h4>Customer Details</h4></label> --}}
                            <div class="main"  style="display: flex; justify-content: space-evenly;">

                                <div class="col-lg-4 common common-1">
                                    <div class="form-group">
                                        <div for="" >Mobile Phone :  <strong class="customer_phone"><span id="customer_phone">{{ $customer->customer_phone }}</span></strong></div>
                                    </div>
                                    <div class="form-group">
                                        <div for="">Customer ID : <strong class="customer_id"><span id="customer_id">{{ $customer->customer_id }}</span></strong></div>
                                    </div>
                                    <div class="form-group">
                                        <div for="">Line Package Name : <strong class="fk_line_id"><span id="fk_line_id">{{ $line_info->line_name }}</span></strong></div>
                                    </div>
                                    <div class="form-group">
                                        <div for="">Line Amount : <strong class="line_amount">৳ <span id="line_amount">{{ $line_info->line_amount }}</span></strong></div>
                                    </div>
                                </div>

                                <div class="col-lg-4 common common-2">
                                    <div class="form-group">
                                        <div for="" >Customer Address : <strong class="customer_address"><span id="customer_address">{{ $customer->address }}</span></strong> </div>
                                    </div>
                                    <div class="form-group">
                                        <div for="">Area Name : <strong class="fk_area_id"><span id="fk_area_id">{{ $area_info->area_name }}</span></strong></div>
                                    </div>
                                    <div class="form-group">
                                        <div for="">Staff Name : <strong class="fk_staff_id"><span id="fk_staff_id">{{ $staff_info->staff_name }}</span></strong></div>
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
                                            {{-- <th class="text-center">Action</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody id="tbl_posts_body">
                                        <tr id="" class="mgrid">
                                            <td><span>1</span></td>

                                            <td class="new-select">
                                                <select name="year">
                                                    <option value="{{ $bill_month_wise->year }}">{{ $bill_month_wise->year }}</option>

                                                    @for($i= date("Y"); $i >= date("Y") - 3; $i--)
                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </td>

                                            <td class="new-select">
                                                <select name="month">
                                                    @for($i = 1; $i <= 12; $i++)

                                                        @php
                                                            $m = str_pad($i, 2, "0", STR_PAD_LEFT);
                                                            $month = date("Y-") . $m;
                                                        @endphp

                                                        <option value="{{ $i }}" {{ $bill_month_wise->month == $m ? 'selected' : '' }}>{{ Carbon::parse($month)->format("F") }}</option>
                                                    @endfor
                                                </select>
                                            </td>

                                            <td class="new-select">
                                                <select name="transition_type" class="trans_types" onchange="updateCart(this)">
                                                    @foreach ($transition_types as $transition_type)
                                                        <option value="{{ $transition_type->id }}" data-cost_amount="{{ $transition_type->cost_amount }}"  {{ $bill_month_wise->fk_transition_type_id == $transition_type->id ? 'selected' : '' }}>{{ $transition_type->cost_category_name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>


                                            <td>
                                                <div class="flex">
                                                    <div class="div taka">
                                                        <span >৳</span>
                                                    </div>
                                                    <div class="payble">
                                                        <input type="text" value="{{ $bill_month_wise->month_wise_amount }}" class="form-control paybles" name="payble" readonly>
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
                                                        <input id="d_apply" onkeyup="myFunction()" type="text" value="{{ $bill_month_wise->discount }}" class="form-control " name="discount_amount" placeholder="Discount Amount">
                                                    </div>
                                                </td>
                                            @endif

                                            {{-- Paid Amount --}}
                                            <td>
                                                <div class="flex">
                                                    <div class="div taka">
                                                        <span >৳</span>
                                                    </div>
                                                    <input id="pa_apply" onkeyup="myFunction()" type="text" value="{{ $bill_month_wise->month_wise_paid }}" class="form-control" name="paid_amount" placeholder="Paid Amount">
                                                </div>
                                            </td>


                                            {{-- Remove Row --}}
                                            {{-- <td class="text-center flex" style="align-items: center;">
                                                <button type="button" class="ibtnDel btn btn-sm btn-danger delete_row" onclick="removeRow(this)"><i class="fa fa-trash"></i></button>
                                            </td> --}}

                                        </tr>
                                    </tbody>
                                </table>

                                {{-- add more button --}}
                                {{-- <div class="clearfix">
                                    <a class="my-button pull-right add-record" style="cursor: pointer; width: 98px;"><i class="fa fa-plus"></i> Add row</a>
                                </div> --}}


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
                                                    <input name="total_amountd" type="text" class="form-control my-form padding-input" id="total_amount" value="{{ $bill_month_wise->month_wise_amount }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="item margin">
                                            <label for=""><strong>Paid Amount</strong></label>
                                            <div class="flex">
                                                <div class="div taka">
                                                    <span >৳</span>
                                                </div>
                                                <input name="paid_amountd" id="pa_result" type="text" class="form-control my-form padding-input" value="{{ $bill_month_wise->month_wise_paid }}" readonly>
                                            </div>
                                        </div>
                                        @if (Auth()->user()->type == 0)
                                        <div class="item margin">
                                            <label for=""><strong>Discount Amount</strong></label>
                                            <div class="flex">
                                                <div class="div taka">
                                                    <span >৳</span>
                                                </div>
                                                <input name="discount_amountd" id="d_result" type="text" class="keyup-paste form-control my-form padding-input" value="{{ $bill_month_wise->discount }}" readonly>
                                            </div>
                                        </div>
                                        @endif
                                        <div class="item margin">
                                            <label for=""><strong>Due Amount</strong></label>
                                            <div class="flex">
                                                <div class="div taka">
                                                    <span >৳</span>
                                                </div>
                                                <input id="tdue_amount" name="due_amountd" type="text" class="form-control my-form padding-input" value="{{ $bill_month_wise->month_wise_amount - $bill_month_wise->month_wise_paid }}" readonly>
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





    // get customer name ajax
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






// customer details
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
                            <select name="year">
                                <option value=""> Select a Year </option>
                                @for($i= date("Y"); $i >= date("Y") - 3; $i--)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </td>
                        <td class="new-select">
                            <select name="month" class="month_btn">
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
                            <select name="transition_type" class="trans_types" onchange="updateCart(this)">
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
                                    <input type="text" value="0" class="form-control paybles" name="payble" readonly>
                                </div>
                            </div>
                        </td>


                        @if (Auth()->user()->type == 0)
                            <td>
                                <div class="flex">
                                    <div class="div taka">
                                        <span >৳</span>
                                    </div>
                                    <input id="d_apply" onkeyup="myFunction()" type="text" value="0" class="form-control " name="discount_amount" placeholder="Discount Amount">
                                </div>
                            </td>
                        @endif
                        <td>
                            <div class="flex">
                                <div class="div taka">
                                    <span >৳</span>
                                </div>
                                <input id="pa_apply" onkeyup="myFunction()" type="text" value="0" class="form-control" name="paid_amount" placeholder="Paid Amount">
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
        total_due();

    });






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

                $('#total_amount').val(cost_amount);
                total_due();
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
                        $('#total_amount').val(data.total_amount);
                        total_due();

                    }
                });

            }




    }



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
                    $('.total_amount').html(data.total_amount);
                    total_due();
                }
            });

        })

    });




    /*
    |--------------------------------------------------------------------------
    | REMOVE ROW METHOD
    |--------------------------------------------------------------------------
    */
    function removeRow(object) {

        if ($('#tbl_posts tr').length > 1) {

            $(object).closest("tr").remove()

            calculateSubtotal()
        }
    }






    // delete button in table
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
    });





    // on change down part

    // $(document).ready(function(){
    //     $("#myInput").on("input", function(){
    //         $("#result").text($(this).val());
    //         getTotalDue();
    //     });
    // });







    // Data Entry + Duplicate entry checking by ajax
    $(document).ready(function(){

        $('.month_btn').change(function(){

            alert('working');

            // var month_id = $(this).val();

            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     }
            // });

            // $.ajax({
            //     type:'POST',
            //     url:'/get/month/id',
            //     data:{month_id:month_id},
            //     success:function(data){
            //         alert(month_id);
            //     }
            // });
        })

    });


    // datepicker for current date
    var now = new Date();
    var day = ("0" + now.getDate()).slice(-2);
    var month = ("0" + (now.getMonth() + 1)).slice(-2);
    var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
    $('#datepicker').val(today);






    // function calculateSubtotal() {

    //         let _this = $(object).closest('tr');

    //         var cost_amount = _this.find('.trans_types').find(':selected').data('cost_amount');

    //         _this.find('.paybles').val(cost_amount);

    //         $('#total_amount').val(cost_amount);

    //     }






</script>

{{-- On Key Up Js --}}
<script>
    // on keyup
    function myFunction() {

        var x = document.getElementById("d_apply").value;
        document.getElementById("d_result").value=x;
        // document.getElementById("pa_apply").value=x;

        var x = document.getElementById("pa_apply").value;
        document.getElementById("pa_result").value=x;

        total_due();



    }



    function total_due() {
        let total_amount = parseFloat($('#total_amount').val());
        let pa_result = parseFloat($('#pa_result').val());
        let d_result = parseFloat($('#d_result').val());

        let total_paid = pa_result + d_result;
        let total_due = total_amount - total_paid;

        $('#tdue_amount').val(total_due);

    }


</script>

@endsection
