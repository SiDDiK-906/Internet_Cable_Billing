@extends('backend.layouts.master')

@section('content')

    <div class="col-md-1"></div>

    <div class="col-md-10"
        style="border: 3px solid #438EB9; padding-left: 20px; padding-right: 20px; padding-bottom: 25px; margin-top: 15px;">
        <div class="table-header">
            <p style="font-size: 15px;">Add bill payment</p>
        </div>
        <div>

            <div class="clearfix">
                <div class="pull-right tableTools-container"></div>
            </div>

        </div>

        <div style="margin-top: 15px;">
            <div class="tile">
                <form action="{{ route('store-bill-payment-due') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">

                            <label class="ace-file-input">
                                <div class="form-group">
                                    <div>
                                        <select class="form-control" name="fk_area_id" required>
                                            <option>Select an Area</option>
                                            @foreach ($areas as $area)
                                            <option value="{{ $area->id }}">
                                                {{ $area->area_name }}
                                            </option>

                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </label><br>

                            <label class="ace-file-input">
                                <div class="form-group">
                                    <div>
                                        <select class="form-control" name="fk_line_id" required>
                                            <option>Select Customer Name</option>
                                            @foreach ($lineCategories as $lineCategory)
                                            <option value="{{ $lineCategory->id }}">
                                                {{ $lineCategory->line_name }}
                                            </option>

                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </label><br>

                            <label class="ace-file-input">
                                <input class="form-control" type="date" name="payment_date" placeholder="Payment Date" required>
                            </label><br>

                            <label class="ace-file-input">
                                <input class="form-control" type="text" name="month_wise_amount" placeholder="Month wise Amount" required>
                            </label><br>

                            <label class="ace-file-input">
                                <input class="form-control" type="text" name="discount" placeholder="Discount" required>
                            </label><br>

                            <label class="ace-file-input">
                                <input class="form-control" type="email" name="last_due" placeholder="Last Due Amount" required>
                            </label><br>

                            <label class="ace-file-input">
                                <input class="form-control" type="text" name="due_paid" placeholder="Due Paid" required>
                            </label><br>
                        </div>
                    </div><br>
                    <div class="tile-footer ">
                        <button class="btn btn-primary" type="submit">
                            <i class="fa fa-fw fa-lg fa-check-circle"></i>Add New Bill Payment
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
