@extends('backend.layouts.master')

@section('content')

    <div class="col-md-12 col-sm-10">

        <div class="row">
            <div class="col-md-12 col-sm-10">


                <div class="clearfix">
                    <div class="pull-right tableTools-container"></div>
                </div>


                <div class="form-group margin-top margin-bottom">
                    <form action="{{ route('all-bill-status-get') }}" method="GET">
                        @csrf
                        @php
                            $carbon = \Carbon\Carbon::today();
                        @endphp
                        <div class="flex flex-position">
                            <div class="year">
                                <div class="label-position"><strong>Select Year</strong></div>
                                <div class="main-select">
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

                                <div class="main-select">
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
                            <button type="submit" class="my-button border-radius button-position">Confirm</button>
                        </div>
                    </form>
                </div>



                @if ($areas == '0')
                    <tbody>
                        <tr>
                            <td colspan="50">

                            </td>
                        </tr>
                    </tbody>
                @else
                    <div class="tile ">
                        <div class="tile-body">
                            <div class="buttonz flex">
                                <div class="print">
                                    <a href="#">
                                        <i class="fa fa-print" aria-hidden="true"></i>
                                        <span>Print</span>
                                    </a>
                                </div>
                            </div>
                            <table class="table table-hover table-bordered datatable table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Area</th>
                                        <th>Staff</th>
                                        <th>Active Client</th>
                                        <th>Previous Due Total</th>
                                        <th>Recoverable Bill</th>
                                        <th>Monthly Bill</th>
                                        <th>Others Bill</th>
                                        <th>Due Collection</th>
                                        <th>Total Collection</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach ($areas->take(5) as $area) --}}
                                    @foreach ($areas as $area)
                                        <tr>
                                            <td>{{ $loop->index+1 }}</td>

                                            <td>{{ $area->area_name }}</td>

                                            <td>{{ $area->Staff2->staff_name }}</td>

                                            {{-- Customer Count --}}
                                            <td class="item1">{{ active_customers_area($area->id) }}</td>


                                            {{-- Previous Due Total --}}
                                            <td class="item2">
                                                @php
                                                    $total_previous_due = 0;
                                                @endphp

                                                @foreach ($area->BillMultiMonthCurrent as $bill)

                                                    @php
                                                        $total_previous_due += $bill->month_wise_amount;
                                                    @endphp

                                                @endforeach

                                                {{ $total_previous_due }}
                                            </td>



                                            {{-- Recoverable Bill --}}
                                            <td class="item3">

                                                @php
                                                    $total_recover_bill = 0;
                                                @endphp

                                                @foreach ($area->BillPaymentMultiMonthStatusCurrent as $bill)

                                                    @php
                                                        $total_recover_bill += $bill->month_wise_amount;
                                                    @endphp

                                                @endforeach

                                                {{ $total_recover_bill }}

                                            </td>



                                            {{-- Monthly Bill --}}
                                            <td class="item4">

                                                @php
                                                    $total_monthly_bill = 0;
                                                @endphp

                                                @foreach ($area->BillPaymentMultiMonthStatusCurrent as $bill)
                                                    @if ($bill->one_click == 0)
                                                        @php
                                                            $total_monthly_bill += $bill->month_wise_paid;
                                                        @endphp
                                                   @endif
                                                @endforeach

                                                {{ $total_monthly_bill }}

                                            </td>



                                            {{-- Others BIll --}}
                                            <td class="item5">
                                                @php
                                                    $others_bill = 0;
                                                @endphp

                                                @foreach ($area->BillPaymentMultiMonthStatusCurrent as $bill)

                                                    @if ( $bill->fk_transition_type_id != 3 AND $bill->one_click == 0 )
                                                        @php
                                                            $others_bill += $bill->month_wise_paid;
                                                        @endphp
                                                    @endif

                                                @endforeach

                                                {{ $others_bill }}
                                            </td>




                                            {{-- Due Amount --}}
                                            <td class="item6">
                                                @php
                                                    $total_due = 0;
                                                @endphp

                                                @foreach ($area->BillPaymentMultiMonthStatusCurrent as $bill)

                                                    @if ($bill->one_click == 0 AND (strtotime($bill->receive_date) > strtotime( payment_date_helpers($bill->fk_payment_transition_id)) ) )
                                                        @php
                                                            $total_due += $bill->month_wise_paid;
                                                        @endphp
                                                    @endif

                                                @endforeach

                                                {{ $total_due }}
                                            </td>




                                            {{-- Total Collection --}}
                                            <td class="item7">

                                                {{ $total_monthly_bill + $others_bill + $total_due }}

                                            </td>

                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td style="text-align: right"><strong>Total:</strong></td>
                                        <td>
                                            <strong id="total1"></strong>
                                        </td>
                                        <td>
                                            <strong id="total2"></strong>
                                        </td>
                                        <td>
                                            <strong id="total3"></strong>
                                        </td>
                                        <td>
                                            <strong id="total4"></strong>
                                        </td>
                                        <td>
                                            <strong id="total5"></strong>
                                        </td>
                                        <td>
                                            <strong id="total6"></strong>
                                        </td>
                                        <td>
                                            <strong id="total7"></strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>


@endsection
@section('scripts')
<script src="{{ asset('assets/backend/js/jquery-1.12.4.min.js') }}"></script>

    <script>

        let total1 = total2 = total3 = total4 = total5 = total6 = total7 = total8 = 0

        $(document).ready(function() {

            $(".item1").each(function() {
                let tr = $(this).closest('tr')

                total1 += Number($(this).text())
                total2 += Number(tr.find('.item2').text())
                total3 += Number(tr.find('.item3').text())
                total4 += Number(tr.find('.item4').text())
                total5 += Number(tr.find('.item5').text())
                total6 += Number(tr.find('.item6').text())
                total7 += Number(tr.find('.item7').text())


            })

            $("#total1").text(total1)
            $("#total2").text(total2)
            $("#total3").text(total3)
            $("#total4").text(total4)
            $("#total5").text(total5)
            $("#total6").text(total6)
            $("#total7").text(total7)
        })
    </script>
@endsection
