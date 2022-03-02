@extends('backend.layouts.master')

@section('content')

    <div class="col-md-1"></div>

    <div class="col-md-10"
        style="border: 3px solid #438EB9; padding-left: 20px; padding-right: 20px; padding-bottom: 25px; margin-top: 15px;">
        <div class="table-header">
            <p style="font-size: 15px;">Edit This Account</p>
        </div>
        <div>

            <div class="clearfix">
                <div class="pull-right tableTools-container"></div>
            </div>
       </div>

        <div style="margin-top: 15px;">
            <div class="tile">
                <form action="{{ route('update-account', $account->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">


                            <label class="ace-file-input">
                                <span style="color: #438EB9">Enter a Account Name</span>
                                <input class="form-control" type="text" name="account_name" value="{{ $account->account_name }}" placeholder="Enter a Account Name" required>
                            </label><br><br>

                            <label class="ace-file-input">
                                <span style="color: #438EB9">Enter a Current Balance </span>
                                <input class="form-control" type="number" name="current_balance" value="{{ $account->current_balance }}" placeholder="Enter a Current Balance" required>
                            </label><br><br>

                            <label class="ace-file-input">
                                <span style="color: #438EB9">Enter a Account Description </span>
                                <input class="form-control" type="text" name="account_description" value="{{ $account->account_description }}"  placeholder="Enter a Account Description" >
                            </label><br><br>

                            <label class="ace-file-input">
                                <span style="color: #438EB9">Enter a Company Name </span>
                                <input class="form-control" type="text" name="company_name" value="{{ $account->company_name }}" placeholder="Enter a Company Name">
                            </label><br>8


                        </div>
                   </div><br>
                    <div class="tile-footer ">
                        <button class="btn btn-primary" type="submit">
                            <i class="fa fa-fw fa-lg fa-check-circle"></i>Update Account
                        </button>
                        <a href="{{ route('all-account') }}" class="btn btn-primary mr-2">
                            <i class="fa fa-fw fa-lg fa-arrow-circle-left"></i>Go Back
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>


@endsection
