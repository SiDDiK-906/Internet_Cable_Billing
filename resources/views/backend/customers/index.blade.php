@extends('backend.layouts.master')

@section('content')

    <div class="col-md-12 col-sm-10">
        <div style=" text-align:right;" class="add-slider">
            <a class="btn btn-primary icon-btn" href="{{ route('create-customer') }}"><i class="fa fa-plus"></i> Add New
                Customer
            </a>
        </div>

        <div class="row">
            <div class="col-md-12 col-sm-10">

                <div class="clearfix">
                    <div class="pull-right tableTools-container"></div>
                </div>

                <div class="table-header">
                    <div class="add-slider"><i class="fa fa-bars" aria-hidden="true"></i>
                        Result for All Customers
                    </div>
                </div>

                <div class="tile ">
                    <div class="tile-body">
                        <table class="table table-hover table-bordered datatable table-striped dataTable">
                            <thead>
                                <tr>
                                    <th>#</th>

                                    <th>Line Number</th>
                                    <th>Customer ID</th>
                                    <th>Customer Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Created at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customers as $customer)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td> {{ $customer->line_number ?? ''}}</td>
                                        <td> {{ $customer->customer_id ?? ''}}</td>
                                        <td> {{ $customer->customer_name ?? ''}}</td>
                                        <td> {{ $customer->customer_email ?? '' }}</td>
                                        <td>
                                            @if ($customer->status == 1)
                                                <div class="btn-group action-group">
                                                    <a class="btn btn-success"
                                                        href="{{ route('deactive-customer', $customer->id) }}">
                                                        <i class="fa fa fa-toggle-on"></i>
                                                    </a>
                                                </div>
                                            @else
                                                <div class="btn-group action-group">
                                                    <a class="btn btn-secondary"
                                                        href="{{ route('active-customer', $customer->id) }}">
                                                        <i class="fa fa fa-toggle-off"></i>
                                                    </a>
                                                </div>
                                            @endif
                                        </td>
                                        <td>{{ $customer->created_at ?? '' }}</td>
                                        <td>
                                            <div class="btn-group action-group">
                                                <a class="btn btn-primary" href="{{ route('edit-customer', $customer->id) }}">
                                                    <i class="fa fa fa-edit"></i>
                                                </a>
                                                <a type="submit" id="delete" class="btn btn-danger"
                                                    href="{{ route('destroy-customer', $customer->id) }}">
                                                    <i class="fa fa-lg fa-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
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
