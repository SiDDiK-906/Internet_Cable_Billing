@extends('backend.layouts.master')

@section('content')

    <div class="col-md-1"></div>

    <div class="col-md-10"
        style="border: 3px solid #438EB9; padding-left: 20px; padding-right: 20px; padding-bottom: 25px; margin-top: 15px;">
        <div class="table-header">
            <p style="font-size: 15px;">Add a new Customer</p>
        </div>
        <div>
            {{-- <h3 class="header smaller lighter blue text-left">Add a new Customer</h3> --}}
            <div class="clearfix">
                <div class="pull-right tableTools-container"></div>
            </div>
            {{-- <div class="table-header">
                Add a new Customer
            </div> --}}
        </div>

        <div style="margin-top: 15px;">
            <div class="tile">
                <form action="{{ route('store-customer') }}" method="post" enctype="multipart/form-data">
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
                                            <option>Select a Line</option>
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
                                <select name="status" class="form-control" required>
                                    <option value="1">Active</option>
                                    <option value="0">Deactive</option>
                                </select>
                            </label><br>

                            <label class="ace-file-input">
                                <input class="form-control" type="number" name="customer_id" placeholder="Enter Customer ID" required>
                            </label><br>

                            {{-- <label class="ace-file-input">
                                <input class="form-control" type="text" name="line_number" placeholder="Enter Line Number" required>
                            </label><br> --}}

                            <label class="ace-file-input">
                                <input class="form-control" type="text" name="customer_name" placeholder="Enter Customer Name" required>
                            </label><br>

                            <label class="ace-file-input">
                                <input class="form-control" type="email" name="customer_email" placeholder="Enter Customer Email">
                            </label><br>

                            <label class="ace-file-input">
                                <textarea name="address" cols="20" rows="4" class="form-control"  placeholder="Enter Customer Address" required></textarea>
                            </label><br>

                            <label class="ace-file-input" style="margin-top: 50px">
                                <input class="form-control" type="number" name="customer_phone" placeholder="Enter Customer Phone" required>
                            </label><br>

                            <label class="ace-file-input">
                                <input class="form-control" type="number" name="customer_nid" placeholder="Enter Customer NID" required>
                            </label><br>

                            <label class="ace-file-input" style="margin-top: 20px">
                                <div class="row">
                                    <div class="col-lg-12 flex" style="justify-content: space-between">
                                        <div class="row">
                                            <div class="col-lg-4 pr">
                                                <input type="text" value="Enter Starting Date" class="form-control" readonly>
                                            </div>
                                            <div class="col-lg-5 pl">
                                                <input class="form-control" type="date" name="starting_date" placeholder="Enter Starting Date" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 pr pr2">
                                                <input type="text" value="Enter Connection Date" class="form-control" readonly>
                                            </div>
                                            <div class="col-lg-5 pl">
                                                <input class="form-control" type="date" name="connection_date" placeholder="Enter Connection Date" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </label><br>

                        </div>
                    </div><br>
                    <div class="tile-footer ">
                        <button class="btn btn-primary" type="submit">
                            <i class="fa fa-fw fa-lg fa-check-circle"></i>Submit
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
