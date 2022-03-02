@extends('backend.layouts.master')

@section('content')

    <div class="col-md-1"></div>

    <div class="col-md-10"
        style="border: 3px solid #438EB9; padding-left: 20px; padding-right: 20px; padding-bottom: 25px; margin-top: 15px;">
        <div class="table-header">
            <p style="font-size: 15px;">Edit this Category Name</p>
        </div>
        <div>
            <div class="clearfix">
                <div class="pull-right tableTools-container"></div>
            </div>
        </div>

        <div style="margin-top: 15px;">
            <div class="tile">
                <form action="{{ route('update-product-category', $productCategory->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">

                            <label class="ace-file-input">
                                <span style="color: #438EB9">Enter a Category Name </span>
                                <input class="form-control" type="text" name="category_name" value="{{ $productCategory->category_name }}" placeholder="Enter a Category Name " required>
                            </label><br><br>


                        </div>
                    </div><br>
                    <div class="tile-footer ">
                        <button class="btn btn-primary" type="submit">
                            <i class="fa fa-fw fa-lg fa-check-circle"></i>Update Category
                        </button>
                        <a href="{{ route('all-product-category') }}" class="btn btn-primary mr-2">
                            <i class="fa fa-fw fa-lg fa-arrow-circle-left"></i>Go Back
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>


@endsection
