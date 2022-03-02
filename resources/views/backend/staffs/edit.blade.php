@extends('backend.layouts.master')

@section('content')


    <div class="col-md-1"></div>
    <div class="col-md-10" style="border: 3px solid #438EB9;
        padding-left: 20px; padding-right: 20px; padding-bottom: 25px; margin-top: 15px;">

        <div class="table-header">
            <p style="font-size: 15px;">Update this Staff</p>
        </div>

        <div>
            {{-- <h3 class="header smaller lighter blue">Update this Staff</h3> --}}
            <div class="clearfix">
                <div class="pull-right tableTools-container"></div>
            </div>
            {{-- <div class="table-header">
                Update this Staff
            </div> --}}
        </div><br>

        <div class="row justify-content-md-center">
            <div class="col-md-12">
                <div class="tile">


                    <form action="{{ route('update-staff', $staff->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="tile-body">
                            <div class="form-group">

                                <span style="color: #438EB9">Upload a Staff Image</span>
                                <input type="file" name="staff_profile" class="form-control" accept="image/*" />

                                <br>

                                <label class="ace-file-input">
                                    <span style="color: #438EB9">Enter a Staff Name</span>
                                    <input class="form-control" type="text" name="staff_name" value="{{ $staff->staff_name }}"
                                        placeholder="Enter Staff Name">
                                </label> <br><br>

                                <label class="ace-file-input">
                                    <span style="color: #438EB9">Enter a Email</span>
                                    <input class="form-control" type="email" name="staff_email" value="{{ $staff->staff_email }}"
                                        placeholder="Enter Staff Email">
                                </label> <br><br>

                                <label class="ace-file-input">
                                    <span style="color: #438EB9">Enter a Password</span>
                                    <input class="form-control" type="text" name="password"
                                        value="{{ $staff->password }}" placeholder="Enter Staff Password">
                                </label> <br><br>

                                <label class="ace-file-input">
                                    <span style="color: #438EB9">Enter a Staff Phone</span>
                                    <input class="form-control" type="text" name="staff_phone_no" value="{{ $staff->staff_phone_no }}"
                                        placeholder="Enter Staff Phone">
                                </label> <br><br>


                                <label class="ace-file-input">
                                    <span style="color: #307ECC">Enter a Address</span>
                                    <input class="form-control" type="text" name="staff_address"
                                        value="{{ $staff->staff_address }}" placeholder="Enter Staff Address">
                                </label> <br><br>

                            </div>

                        </div>
                        <div class="tile-footer ">
                            <button class="btn btn-primary" type="submit"><i
                                    class="fa fa-fw fa-lg fa-check-circle"></i>Update
                            </button>
                            <a href="{{ route('all-staff') }}" class="btn btn-primary mr-2">
                                <i class="fa fa-fw fa-lg fa-arrow-circle-left"></i>Go Back
                            </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>



@endsection
