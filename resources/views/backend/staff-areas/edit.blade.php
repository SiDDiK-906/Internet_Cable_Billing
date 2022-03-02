@extends('backend.layouts.master')

@section('content')
    <div class="col-md-1"></div>

    <div class="col-md-10"
        style="border: 3px solid #438EB9; padding-left: 20px; padding-right: 20px; padding-bottom: 25px; margin-top: 15px;">
        <div class="table-header">
            <p style="font-size: 15px;">Update this Staff Area :</p>
        </div>
        <div>

            <div class="clearfix">
                <div class="pull-right tableTools-container"></div>
            </div>

        </div>

        <div style="margin-top: 15px;">
            <div class="tile">
                <form action="{{ route('update-staff-area', $staffArea->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">



                            <label class="ace-file-input">
                                <span style="color: #438EB9">Select a Staff Name</span>
                                <div class="form-group">
                                    <div>
                                        <select class="form-control" name="fk_staff_id">
                                            <option>Select an Staff</option>
                                            @foreach ($staffs as $staff)
                                                <option {{ $staffArea->fk_staff_id == $staff->id ? 'selected' : '' }}
                                                    value="{{ $staff->id }}">
                                                    {{ $staff->staff_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </label><br><br>


                            <label class="ace-file-input">
                                <span style="color: #438EB9">Select an Area Name</span>
                                <div class="form-group">
                                    <div>
                                        <select class="form-control" name="fk_area_id">
                                            <option>Select an Area</option>
                                            @foreach ($areas as $area)
                                                <option {{ $staffArea->fk_area_id == $area->id ? 'selected' : '' }}
                                                    value="{{ $area->id }}">
                                                    {{ $area->area_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </label><br><br>


                        </div>
                    </div><br>
                    <div class="tile-footer ">
                        <button class="btn btn-primary" type="submit">
                            <i class="fa fa-fw fa-lg fa-check-circle"></i>Update Customer
                        </button>
                        <a href="{{ route('all-staff-area') }}" class="btn btn-primary mr-2">
                            <i class="fa fa-fw fa-lg fa-arrow-circle-left"></i>Go Back
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>


@endsection
