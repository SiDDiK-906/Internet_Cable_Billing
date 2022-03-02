@extends('backend.layouts.master')

@section('content')

    <div class="col-md-1"></div>

    <div class="col-md-10"
        style="border: 3px solid #438EB9; padding-left: 20px; padding-right: 20px; padding-bottom: 25px; margin-top: 15px;">
        <div class="table-header">
            <p style="font-size: 15px;">Update Company Information: {{ $companyInfo->company_name ?? '' }}</p>
        </div>
        <div>

            <div class="clearfix">
                <div class="pull-right tableTools-container"></div>
            </div>

        </div>

        <div style="margin-top: 15px;">
            <div class="tile">
                <form action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="tile-body">
                        <div class="form-group">



                            <label class="ace-file-input">
                                <span style="color: #438EB9">Enter a Customer Name</span>
                                <input class="form-control" type="text" name="company_name"
                                    value="{{ $companyInfo->company_name ?? '' }}" placeholder="Enter Customer Name"
                                    required>
                            </label><br><br>

                            <label class="ace-file-input">
                                <span style="color: #438EB9">Enter a Web Address</span>
                                <input class="form-control" type="text" name="web_address"
                                    value="{{ $companyInfo->web_address ?? '' }}" placeholder="Enter a Web Address">
                            </label><br><br>

                            <label class="ace-file-input">
                                <span style="color: #438EB9">Enter a Company Address</span>
                                <input class="form-control" type="text" name="company_address"
                                    value="{{ $companyInfo->company_address ?? '' }}"
                                    placeholder="Enter a Company Address">
                            </label><br><br>

                            <label class="ace-file-input">
                                <span style="color: #438EB9">Enter a Company Email</span>
                                <input class="form-control" type="email" name="company_email"
                                    value="{{ $companyInfo->company_email ?? '' }}" placeholder="Enter a Company Email">
                            </label><br><br>

                            <label class="ace-file-input">
                                <span style="color: #438EB9">Enter a Company Phone</span>
                                <input class="form-control" type="number" name="company_phone"
                                    value="{{ $companyInfo->company_phone ?? '' }}" placeholder="Enter a Company Phone">
                            </label><br><br>


                            <span style="color: #438EB9">Enter a Company Logo | Logo Size: 300 x 300</span>
                            <input class="form-control" type="file" accept="image/*" name="company_logo">

                            <br>
                            <img style="width: 50px; hight: 50px;" src="{{ $companyInfo->company_logo ?? '' }}" alt="Company Logo">
                            <br><br>


                            <span style="color: #438EB9">Enter a Company Icon | Logo Size: 500 x 500</span>
                            <input class="form-control" type="file" accept="image/*" name="company_icon">

                            <br>
                            <img style="width: 100px; hight: 100px;" src="{{ $companyInfo->company_icon ?? '' }}" alt="Company Icon">
                            <br><br>


                            <label class="ace-file-input">
                                <span style="color: #438EB9">Enter a Facebook Page Link</span>
                                <input class="form-control" type="text" name="fb_page_link"
                                    value="{{ $companyInfo->fb_page_link ?? '' }}"
                                    placeholder="Enter a Facebook Page Link">
                            </label><br><br>



                        </div>
                    </div><br>
                    <div class="tile-footer ">
                        <button class="btn btn-primary" type="submit">
                            <i class="fa fa-fw fa-lg fa-check-circle"></i>Update Company Info
                        </button>
                        <a href="{{ route('all-company-info') }}" class="btn btn-primary mr-2">
                            <i class="fa fa-fw fa-lg fa-arrow-circle-left"></i>Go Back
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>


@endsection
