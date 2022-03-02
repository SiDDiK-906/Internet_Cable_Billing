@extends('backend.layouts.master')

@section('content')

    <div class="col-md-1"></div>

    <div class="col-md-10"
        style="border: 3px solid #438EB9; padding-left: 20px; padding-right: 20px; padding-bottom: 25px; margin-top: 15px;">
        <div class="table-header">
            <p style="font-size: 15px;">Edit this Unit of Measurement</p>
        </div>
        <div>
            <div class="clearfix">
                <div class="pull-right tableTools-container"></div>
            </div>
        </div>

        <div style="margin-top: 15px;">
            <div class="tile">
                <form action="{{ route('update-unit-measurement', $unitMeasurement->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">

                            <label class="ace-file-input">
                                <span style="color: #438EB9">Enter a Unit Measurement Name </span>
                                <input class="form-control" type="text" name="uom_name"
                                    value="{{ $unitMeasurement->uom_name }}" placeholder="Enter a Unit Measurement Name"
                                    required>
                            </label><br><br>

                        </div>
                    </div><br>
                    <div class="tile-footer ">
                        <button class="btn btn-primary" type="submit">
                            <i class="fa fa-fw fa-lg fa-check-circle"></i>Add Unit of Measurement
                        </button>
                        <a href="{{ route('all-unit-measurement') }}" class="btn btn-primary mr-2">
                            <i class="fa fa-fw fa-lg fa-arrow-circle-left"></i>Go Back
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>


@endsection
