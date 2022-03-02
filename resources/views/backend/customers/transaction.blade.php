@extends('backend.layouts.master')

@section('content')

    <div class="col-md-12 col-sm-10">
        {{-- <div style=" text-align:right;" class="add-slider">
            <a class="btn btn-primary icon-btn" href="{{ route('create-customer') }}"><i class="fa fa-plus"></i> Add New
                Customer
            </a>
        </div> --}}

        <div class="row">
            <div class="col-md-12 col-sm-10">

                <div class="clearfix">
                    <div class="pull-right tableTools-container"></div>
                </div>

                {{-- <div class="table-header" style="margin-bottom: 30px">
                    <div class="add-slider"><i class="fa fa-bars" aria-hidden="true"></i>
                        All Transaction Result for <strong>{{ $total_bills->first()->customer->customer_name }}</strong>
                    </div>
                </div> --}}

                <div class="accounts" style="margin-bottom: 10px">
                    <div class="title-header">
                        All Transaction Result for <strong>{{ $total_bills->first()->customer->customer_name }}</strong>
                    </div>
                    <div class="main flex">
                        <div class="left flex common">
                            <h5 class="b">Total Paid: </h5><h5>
                                <strong>@php
                                    $total_paid = 0;
                                @endphp

                                @foreach ($total_bills as $total_bill)

                                    @if ($total_bill->one_click == 0)
                                        @php
                                            $total_paid += $total_bill->month_wise_paid;
                                        @endphp
                                    @endif

                                @endforeach

                                @php
                                    echo $total_paid;
                                @endphp</strong>
                            </h5>
                        </div>
                        <div class="right flex common">
                            <h5 class="b">Total Due: </h5><h5>
                                <strong>@php
                                    $total_due = 0;
                                @endphp

                                @foreach ($total_bills as $total_bill)

                                    @if ($total_bill->one_click == 1)
                                        @php
                                            $total_due += $total_bill->month_wise_amount;
                                        @endphp
                                    @endif

                                @endforeach

                                @php
                                    echo $total_due;
                                @endphp</strong>
                            </h5>
                        </div>
                    </div>
                </div>

                <form action="{{ route('multipleupdate-bill-month-wise') }}" method="POST">
                    @csrf
                    {{-- <div class="text-right" style="margin-bottom: 10px">
                        <button class="my-button generate-button" type="submit">Paid All</button>
                    </div> --}}
                    <div class="tile ">
                        <div class="tile-body">
                            <table class="table table-hover table-bordered datatable table-striped dataTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Type</th>
                                        <th>Area</th>
                                        <th>Customer ID</th>
                                        <th>Customer Phone</th>
                                        <th>Customer Name</th>
                                        <th>Line</th>
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
                                    @forelse ($total_bills as $total_bill)
                                        <tr>
                                            <td>{{ $loop->index+1 }}</td>
                                            <td>
                                                @if ($total_bill->month == 1)
                                                    January
                                                @elseif($total_bill->month == 2)
                                                    February
                                                @elseif($total_bill->month == 3)
                                                    March
                                                @elseif($total_bill->month == 4)
                                                    April
                                                @elseif($total_bill->month == 5)
                                                    May
                                                @elseif($total_bill->month == 6)
                                                    June
                                                @elseif($total_bill->month == 7)
                                                    July
                                                @elseif($total_bill->month == 8)
                                                    August
                                                @elseif($total_bill->month == 9)
                                                    September
                                                @elseif($total_bill->month == 10)
                                                    October
                                                @elseif($total_bill->month == 11)
                                                    November
                                                @else{
                                                    December
                                                }
                                                @endif
                                                ,{{ $total_bill->year }}
                                            </td>
                                            <td> {{ $total_bill->line_transition_type->cost_category_name ?? ''}}</td>
                                            <td> {{ $total_bill->Area->area_name }} </td>
                                            <td> {{ $total_bill->customer->customer_id ?? ''}}</td>
                                            <td> {{ $total_bill->customer->customer_phone ?? ''}}</td>
                                            <td> {{ $total_bill->customer->customer_name ?? ''}}</td>
                                            <td> {{ $total_bill->customer->lineCategories->line_name ?? ''}}</td>

                                            <td id="mainBtn_td{{ $total_bill->id }}" class="text-center main_td{{ $total_bill->id }}">
                                                @if ($total_bill->one_click == 0)
                                                    <option class="btn btn-sm btn-info paid_btn" value="{{ $total_bill->id }}">Paid</option>
                                                @else
                                                    <div class="flex position">
                                                        <option class="btn btn-sm btn-danger unpaid_btn" value="{{ $total_bill->id }}">Unpaid</option>
                                                    </div>
                                                @endif
                                            </td>
                                            {{-- <td>
                                                <div class="position_input">
                                                    <input type="checkbox" name="bill_multi_month_id[]" value="{{ $total_bill->id }}">
                                                </div>
                                            </td> --}}
                                        </tr>
                                    @empty
                                        <td colspan="50">
                                            <div class="alert alert-danger text-center">
                                                <span class="text-danger">
                                                    No Transaction to Show <i class="fa fa-frown-o"></i>
                                                </span>
                                            </div>
                                        </td>
                                    @endforelse
                                </tbody>
                            </table>
                            {{-- {{ $total_bills->links() }} --}}
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
@section('scripts')

<!-- checkbox js -->
<script src="{{ asset('assets/backend/js/jquery-1.12.4.min.js') }}"></script>
{{-- <script src="{{ asset('assets/backend/js/jquery.selectallcheckbox.js') }}"></script>

<script>

    function onChange( checkboxes, checkedState ) {}

    $( document ).ready( function(){
       $( "#selectAll" ).selectAllCheckbox({
          checkboxesName   : "bill_multi_month_id[]",
          onChangeCallback : onChange,
          useIndeterminate : false
       });
    });


</script> --}}

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
