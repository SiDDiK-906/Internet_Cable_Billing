@extends('backend.layouts.master')

@section('content')


    <div class="col-md-1"></div>
    <div class="col-md-10" style="border: 3px solid #438EB9;
        padding-left: 20px; padding-right: 20px; padding-bottom: 25px; margin-top: 15px;">

        <div class="table-header">
            <p style="font-size: 15px;">Update this User</p>
        </div>

        <div>
            {{-- <h3 class="header smaller lighter blue">Update this User</h3> --}}
            <div class="clearfix">
                <div class="pull-right tableTools-container"></div>
            </div>
            {{-- <div class="table-header">
                Update this User
            </div> --}}
        </div><br>

        <div class="row justify-content-md-center">
            <div class="col-md-12">
                <div class="tile">


                    <form action="{{ route('update-user', $user->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="tile-body">
                            <div class="form-group">
                                <span style="color: #438EB9">Upload a Image</span>
                                <input type="file" name="profile_image" class="form-control" accept="image/*" />
                                <br>
                                <img height="100" src="{{ asset($user->profile_image) }}"> <br> <br>

                                <label class="ace-file-input">
                                    <span style="color: #438EB9">Enter a Name</span>
                                    <input class="form-control" type="text" name="name" value="{{ $user->name }}"
                                        placeholder="Enter User Name">
                                </label> <br><br>

                                <label class="ace-file-input">
                                    <span style="color: #438EB9">Enter a Email</span>
                                    <input class="form-control" type="email" name="email" value="{{ $user->email }}"
                                        placeholder="Enter User Email">
                                </label> <br><br>

                                <label class="ace-file-input">
                                    <span style="color: #438EB9">Enter a User Phone</span>
                                    <input class="form-control" type="text" name="phone_number" value="{{ $user->phone_number }}"
                                        placeholder="Enter User Phone">
                                </label> <br><br>

                                <label class="ace-file-input">
                                    <span style="color: #438EB9">Enter a Password</span>
                                    <input class="form-control" type="text" name="password"
                                        value="{{ $user->password }}" placeholder="Enter User Password">
                                </label> <br><br>

                                <label class="ace-file-input">
                                    <span style="color: #438EB9">Select a Gender</span>
                                    <div class="form-group">
                                        <div>
                                            <select class="form-control" name="gender">


                                                <option value="male" {{ ($user->gender) == 'male' ? 'selected' : '' }}>
                                                    Male
                                                </option>

                                                <option value="female" {{ ($user->gender) == 'female' ? 'selected' : '' }}>
                                                    Female
                                                </option>

                                                <option value="other" {{ ($user->gender) == 'other' ? 'selected' : '' }}>
                                                    Other
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </label><br><br>

                                <label class="ace-file-input">
                                    <span style="color: #307ECC">Enter a Address</span>
                                    <input class="form-control" type="text" name="address"
                                        value="{{ $user->address }}" placeholder="Enter User Address">
                                </label> <br><br>

                            </div>

                        </div>
                        <div class="tile-footer ">
                            <button class="btn btn-primary" type="submit"><i
                                    class="fa fa-fw fa-lg fa-check-circle"></i>Update
                            </button>
                            <a href="{{ route('all-user') }}" class="btn btn-primary mr-2">
                                <i class="fa fa-fw fa-lg fa-arrow-circle-left"></i>Go Back
                            </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>



@endsection
