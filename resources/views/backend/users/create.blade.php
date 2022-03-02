@extends('backend.layouts.master')

@section('content')
    <div class="col-md-1"></div>
    <div class="col-md-10"
        style="border: 3px solid #438EB9; padding-left: 20px; padding-right: 20px; padding-bottom: 25px; margin-top: 15px;">
        <div class="table-header">
            <p style="font-size: 15px;">Add a new User</p>
        </div>
        <div>
            {{-- <h3 class="header smaller lighter blue text-left">Add a new User</h3> --}}
            <div class="clearfix">
                <div class="pull-right tableTools-container"></div>
            </div>
            {{-- <div class="table-header">
                Add a new User
            </div> --}}
        </div>

        <div style="margin-top: 15px;">
            <div class="tile">

                <div class="border_type" style="margin-bottom: 30px;">
                    <select id="select_type" class="form-control container select_type" style="font-weight: regular;">
                        <option value="">Select a Type</option>
                        <option value="0">Admin</option>
                        <option value="1">Staff</option>
                    </select>
                </div>

                <div id="main_part">
                    <div class="user_part" style="display: none">
                        <form action="{{ route('store-user',$id = 0) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="tile-body">
                                <div class="form-group">
                                    <input class="form-control" type="file" name="profile_image" accept="image/*" /> <br>

                                    <label class="ace-file-input">
                                        <input class="form-control" type="text" name="name" placeholder="Enter User Name" required>
                                    </label><br>

                                    <label class="ace-file-input">
                                        <input class="form-control" type="email" name="email" placeholder="Enter User Email" required>
                                    </label><br>

                                    <label class="ace-file-input">
                                        <input class="form-control" type="text" name="password"
                                            placeholder="Enter User Password" required>
                                    </label><br>

                                    <label class="ace-file-input">
                                        <input class="form-control" type="text" name="phone_number" placeholder="Enter User Phone">
                                    </label><br>

                                    <label class="ace-file-input">
                                        <div class="form-group">
                                            <div>
                                                <select class="form-control" name="gender">
                                                    <option value="">Select Gender</option>

                                                    <option value="male">
                                                        Male
                                                    </option>

                                                    <option value="female">
                                                        Female
                                                    </option>

                                                    <option value="other">
                                                        Other
                                                    </option>

                                                </select>
                                            </div>
                                        </div>
                                    </label><br>

                                    <label class="ace-file-input">
                                        <input class="form-control" type="text" name="address" placeholder="Enter User Address">
                                    </label><br>
                                </div>
                            </div><br>
                            <div class="tile-footer ">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fa fa-fw fa-lg fa-check-circle"></i>Add User
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="staff_part" style="display: none">
                        <form action="{{ route('store-user',$id = 1) }}" method="post" enctype="multipart/form-data">
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

                                    {{-- <label class="ace-file-input">
                                        <select name="type" class="form-control">
                                            <option value="">Select a Type <small> (Optional)</small></option>
                                            <option value="0">As an Admin</option>
                                            <option value="1">As a Staff</option>
                                        </select>
                                    </label><br> --}}
                                </div>
                            </div><br>
                            <div class="tile-footer ">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fa fa-fw fa-lg fa-check-circle"></i>Add Staff
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>


@endsection
@section('scripts')
<script src="{{ asset('assets/backend/js/jquery-1.12.4.min.js') }}"></script>
<script>
    $(document).ready(function(){
        $('.select_type').change(function(){

            var id = $(this).val();

            if (id == 0) {

                $('.user_part').show();
                $('.staff_part').hide();

            } else {

                $('.staff_part').show();
                $('.user_part').hide();

            }

        });

    });
</script>
@endsection
