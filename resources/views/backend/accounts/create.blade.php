@extends('backend.layouts.master')

@section('content')
   <div class="col-md-1"></div>
   <div class="col-md-10"
       style="border: 3px solid #438EB9; padding-left: 20px; padding-right: 20px; padding-bottom: 25px; margin-top: 15px;">
        <div class="table-header">
            <p style="font-size: 15px;">Add a new Account</p>
        </div>
        <div>

            <div class="clearfix">
                <div class="pull-right tableTools-container"></div>
            </div>

        </div>

        <div style="margin-top: 15px;">
            <div class="tile">
                <form action="{{ route('store-account') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">


                            <label class="ace-file-input">
                                <input class="form-control" type="text" name="account_name" placeholder="Enter a Account Name" required>
                            </label><br>

                            <label class="ace-file-input">
                                <input class="form-control" type="number" name="current_balance" placeholder="Enter a Current Balance" required>
                            </label><br>

                            <label class="ace-file-input">
                                <input class="form-control" type="text" name="account_description" placeholder="Enter a Account Description" >
                            </label><br>

                            <label class="ace-file-input">
                                <input class="form-control" type="text" name="company_name" placeholder="Enter a Company Name">
                            </label><br>


                        </div>
                    </div><br>
                    <div class="tile-footer ">
                        <button class="btn btn-primary" type="submit">
                            <i class="fa fa-fw fa-lg fa-check-circle"></i>Add Account
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
