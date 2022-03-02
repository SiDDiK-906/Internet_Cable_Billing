@extends('backend.layouts.master')
@section('content')
    <div class="col-md-12 col-sm-10 top-div">
        <div class="buttonz flex">
            <div class="print">
                <a href="#" onclick="printDiv('printableArea')">
                    <i class="fa fa-print" aria-hidden="true"></i>
                    <span>Print</span>
                </a>
            </div>
        </div>
        <div class="row main-row" id="printableArea" >

            <div class="col-lg-6 reciept reciept-left">
                <div class="left">
                    <div class="up flex">
                        <div class="up-left">
                            <h4>চুনারুঘাট ক্যাবল টিভি নেটওয়ার্ক</h4>
                            <h6>মুসলিম প্লাজা (৩য় তলা) চুনারুঘাট,হবিগঞ্জ</h6>
                            <p>info@cctn-bd.net</p>
                            <p>www.cctn-bd.net</p>
                        </div>
                        <div class="up-right">
                            <p>Date <span>: {{ $bill_generate->payment_date }}</span> </p>
                            <p>Invoice <span>: {{ $invoice }}</span> </p>
                            <p>ID <span>: {{ $customer->customer_id }}</span> </p>
                            <p>Area <span>: {{ $area_name }}</span> </p>
                        </div>
                    </div>
                    <div class="down flex">
                        <div class="down-left">
                            <p>Name</p>
                            <p>Address</p>
                            <p>Mobile No.</p>
                            <p>Monthly Payment</p>
                            <p>Month</p>
                            <p>Total Amount</p>
                            <p>Discount</p>
                            <p>Total Paid</p>
                            <p>Total Due</p>
                            <p>Recieve By</p>
                            {{-- <p>Powered By</p> --}}
                        </div>
                        <div class="down-right">
                            <p>{{ $customer->customer_name }}</p>
                            <p>{{ $customer->address }}</p>
                            <p>{{ $customer->customer_phone }}</p>
                            <p>{{ $monthly_payment }}</p>
                            <p>
                                @if ($bill_month_wise == 1)
                                    January
                                @elseif ($bill_month_wise == 2)
                                    February
                                @elseif ($bill_month_wise == 3)
                                    March
                                @elseif ($bill_month_wise == 4)
                                    April
                                @elseif ($bill_month_wise == 5)
                                    May
                                @elseif ($bill_month_wise == 6)
                                    June
                                @elseif ($bill_month_wise == 7)
                                    July
                                @elseif ($bill_month_wise == 8)
                                    August
                                @elseif ($bill_month_wise == 9)
                                    September
                                @elseif ($bill_month_wise == 10)
                                    October
                                @elseif ($bill_month_wise == 11)
                                    November
                                @else
                                    December
                                @endif
                            </p>
                            <p>{{ $bill_generate->paid_amount }}</p>
                            <p>{{ $bill_generate->discount }}</p>
                            <p>{{ $bill_generate->paid_amount }}</p>
                            <p>{{ $bill_generate->due_amount }}</p>
                            <p>চুনারুঘাট ক্যাবল টিভি নেটওয়ার্ক(CCTN)</p>
                            {{-- <p>Smart Software Ltd.</p> --}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 reciept reciept-right">
                <div class="right">
                    <div class="up flex">
                        <div class="up-left">
                            <h4>চুনারুঘাট ক্যাবল টিভি নেটওয়ার্ক</h4>
                            <h6>মুসলিম প্লাজা (৩য় তলা) চুনারুঘাট,হবিগঞ্জ</h6>
                            <p>info@cctn-bd.net</p>
                            <p>www.cctn-bd.net</p>
                        </div>
                        <div class="up-right">
                            <p>Date <span>: {{ $bill_generate->payment_date }}</span> </p>
                            <p>Invoice <span>: {{ $invoice }}</span> </p>
                            <p>ID <span>: {{ $customer->customer_id }}</span> </p>
                            <p>Area <span>: {{ $area_name }}</span> </p>
                        </div>
                    </div>
                    <div class="down flex">
                        <div class="down-left">
                            <p>Name</p>
                            <p>Address</p>
                            <p>Mobile No.</p>
                            <p>Monthly Payment</p>
                            <p>Month</p>
                            <p>Total Amount</p>
                            <p>Discount</p>
                            <p>Total Paid</p>
                            <p>Total Due</p>
                            <p>Recieve By</p>
                            {{-- <p>Powered By</p> --}}
                        </div>
                        <div class="down-right">
                            <p>{{ $customer->customer_name }}</p>
                            <p>{{ $customer->address }}</p>
                            <p>{{ $customer->customer_phone }}</p>
                            <p>{{ $monthly_payment }}</p>
                            <p>
                                @if ($bill_month_wise == 1)
                                    January
                                @elseif ($bill_month_wise == 2)
                                    February
                                @elseif ($bill_month_wise == 3)
                                    March
                                @elseif ($bill_month_wise == 4)
                                    April
                                @elseif ($bill_month_wise == 5)
                                    May
                                @elseif ($bill_month_wise == 6)
                                    June
                                @elseif ($bill_month_wise == 7)
                                    July
                                @elseif ($bill_month_wise == 8)
                                    August
                                @elseif ($bill_month_wise == 9)
                                    September
                                @elseif ($bill_month_wise == 10)
                                    October
                                @elseif ($bill_month_wise == 11)
                                    November
                                @else
                                    December
                                @endif
                            </p>
                            <p>{{ $bill_generate->paid_amount }}</p>
                            <p>{{ $bill_generate->discount }}</p>
                            <p>{{ $bill_generate->paid_amount }}</p>
                            <p>{{ $bill_generate->due_amount }}</p>
                            <p>চুনারুঘাট ক্যাবল টিভি নেটওয়ার্ক(CCTN)</p>
                            {{-- <p>Smart Software Ltd.</p> --}}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('scripts')
<script>
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>
@endsection
