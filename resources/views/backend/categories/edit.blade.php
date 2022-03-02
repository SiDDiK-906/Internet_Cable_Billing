@extends('backend.layouts.master')

@section('content')


    <div class="col-md-1"></div>
    <div class="col-md-10" style="border: 3px solid #438EB9;
        padding-left: 20px; padding-right: 20px; padding-bottom: 25px; margin-top: 15px;">

        <div class="table-header">
            <p style="font-size: 15px;">Update this category</p>
        </div>

        <div>
            {{-- <h3 class="header smaller lighter blue">Update this category</h3> --}}
            <div class="clearfix">
                <div class="pull-right tableTools-container"></div>
            </div>
            {{-- <div class="table-header">
                Update this category
            </div> --}}
        </div><br>

        <div class="row justify-content-md-center">
            <div class="col-md-12">
                <div class="tile">


                    <form action="{{ route('update-category', $category->id) }}" method="post">
                        @csrf
                        <div class="tile-body">
                            <div class="form-group">

                                <label class="ace-file-input">
                                    <span style="color: #438EB9">Category Name</span>
                                    <input class="form-control" type="text" name="category_name" value="{{ $category->category_name }}"
                                        placeholder="Enter category Name">
                                </label> <br><br>

                                <label class="ace-file-input">
                                    <span style="color: #438EB9">Company Name</span>
                                    <input class="form-control" type="text" name="company_name" value="{{ $category->company_name }}"
                                        placeholder="Enter Company Name">
                                </label> <br><br>

                                <label class="ace-file-input">
                                    <span style="color: #438EB9">Category Type</span>
                                    <input class="form-control" type="text" name="category_type" value="{{ $category->category_type }}"
                                        placeholder="Enter category Phone">
                                </label> <br><br>

                            </div>

                        </div>
                        <div class="tile-footer ">
                            <button class="btn btn-primary" type="submit"><i
                                    class="fa fa-fw fa-lg fa-check-circle"></i>Update
                            </button>
                            <a href="{{ route('all-category') }}" class="btn btn-primary mr-2">
                                <i class="fa fa-fw fa-lg fa-arrow-circle-left"></i>Go Back
                            </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>



@endsection
