@extends('backend.layouts.master')

@section('content')

    <div class="col-md-12 col-sm-10">

        <div class="row">
            <div class="col-md-12 col-sm-10">

                <div class="clearfix">
                    <div class="pull-right tableTools-container"></div>
                </div>

                <form action="{{ route('due_search_bill_payment') }}" method="GET">
                    @csrf
                    <div class="accounts" style="margin-bottom: 30px">
                        {{-- <div class="flex" style="justify-content: space-evenly">
                                <div>
                                    <input type="text" placeholder="Customer ID" name="fk_customer_id" value="{{ request('fk_customer_id') ?? ''  }}">
                                </div>
                                <div>
                                    <input type="text" placeholder="Customer Name" name="customer_name" value="{{ request('customer_name') ?? '' }}">
                                </div>
                                <div>
                                    <input type="text" placeholder="Transaction ID" name="transition_id"  value="{{ request('transition_id') ?? '' }}">
                                </div>
                                <div>
                                    <input class="form-control" type="date" name="payment_date" value="{{ request('payment_date') ?? ''  }}">
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm">Search</button>
                        </div> --}}

                        <div class="flex" style="justify-content: space-evenly">
                            <div>

                                <select name="customer_id" id="customer_id" class="chosen-select" style="width: 200px">
                                    <option value="">Enter Customer Id</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->customer_id }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div>
                                <select name="customer_name" id="customer_name" class="chosen-select" style="width: 200px">
                                    <option value="">Enter Customer Name</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div>
                                <input class="form-control" type="date" name="payment_date" value="{{ request('payment_date') ?? ''  }}">
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">Search</button>
                        </div>

                    </div>
                </form>


                <div class="tile ">
                    <div class="tile-body">
                        <table class="table table-hover table-bordered datatable table-striped dataTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>C. ID</th>
                                    <th>Name</th>
                                    <th>Transaction ID</th>
                                    <th>Area</th>
                                    <th>Month</th>
                                    <th>Date</th>
                                    <th>Paid</th>
                                    <th>Due</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($paid_bills as $paid_bill)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td> {{ $paid_bill->customer->customer_id ?? ''}}</td>
                                        <td> {{ $paid_bill->customer->customer_name }} </td>
                                        <td> {{ $paid_bill->transition_id ?? ''}}</td>
                                        <td> {{ $paid_bill->Staff2->Areas->area_name }} </td>
                                        <td>
                                            @if (!empty($paid_bill->linePayTranMethods->month))
                                                @if ($paid_bill->linePayTranMethods->month == 1)
                                                    January({{ $paid_bill->linePayTranMethods->year }})

                                                @elseif ($paid_bill->linePayTranMethods->month == 2)
                                                    February({{ $paid_bill->linePayTranMethods->year}})

                                                @elseif ($paid_bill->linePayTranMethods->month == 3)
                                                    March({{ $paid_bill->linePayTranMethods->year}})

                                                @elseif ($paid_bill->linePayTranMethods->month == 4)
                                                    April({{ $paid_bill->linePayTranMethods->year}})

                                                @elseif ($paid_bill->linePayTranMethods->month == 5)
                                                    May({{ $paid_bill->linePayTranMethods->year}})

                                                @elseif ($paid_bill->linePayTranMethods->month == 6)
                                                    June({{ $paid_bill->linePayTranMethods->year}})

                                                @elseif ($paid_bill->linePayTranMethods->month == 7)
                                                    July({{ $paid_bill->linePayTranMethods->year}})

                                                @elseif ($paid_bill->linePayTranMethods->month == 8)
                                                    August({{ $paid_bill->linePayTranMethods->year}})

                                                @elseif ($paid_bill->linePayTranMethods->month == 9)
                                                    September({{ $paid_bill->linePayTranMethods->year}})

                                                @elseif ($paid_bill->linePayTranMethods->month== 10)
                                                    October({{ $paid_bill->linePayTranMethods->year}})

                                                @elseif ($paid_bill->linePayTranMethods->month== 11)
                                                    November({{ $paid_bill->linePayTranMethods->year}})

                                                @else
                                                    December({{ $paid_bill->linePayTranMethods->year}})
                                                @endif
                                            @else
                                                N\A
                                            @endif
                                        </td>
                                        <td> {{ $paid_bill->payment_date ?? ''}}</td>
                                        <td> {{ $paid_bill->paid_amount ?? ''}}</td>
                                        <td> {{ $paid_bill->due_amount ?? ''}}</td>
                                        <td class="flex">
                                            <div class="btn-group action-group">
                                                <a class="btn btn-primary" href="{{ route('edit_payment', $paid_bill->id) }}">
                                                    <i class="fa fa fa-edit"></i>
                                                </a>
                                            </div>
                                            <div class="btn-group action-group">
                                                <a type="submit" id="delete" class="btn btn-danger"
                                                    href="{{ route('destroy-payment', $paid_bill->id) }}">
                                                    <i class="fa fa-lg fa-trash"></i>
                                                </a>
                                            </div>
                                            <div class="btn-group action-group">
                                                <a href="{{ route('make_voucher',$paid_bill->id) }}" class="btn btn-success" target="_blank">
                                                    <img src="{{ asset('assets/backend/images/reciept.png') }}" alt="img not found" width="16px">
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="text-center">
                                        <div class="alert alert-danger text-center">
                                            <span class="text-danger">No Data to show</span>
                                        </div>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('scripts')
    <script>

    </script>
@endsection
