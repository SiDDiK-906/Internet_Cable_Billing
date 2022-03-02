@extends('backend.layouts.master')

@section('content')

    <div class="col-md-1"></div>

    <div class="col-md-10"
        style="border: 3px solid #438EB9; padding-left: 20px; padding-right: 20px; padding-bottom: 25px; margin-top: 15px;">
        <div class="table-header">
            <p style="font-size: 15px;">Edit this Address</p>
        </div>
        <div>

            <div class="clearfix">
                <div class="pull-right tableTools-container"></div>
            </div>

        </div>

        <div style="margin-top: 15px;">
            <div class="tile">
                <form action="{{ route('update-address', $address->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">


                            <label class="ace-file-input">
                                <span style="color: #438EB9">Enter a Address </span>
                                <input class="form-control" type="text" name="address" value="{{ $address->address }}"
                                    placeholder="Enter a Address" required>
                            </label><br><br>

                            <label class="ace-file-input">
                                <span style="color: #438EB9">Enter a Country Name </span>
                                <input class="form-control" type="text" name="country_name"
                                    value="{{ $address->country_name }}" placeholder="Enter a Country Name" required>
                            </label><br><br>

                            <label class="ace-file-input">
                                <span style="color: #438EB9">Enter a City Name </span>
                                <input class="form-control" type="text" name="city_name"
                                    value="{{ $address->city_name }}" placeholder="Enter a City Name" required>
                            </label><br><br>

                            <label class="ace-file-input">
                                <span style="color: #438EB9">Enter a Zip Code </span>
                                <input class="form-control" type="text" name="zip_code" value="{{ $address->zip_code }}"
                                    placeholder="Enter a Zip Code" required>
                            </label><br><br>

                            <label class="ace-file-input">
                                <span style="color: #438EB9">Enter a Division </span>
                                <input class="form-control" type="text" name="division" value="{{ $address->division }}"
                                    placeholder="Enter a Division" required>
                            </label><br>


                        </div>
                    </div><br>
                    <div class="tile-footer ">
                        <button class="btn btn-primary" type="submit">
                            <i class="fa fa-fw fa-lg fa-check-circle"></i>Update Address
                        </button>
                        <a href="{{ route('all-address') }}" class="btn btn-primary mr-2">
                            <i class="fa fa-fw fa-lg fa-arrow-circle-left"></i>Go Back
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>


@endsection
