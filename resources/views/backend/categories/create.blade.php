@extends('backend.layouts.master')

@section('content')

    <div class="col-md-1"></div>

    <div class="col-md-10"
        style="border: 3px solid #438EB9; padding-left: 20px; padding-right: 20px; padding-bottom: 25px; margin-top: 15px;">
        <div class="table-header">
            <p style="font-size: 15px;">Add a new Category</p>
        </div>
        <div>
            <div class="clearfix">
                <div class="pull-right tableTools-container"></div>
            </div>
        </div>

        <div style="margin-top: 15px;">
            <div class="tile">
                <form action="{{ route('store-category') }}" method="post">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">
                            <label class="ace-file-input">
                                <input class="form-control" type="text" name="category_name" placeholder="Enter Category Name" required>
                            </label><br>

                            <label class="ace-file-input">
                                <input class="form-control" type="text" name="company_name" placeholder="Enter Company Name" required>
                            </label><br>

                            <label class="ace-file-input">
                                <input class="form-control" type="text" name="category_type" placeholder="Enter Category Type">
                            </label><br>

                            <label class="ace-file-input">
                                <select name="category_status" class="form-control" required>
                                    <option value="">Set Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Deactive</option>
                                </select>
                            </label><br>
                        </div>
                    </div><br>
                    <div class="tile-footer ">
                        <button class="btn btn-primary" type="submit">
                            <i class="fa fa-fw fa-lg fa-check-circle"></i>Add Category
                        </button>
                        <a href="{{ route('all-category') }}" class="btn btn-primary mr-2">
                            <i class="fa fa-fw fa-lg fa-arrow-circle-left"></i>Go Back
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>


@endsection
