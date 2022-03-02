@extends('backend.layouts.master')

@section('content')

    <div class="col-md-1"></div>

    <div class="col-md-10"
        style="border: 3px solid #438EB9; padding-left: 20px; padding-right: 20px; padding-bottom: 25px; margin-top: 15px;">
        <div class="table-header">
            <p style="font-size: 15px;">Edit this Client</p>
        </div>
        <div>
            <div class="clearfix">
                <div class="pull-right tableTools-container"></div>
            </div>
        </div>

        <div style="margin-top: 15px;">
            <div class="tile">
                <form action="{{ route('update-client', $client->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">


                            <label class="ace-file-input">
                                <span style="color: #438EB9"> Enter a Client ID </span>
                                <input class="form-control" type="text" name="client_id" value="{{ $client->client_id }}" placeholder="Enter a Client ID">
                            </label><br><br>

                            <label class="ace-file-input">
                                <span style="color: #438EB9">Enter a Client Name </span>
                                <input class="form-control" type="text" name="client_name" value="{{ $client->client_name }}" placeholder="Enter a Client Name" required>
                            </label><br><br>

                            <label class="ace-file-input">
                                <span style="color: #438EB9">Enter a Client Mobile No. </span>
                                <input class="form-control" type="number" name="mobile_no" value="{{ $client->mobile_no }}" placeholder="Enter a Client Mobile No." >
                            </label><br><br>

                            <label class="ace-file-input">
                                <span style="color: #438EB9">Enter a Client Address </span>
                                <input class="form-control" type="text" name="address" value="{{ $client->address }}" placeholder="Enter a Client Address" >
                            </label><br><br>

                            <label class="ace-file-input">
                                <span style="color: #438EB9">Enter a Client Email </span>
                                <input class="form-control" type="email" name="email_id" value="{{ $client->email_id }}" placeholder="Enter a Client Email" >
                            </label><br><br>

                            <label class="ace-file-input">
                                <span style="color: #438EB9">Enter a Client Type </span>
                                <input class="form-control" type="text" name="client_type" value="{{ $client->client_type }}" placeholder="Enter a Client Type" >
                            </label><br><br>

                            <label class="ace-file-input">
                                <span style="color: #438EB9">Enter a Client Company </span>
                                <input class="form-control" type="text" name="company_name" value="{{ $client->company_name }}" placeholder="Enter a Client Company" >
                            </label><br>


                        </div>
                    </div><br>
                    <div class="tile-footer ">
                        <button class="btn btn-primary" type="submit">
                            <i class="fa fa-fw fa-lg fa-check-circle"></i>Update Client
                        </button>
                        <a href="{{ route('all-client') }}" class="btn btn-primary mr-2">
                            <i class="fa fa-fw fa-lg fa-arrow-circle-left"></i>Go Back
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>


@endsection
