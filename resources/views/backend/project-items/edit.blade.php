@extends('backend.layouts.master')

@section('content')

    <div class="col-md-1"></div>

    <div class="col-md-10"
        style="border: 3px solid #438EB9; padding-left: 20px; padding-right: 20px; padding-bottom: 25px; margin-top: 15px;">
        <div class="table-header">
            <p style="font-size: 15px;">Edit this Project Item</p>
        </div>
        <div>
            <div class="clearfix">
                <div class="pull-right tableTools-container"></div>
            </div>
        </div>

        <div style="margin-top: 15px;">
            <div class="tile">
                <form action="{{ route('update-project-item', $projectItem->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">


                            <label class="ace-file-input">
                                <span style="color: #438EB9">Enter a Project Item Name </span>
                                <input class="form-control" type="text" name="project_name" value="{{ $projectItem->project_name }}" placeholder="Enter a Project Item Name" required>
                            </label><br><br>

                            <label class="ace-file-input">
                                <span style="color: #438EB9">Enter a Project Item Description </span>
                                <input class="form-control" type="text" name="project_description" value="{{ $projectItem->project_description }}" placeholder="Enter a Project Item Description" >
                            </label><br><br>

                            <label class="ace-file-input">
                                <span style="color: #438EB9">Enter a Project Project type </span>
                                <input class="form-control" type="text" name="project_type" value="{{ $projectItem->project_type }}" placeholder="Enter a Project Project type" >
                            </label><br><br>

                            <label class="ace-file-input">
                                <span style="color: #438EB9">Enter a Project Company Name </span>
                                <input class="form-control" type="text" name="company_name" value="{{ $projectItem->company_name }}" placeholder="Enter a Project Company Name" >
                            </label><br><br>



                        </div>
                    </div><br>
                    <div class="tile-footer ">
                        <button class="btn btn-primary" type="submit">
                            <i class="fa fa-fw fa-lg fa-check-circle"></i>Add Project Item
                        </button>
                        <a href="{{ route('all-project-item') }}" class="btn btn-primary mr-2">
                            <i class="fa fa-fw fa-lg fa-arrow-circle-left"></i>Go Back
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>


@endsection
