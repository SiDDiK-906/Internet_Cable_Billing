@extends('backend.layouts.master')

@section('content')

    <div class="col-md-12 col-sm-10">

        <div class="row">
            <div class="col-md-12 col-sm-10">

                <div class="clearfix">
                    <div class="pull-right tableTools-container"></div>
                </div>

                {{-- <div class="table-header">
                    <div class="add-slider"><i class="fa fa-bars" aria-hidden="true"></i>
                        Day Wise Billing Report
                    </div>
                </div> --}}

                <div class="form-group margin-top margin-bottom">
                    <form action="{{ route('all-bill-report-get') }}" method="GET">
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
                                            <option value="{{ $i }}" {{ Session::get('year_session') == $i ? 'selected' : '' }}>{{ $i }}</option>
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

                                            <option value="{{ $m }}" {{ Session::get('month_session') == $i ? 'selected' : '' }}>{{ Carbon::parse($month)->format('F') }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="day">
                                <div class="label-position"><strong>Select Day</strong></div>
                                <div class="main-select">
                                    <select name="day">
                                        <option value=""> Select a Day </option>

                                        @for($i= 1; $i <= date('d'); $i++)

                                            <option value="
                                                    @if ($i < 10)
                                                        {{ '0'.$i }}
                                                    @else
                                                        {{ $i }}
                                                    @endif
                                            " {{ Session::get('day_session') == $i ? 'selected' : '' }}>{{ $i }}</option>

                                        @endfor

                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="my-button border-radius button-position">Confirm</button>
                        </div>
                    </form>
                </div>


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
                                        <th>Date</th>
                                        <th>Area</th>
                                        <th>Active Client</th>
                                        <th>Staff</th>
                                        <th>Recieve Bill</th>
                                        <th>Others Bill</th>
                                        <th>Total Bill</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($staffs as $staff)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>

                                        <td>{{ Session::get('report_date') }}</td>

                                        <td>
                                            @if ($staff->id == 2 OR $staff->id == 31)
                                                <span>{{ "This Staff has no Area" }}</span>
                                            @else
                                                {{ $staff->Areas->area_name }}
                                            @endif
                                        </td>

                                        <td class="item1">{{ active_customers_staff($staff->id) }}</td>
                                        <td>{{ $staff->staff_name }}</td>



                                        {{-- Recieve Bill --}}
                                        <td class="item2">
                                            @php
                                                $daily_bill = 0;
                                            @endphp

                                            @foreach ( $staff->BillGenerate as $bill)
                                                @if ($bill->fk_transition_type_id = 3)
                                                    @php
                                                        $daily_bill += ($bill->paid_amount + $bill->discount);
                                                    @endphp
                                                @endif
                                            @endforeach

                                            {{ $daily_bill }}
                                        </td>



                                        {{-- Others Bill --}}
                                        <td class="item3">
                                            @php
                                                $others_bill = 0;
                                            @endphp

                                            @foreach ( $staff->BillGenerate as $bill)

                                                @if ($bill->fk_transition_type_id != 3)
                                                    @php
                                                        $others_bill += ($bill->paid_amount + $bill->discount);
                                                    @endphp
                                                @endif

                                            @endforeach

                                            {{ $others_bill }}
                                        </td>

                                        {{-- Total Bill --}}
                                        <td class="item4">
                                            {{ $daily_bill + $others_bill }}
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
                                        <td></td>
                                        <td>
                                            <strong id="total2"></strong>
                                        </td>
                                        <td>
                                            <strong id="total3"></strong>
                                        </td>
                                        <td>
                                            <strong id="total4"></strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
            </div>
        </div>
    </div>


    @endsection
    @section('scripts')
    <script src="{{ asset('assets/backend/js/jquery-1.12.4.min.js') }}"></script>
        <script>

            let total1 = total2 = total3 = total4 = total5 = 0

            $(document).ready(function() {

                $(".item1").each(function() {
                    let tr = $(this).closest('tr')

                    total1 += Number($(this).text())
                    total2 += Number(tr.find('.item2').text())
                    total3 += Number(tr.find('.item3').text())
                    total4 += Number(tr.find('.item4').text())


                })

                $("#total1").text(total1)
                $("#total2").text(total2)
                $("#total3").text(total3)
                $("#total4").text(total4)
            })

        </script>
    @endsection
