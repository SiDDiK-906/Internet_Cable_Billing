@extends('backend.layouts.master')

@section('content')

    <div class="col-md-1"></div>

    <div class="col-md-10"
        style="border: 3px solid #438EB9; padding-left: 20px; padding-right: 20px; padding-bottom: 25px; margin-top: 15px;">
        <div class="table-header">
            <p style="font-size: 15px;">Add a new Staff</p>
        </div>
        <div>
            {{-- <h3 class="header smaller lighter blue text-left">Add a new Staff</h3> --}}
            <div class="clearfix">
                <div class="pull-right tableTools-container"></div>
            </div>
            {{-- <div class="table-header">
                Add a new Staff
            </div> --}}
        </div>

        <div style="margin-top: 15px;">
            <div class="tile">
                <form action="{{ route('store-staff') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">

                            <input class="form-control" type="file" name="staff_profile" accept="image/*" /> <br>

                            <label class="ace-file-input">
                                <select name="area" class="form-control">
                                    <option value="">Select an Area</option>
                                    @foreach ($areas as $area)
                                        <option value="{{ $area->id }}">{{ $area->area_name }}</option>
                                    @endforeach
                                </select>
                            </label><br>

                            <label class="ace-file-input">
                                <input class="form-control" type="text" name="staff_name" placeholder="Enter Staff Name" required>
                            </label><br>

                            <label class="ace-file-input">
                                <input class="form-control" type="email" name="staff_email" placeholder="Enter Staff Email" required>
                            </label><br>

                            <label class="ace-file-input">
                                <input class="form-control" type="text" name="password"
                                    placeholder="Enter Staff Password" required>
                            </label><br>

                            <label class="ace-file-input">
                                <input class="form-control" type="text" name="staff_phone_no" placeholder="Enter Staff Phone">
                            </label><br>


                            <label class="ace-file-input">
                                <input class="form-control" type="text" name="staff_address" placeholder="Enter Staff Address">
                            </label><br>

                            <label class="ace-file-input">
                                <select name="type" class="form-control">
                                    <option value="">Select a Type <small> (Optional)</small></option>
                                    <option value="0">As an Admin</option>
                                    <option value="1">As a Staff</option>
                                </select>
                            </label><br>
                        </div>
                    </div><br>
                    <div class="tile-footer ">
                        <button class="btn btn-primary" type="submit">
                            <i class="fa fa-fw fa-lg fa-check-circle"></i>Add Staff
                        </button>
                        <a href="{{ route('all-staff') }}" class="btn btn-primary mr-2">
                            <i class="fa fa-fw fa-lg fa-arrow-circle-left"></i>Go Back
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>


@endsection
