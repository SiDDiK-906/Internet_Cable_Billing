@extends('backend.layouts.master')

@section('content')


    <div class="col-md-1"></div>
    <div class="col-md-10" style="border: 3px solid #438EB9;
                padding-left: 20px; padding-right: 20px; padding-bottom: 25px; margin-top: 15px;">

        <div class="table-header">
            <p style="font-size: 15px;">Update this Transaction Type</p>
        </div>

        <div>
            <div class="clearfix">
                <div class="pull-right tableTools-container"></div>
            </div><br>

            <div class="row justify-content-md-center">
                <div class="col-md-12">
                    <div class="tile">

                        <form action="{{ route('update-transaction-type', $transactionType->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="tile-body">
                                <div class="form-group">
                                    <label class="ace-file-input">
                                        <span style="color: #438EB9">Enter a Transaction Type</span>
                                        <input class="form-control" type="text" name="cost_category_name"
                                            value="{{ $transactionType->cost_category_name }}"
                                            placeholder="Enter Transaction Type">
                                    </label><br><br>

                                    <label class="ace-file-input">
                                        <span style="color: #438EB9">Enter a Transaction Cost</span>
                                        <input class="form-control" type="text" name="cost_amount"
                                            value="{{ $transactionType->cost_amount }}"
                                            placeholder="Enter Transaction Cost">
                                    </label><br><br>

                                    <label class="ace-file-input">
                                        <span style="color: #438EB9">Enter a Description</span>
                                        <input class="form-control" type="text" name="description"
                                            value="{{ $transactionType->description }}" placeholder="Enter a Description">
                                    </label> <br>
                                </div>

                            </div>
                            <div class="tile-footer ">
                                <button class="btn btn-primary" type="submit"><i
                                        class="fa fa-fw fa-lg fa-check-circle"></i>Update
                                </button>
                                <a href="{{ route('all-transaction-type') }}" class="btn btn-primary mr-2">
                                    <i class="fa fa-fw fa-lg fa-arrow-circle-left"></i>Go Back
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>



    @endsection
