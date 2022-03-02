@extends('backend.layouts.master')
@section('content')
    <div class="col-md-12 col-sm-10">
        <div class="row">
            <div class="col-md-12 col-sm-10">
                <div class="clearfix">
                    <div class="pull-right tableTools-container"></div>
                </div>

                <form action="{{ route('active_customer_search') }}" method="GET">
                    @csrf
                    <div class="accounts" style="margin-bottom: 30px">
                        <div class="flex" style="justify-content: space-evenly">
                            <div>

                                <select name="customer_id" id="customer_id" class="chosen-select" style="width: 200px">
                                    <option value="">Enter Customer Id</option>
                                    @foreach ($customerSearch as $customer)
                                        <option value="{{ $customer->customer_id }}">{{ $customer->customer_id }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div>
                                <select name="customer_name" id="customer_name" class="chosen-select" style="width: 200px">
                                    <option value="">Enter Customer Name</option>
                                    @foreach ($customerSearch as $customer)
                                        <option value="{{ $customer->customer_name }}">{{ $customer->customer_name }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div>
                                <select name="customer_phone" id="customer_phone" class="chosen-select" style="width: 200px">
                                    <option value="">Enter Customer Phone</option>
                                    @foreach ($customerSearch as $customer)
                                        <option value="{{ $customer->customer_phone }}">{{ $customer->customer_phone }}</option>
                                    @endforeach
                                </select>

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
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Area</th>
                                    <th>Line</th>
                                    <th>Due</th>
                                    <th>Transaction</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($customers as $customer)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>

                                        <td> {{ $customer->customer_id ?? ''}}</td>
                                        <td> {{ $customer->customer_name ?? ''}}</td>
                                        <td> {{ $customer->customer_phone ?? ''}}</td>
                                        <td> {{ $customer->address ?? ''}}</td>
                                        <td> {{ $customer->areas->area_name ?? ''}}</td>
                                        <td> {{ $customer->lineCategories->line_name ?? ''}}</td>
                                        <td> {{ customer_total_due($customer->id) ?? ''}}</td>
                                        <td>
                                            <a href="{{ route('customer-transaction',$customer->id) }}" class="btn btn-sm btn-primary">Transaction</a>
                                        </td>
                                        <td class="flex">
                                            <div class="btn-group action-group">
                                                <a class="btn btn-primary" href="{{ route('edit-customer', $customer->id) }}">
                                                    <i class="fa fa fa-edit"></i>
                                                </a>
                                            </div>
                                            <div class="btn-group action-group">
                                                <a type="submit" id="delete" class="btn btn-danger"
                                                    href="{{ route('destroy-customer', $customer->id) }}">
                                                    <i class="fa fa-lg fa-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="text-center">
                                        <div class="alert alert-danger text-center">
                                            <span class="text-danger">Customer is not matching</span>
                                        </div>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>

                <span>
                    {{ $customers->links() }}
                </span>

            </div>
        </div>
    </div>


@endsection
@section('scripts')
<script>
    $('.customer_select2').select2();
</script>
@endsection
