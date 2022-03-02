@extends('backend.layouts.master')

@section('content')

    <div class="col-md-1"></div>

    <div class="col-md-10"
        style="border: 3px solid #438EB9; padding-left: 20px; padding-right: 20px; padding-bottom: 25px; margin-top: 15px;">
        <div class="table-header">
            <p style="font-size: 15px;">Update this Customer: {{ $customer->customer_name ?? '' }}</p>
        </div>
        <div>

            <div class="clearfix">
                <div class="pull-right tableTools-container"></div>
            </div>

        </div>

        <div style="margin-top: 15px;">
            <div class="tile">
                <form action="{{ route('update-customer', $customer->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">

                            <label class="ace-file-input">
                                <span style="color: #438EB9">Select an Area Name</span>
                                <div class="form-group">
                                    <div>
                                        <select class="form-control" name="fk_area_id">
                                            <option>Select an Area</option>
                                            @foreach ($areas as $area)
                                                <option {{ $customer->fk_area_id == $area->id ? 'selected' : '' }}
                                                    value="{{ $area->id }}">
                                                    {{ $area->area_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </label><br><br>


                            <label class="ace-file-input">
                                <span style="color: #438EB9">Select an Line Category</span>
                                <div class="form-group">
                                    <div>
                                        <select class="form-control" name="fk_line_id">
                                            <option>Select a Line</option>
                                            @foreach ($lineCategories as $lineCategory)
                                                <option {{ $customer->fk_line_id == $lineCategory->id ? 'selected' : '' }}
                                                    value="{{ $lineCategory->id }}">
                                                    {{ $lineCategory->line_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </label><br><br>

                            <label class="ace-file-input">
                                <span style="color: #438EB9">Enter a Customer ID</span>
                                <input class="form-control" type="text" name="customer_id"
                                    value="{{ $customer->customer_id ?? '' }}" placeholder="Enter Customer ID" required>
                            </label><br><br>

                            <label class="ace-file-input">
                                <span style="color: #438EB9">Enter a Line Number</span>
                                <input class="form-control" type="text" name="line_number"
                                    value="{{ $customer->line_number ?? '' }}" placeholder="Enter Line Number" required>
                            </label><br><br>

                            <label class="ace-file-input">
                                <span style="color: #438EB9">Enter a Customer Name</span>
                                <input class="form-control" type="text" name="customer_name"
                                    value="{{ $customer->customer_name ?? '' }}" placeholder="Enter Customer Name"
                                    required>
                            </label><br><br>

                            <label class="ace-file-input">
                                <span style="color: #438EB9">Enter a Customer Email</span>
                                <input class="form-control" type="email" name="customer_email"
                                    value="{{ $customer->customer_email ?? '' }}" placeholder="Enter Customer Email">
                            </label><br><br>

                            <label class="ace-file-input">
                                <span style="color: #438EB9">Enter a Customer Address</span>
                                <input class="form-control" type="text" name="address"
                                    value="{{ $customer->address ?? '' }}" placeholder="Enter Customer Address">
                            </label><br><br>

                            <label class="ace-file-input">
                                <span style="color: #438EB9">Enter a Customer Phone</span>
                                <input class="form-control" type="number" name="customer_phone"
                                    value="{{ $customer->customer_phone ?? '' }}" placeholder="Enter Customer Phone">
                            </label><br><br>

                            <label class="ace-file-input">
                                <span style="color: #438EB9">Enter a Customer NID</span>
                                <input class="form-control" type="number" name="customer_nid"
                                    value="{{ $customer->customer_nid ?? '' }}" placeholder="Enter Customer NID">
                            </label><br><br>

                            <label class="ace-file-input">
                                <span style="color: #438EB9">Enter a Customer DUE</span>
                                <input class="form-control" type="number" name="customer_due"
                                    value="{{ $customer->customer_due ?? '' }}" placeholder="Enter Customer DUE">
                            </label><br><br>

                            <label class="ace-file-input">
                                <span style="color: #438EB9">Select Customer Starting Date</span>
                                <input class="form-control" type="date" name="starting_date"
                                    value="{{ $customer->starting_date ?? '' }}" placeholder="Enter Starting Date">
                            </label><br><br>

                            <label class="ace-file-input">
                                <span style="color: #438EB9">Select Customer Connection Date</span>
                                <input class="form-control" type="date" name="connection_date"
                                    value="{{ $customer->connection_date ?? '' }}" placeholder="Enter Connection Date"
                                    required>
                            </label><br><br>

                        </div>
                    </div><br>
                    <div class="tile-footer ">
                        <button class="btn btn-primary" type="submit">
                            <i class="fa fa-fw fa-lg fa-check-circle"></i>Update Customer
                        </button>
                        <a href="{{ route('all-customer') }}" class="btn btn-primary mr-2">
                            <i class="fa fa-fw fa-lg fa-arrow-circle-left"></i>Go Back
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>


@endsection
