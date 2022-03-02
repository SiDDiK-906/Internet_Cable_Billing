@extends('backend.layouts.master')

@section('content')

    <div class="col-md-1"></div>

    <div class="col-md-10"
        style="border: 3px solid #438EB9; padding-left: 20px; padding-right: 20px; padding-bottom: 25px; margin-top: 15px;">
        <div class="table-header">
            <p style="font-size: 15px;">Add a new Area</p>
        </div>
        <div>
            {{-- <h3 class="header smaller lighter blue text-left">Add a new Area</h3> --}}
            <div class="clearfix">
                <div class="pull-right tableTools-container"></div>
            </div>
            {{-- <div class="table-header">
                Add a new Area
            </div> --}}
        </div>

        <div style="margin-top: 15px;">
            <div class="tile">
                <form action="{{ route('store-area') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">


                            <label class="ace-file-input">
                                <input class="form-control" type="text" name="area_name" placeholder="Enter a Area Name" required>
                            </label><br>


                        </div>
                    </div><br>
                    <div class="tile-footer ">
                        <button class="btn btn-primary" type="submit">
                            <i class="fa fa-fw fa-lg fa-check-circle"></i>Add Area
                        </button>
                        <a href="{{ route('all-area') }}" class="btn btn-primary mr-2">
                            <i class="fa fa-fw fa-lg fa-arrow-circle-left"></i>Go Back
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>


@endsection
