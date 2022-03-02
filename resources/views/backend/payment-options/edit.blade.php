@extends('backend.layouts.master')

@section('content')


    <div class="col-md-1"></div>
    <div class="col-md-10" style="border: 3px solid #438EB9;
            padding-left: 20px; padding-right: 20px; padding-bottom: 25px; margin-top: 15px;">

        <div class="table-header">
            <p style="font-size: 15px;">Update this Payment Option</p>
        </div>

        <div>

            <div class="clearfix">
                <div class="pull-right tableTools-container"></div>
            </div><br>

            <div class="row justify-content-md-center">
                <div class="col-md-12">
                    <div class="tile">


                        <form action="{{ route('update-payment-option', $paymentOption->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="tile-body">
                                <div class="form-group">



                                    <label class="ace-file-input">
                                        <span style="color: #438EB9">Enter a Payment Name</span>
                                        <input class="form-control" type="text" name="name"
                                            value="{{ $paymentOption->name }}" placeholder="Enter Payment Name">

                                    </label> <br> <br>

                                    <label class="ace-file-input">
                                        <span style="color: #438EB9">Enter a Description</span>
                                        <input class="form-control" type="text" name="description"
                                            value="{{ $paymentOption->description }}" placeholder="Enter Description">

                                    </label> <br>



                                </div>

                            </div>
                            <div class="tile-footer ">
                                <button class="btn btn-primary" type="submit"><i
                                        class="fa fa-fw fa-lg fa-check-circle"></i>Update
                                </button>
                                <a href="{{ route('all-payment-option') }}" class="btn btn-primary mr-2">
                                    <i class="fa fa-fw fa-lg fa-arrow-circle-left"></i>Go Back
                                </a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>



    @endsection
