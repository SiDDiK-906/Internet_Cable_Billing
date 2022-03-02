@extends('backend.layouts.master')

@section('content')
    <div class="col-md-12 col-sm-10">
        {{-- <div style=" text-align:right;" class="add-slider">
            <a class="btn btn-primary icon-btn" href="#"><i class="fa fa-plus"></i> Add New
                Bill Payment
            </a>
        </div> --}}

        <div class="row">
            <div class="col-md-12 col-sm-10">

                {{-- <h3 class="header smaller lighter blue">Add New Slider</h3> --}}

                <div class="clearfix">
                    <div class="pull-right tableTools-container"></div>
                </div>

                {{-- <div class="table-header">
                    <div class="add-slider"><i class="fa fa-bars" aria-hidden="true"></i>
                        Month Wise Transition
                    </div>
                    <div class="right-side">
                        <a href="{{ route('create-bill-month-wise') }}" style="text-decoration: none; color:white"><i class="fa fa-plus" aria-hidden="true" style="margin-right: 5px"></i>Add New Bill Payment</a>
                    </div>
                </div> --}}

                <div class="form-group margin-top margin-bottom">
                    <form action="{{ route('view-bill-month-wise-get') }}" method="GET">
                        @csrf
                        @php
                            $carbon = \Carbon\Carbon::today();
                        @endphp
                        <div class="flex flex-position">

                            <div class="year">
                                <div class="label-position"><strong>Select Year</strong></div>
                                <div class="main-select month-wise month-wise2">
                                    <select name="year">
                                        <option value=""> Select a Year </option>

                                        @for($i= date('Y'); $i >= date('Y') - 3; $i--)
                                            <option value="{{ $i }}" {{ old('year',date('Y')) == $i ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor

                                    </select>
                                </div>
                            </div>

                            <div class="month">
                                <div class="label-position"><strong>Select Month</strong></div>

                                <div class="main-select month-wise month-wise2">
                                    <select name="month">
                                        <option value=""> Select a Month </option>
                                        @for($i = 1; $i <= 12; $i++)

                                            @php
                                                $m = str_pad($i, 2, "0", STR_PAD_LEFT);
                                                $month = date('Y-') . $m;
                                            @endphp

                                            <option value="{{ $i }}" {{ old('month',date('m')) == $m ? 'selected' : '' }}>{{ Carbon::parse($month)->format('F') }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>

                            <div class="area">
                                <div class="label-position"><strong>Select Area</strong></div>
                                <div class="main-select month-wise2">
                                    <select name="area" class="new-area" id="area_button">
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
                                {{-- <select name="js-example-basic-single customer_id" id="customer_button">
                                    <option value="">Select an Area First</option>
                                </select> --}}
                                <div class="main-select">

                                    <div class="label-position"><strong>Select Customer Name</strong></div>

                                    <select name="customer_id" id="customer_button">
                                        <option value="">Select an Area First</option>
                                    </select>

                                </div>
                            </div>

                            <div class="condition">
                                <div class="label-position"><strong>Condition</strong></div>
                                <div class="main-select month-wise month-wise2">
                                    <select name="condition">
                                        {{-- <option value=""> Select a Condition </option> --}}
                                        <option value="all">All</option>
                                        <option value="paid">Paid</option>
                                        <option value="unpaid">Unpaid</option>
                                    </select>
                                </div>
                            </div>
                            {{-- <div class="sms-type">
                                <div class="label-position"><strong>SMS Type</strong></div>
                                <div class="main-select month-wise">
                                    <select name="sms_type">
                                        <option value=""> Select a Type </option>
                                        <option value="with_sms">With SMS</option>
                                        <option value="without_sms">Without SMS</option>
                                    </select>
                                </div>
                            </div> --}}

                            @if (Auth()->user()->type == 1)

                                @if (staff_id_check(Auth()->id()) == NULL)

                                <button class="my-button border-radius button-position month-wise-button-position month-wise-button-position2" disabled>Confirm</button>

                                @else

                                <button type="submit" class="my-button border-radius button-position month-wise-button-position month-wise-button-position2">Confirm</button>

                                @endif

                            @else
                            <button type="submit" class="my-button border-radius button-position month-wise-button-position month-wise-button-position2">Confirm</button>
                            @endif

                        </div>

                        <div class="flex flex-down flex-position down-part">
                            {{-- <div class="sms-template">
                                <label for=""><strong>Currently Used SMS Template</strong></label>
                                <textarea name="sms_message" class="form-control">Dear Customer, Thank you for paying monthly bill. Your monthly bill has been paid - CCTN.</textarea>
                            </div> --}}
                                {{-- @if (Auth()->user()->type == 1)

                                    @if (staff_id_check(Auth()->id()) == NULL)

                                    <button class="my-button border-radius button-position month-wise-button-position" disabled>Confirm</button>

                                    @else

                                    <button type="submit" class="my-button border-radius button-position month-wise-button-position">Confirm</button>

                                    @endif

                                @else
                                <button type="submit" class="my-button border-radius button-position month-wise-button-position">Confirm</button>
                                @endif --}}

                        </div>

                    </form>
                </div>

                @if ($bills_multi_month == '0')
                    <tbody>
                        <tr>
                            <td colspan="50">

                            </td>
                        </tr>
                    </tbody>
                @else
                    @if ($bills_multi_month->count() == 0)
                        <tbody>
                            <tr>
                                <td colspan="50">
                                    <div class="alert alert-danger text-center">
                                        <span class="text-danger"> No Data To Show </span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    @else
                    <form action="{{ route('multipleupdate-bill-month-wise') }}" method="POST">
                        @csrf
                        {{-- <div class="text-right" style="margin-bottom: 10px">
                            <button class="my-button generate-button" type="submit">Paid All</button>
                        </div> --}}
                        {{-- @if (Session::get('condition_session') == 'unpaid')
                            <div class="text-right" style="margin-bottom: 10px">
                                <button class="my-button generate-button" type="submit">Unpaid All</button>
                            </div>
                        @endif --}}
                        <div class="tile ">
                            <div class="tile-body">
                                <table class="table table-hover table-bordered datatable table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Year</th>
                                            <th>Month</th>
                                            <th>Payment Type</th>
                                            <th>Customer Id</th>
                                            <th>Customer Name</th>
                                            <th>Customer Phone</th>
                                            <th>Due Amount</th>
                                            <th>
                                                <span class="paid_due">Paid/Due</span>
                                            </th>
                                            {{-- <th>
                                                <div class="custom-checkbox">
                                                    <input type="checkbox" id="selectAll">
                                                </div>
                                            </th> --}}
                                        </tr>
                                    </thead>
                                        <tbody>


                                            @foreach ($bills_multi_month as $bill_multi_month)
                                                <tr>
                                                    <td>{{ $loop->index+1 }}</td>
                                                    <td>{{ $bill_multi_month->year }}</td>
                                                    <td>
                                                        @if ($bill_multi_month->month == 1)
                                                            January
                                                        @elseif ($bill_multi_month->month == 2)
                                                            February
                                                        @elseif ($bill_multi_month->month == 3)
                                                            March
                                                        @elseif ($bill_multi_month->month == 4)
                                                            April
                                                        @elseif ($bill_multi_month->month == 5)
                                                            May
                                                        @elseif ($bill_multi_month->month == 6)
                                                            June
                                                        @elseif ($bill_multi_month->month == 7)
                                                            July
                                                        @elseif ($bill_multi_month->month == 8)
                                                            August
                                                        @elseif ($bill_multi_month->month == 9)
                                                            September
                                                        @elseif ($bill_multi_month->month == 10)
                                                            October
                                                        @elseif ($bill_multi_month->month == 11)
                                                            November
                                                        @else
                                                            December
                                                        @endif
                                                    </td>
                                                    <td>{{ $bill_multi_month->line_transition_type->cost_category_name ?? ''}}</td>
                                                    <td>{{ $bill_multi_month->Bill_Generate->customer->customer_id }}</td>
                                                    <td>{{ $bill_multi_month->Bill_Generate->customer->customer_name }}</td>
                                                    <td>{{ $bill_multi_month->Bill_Generate->customer->customer_phone }}</td>
                                                    <td>{{ $bill_multi_month->Bill_Generate->due_amount }}</td>
                                                    <td id="mainBtn_td{{ $bill_multi_month->id }}" class="text-center main_td{{ $bill_multi_month->id }}">
                                                        @if ($bill_multi_month->month_wise_paid != 0)
                                                            <option class="btn btn-sm btn-info paid_btn" value="{{ $bill_multi_month->id }}">Paid</option>
                                                        @else
                                                            <option class="btn btn-sm btn-danger unpaid_btn" value="{{ $bill_multi_month->id }}">Unpaid</option>
                                                        @endif
                                                    </td>
                                                    {{-- <td>
                                                        <div class="position_input">
                                                            <input type="checkbox" name="bill_multi_month_id[]" value="{{ $bill_multi_month->id }}">
                                                        </div>
                                                    </td> --}}
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </form>
                                </table>
                                {{-- {{ $bills_multi_month->links() }} --}}
                            </div>
                        </div>
                    @endif
                @endif

            </div>
        </div>
    </div>


@endsection
@section('scripts')

<script src="{{ asset('assets/backend/js/jquery-1.12.4.min.js') }}"></script>



{{--
|--------------------------------------------------------------------------
| Chosen Scripts
|--------------------------------------------------------------------------
--}}
<script type="text/javascript">

// $(".chosen-select").chosen();

    // jQuery(function($){

        //     if(!ace.vars['touch']) {
        //         $('.chosen-select').chosen({allow_single_deselect:true});
        //         //resize the chosen on window resize

        //         $(window)
        //             .off('resize.chosen')
        //             .on('resize.chosen', function() {
        //                 $('.chosen-select').each(function() {
        //                     var $this = $(this);
        //                     $this.next().css({'width': $this.parent().width()});
        //                 })
        //             }).trigger('resize.chosen');
        //         //resize chosen on sidebar collapse/expand
        //         $(document).on('settings.ace.chosen', function(e, event_name, event_val) {
        //             if(event_name != 'sidebar_collapsed') return;
        //             $('.chosen-select').each(function() {
        //                 var $this = $(this);
        //                 $this.next().css({'width': $this.parent().width()});
        //             })
        //         });


        //         $('#chosen-multiple-style .btn').on('click', function(e){
        //             var target = $(this).find('input[type=radio]');
        //             var which = parseInt(target.val());
        //             if(which == 2) $('#form-field-select-4').addClass('tag-input-style');
        //             else $('#form-field-select-4').removeClass('tag-input-style');
        //         });
        //     }

    // })

</script>


{{--
|--------------------------------------------------------------------------
| Get Customer Name
|--------------------------------------------------------------------------
--}}
<script>

    $(document).ready(function() {

        // $('#customer_button').select2();

        $('#area_button').change(function(){

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
                    $('#customer_button').html(data);
                }
            });

        });

    });

</script>




{{--
|--------------------------------------------------------------------------
| Paid & Unpaid ajax
|--------------------------------------------------------------------------
--}}
<script>

    $(document).ready(function(){


        // catching id
        $('.unpaid_btn').click(function(){
            var id = $(this).val();

            // ajax basic start
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // ajax custom start
            $.ajax({
                type:'POST',
                url:'/get/id/data',
                data:{id:id},
                success:function(data){
                    $('.main_td'+id).html(data);
                }
            });
        });

        // for paid
        $('.paid_btn').click(function(){
            var id = $(this).val();

            // ajax basic start
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // ajax custom start
            $.ajax({
                type:'POST',
                url:'/get/paid/id/data',
                data:{id:id},
                success:function(data){
                    $('.main_td'+id).html(data);
                }
            });
        });


    });

</script>
@endsection
