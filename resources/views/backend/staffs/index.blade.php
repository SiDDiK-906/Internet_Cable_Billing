@extends('backend.layouts.master')

@section('content')

    <div class="col-md-12 col-sm-10">
        <div style=" text-align:right;" class="add-slider">
            <a class="btn btn-primary icon-btn" href="{{ route('create-staff') }}"><i class="fa fa-plus"></i> Add New
                Staff
            </a>
        </div>

        <div class="row">
            <div class="col-md-12 col-sm-10">

                {{-- <h3 class="header smaller lighter blue">Add New Slider</h3> --}}

                <div class="clearfix">
                    <div class="pull-right tableTools-container"></div>
                </div>

                <div class="table-header">
                    <div class="add-slider"><i class="fa fa-bars" aria-hidden="true"></i>
                        Result for All Staffs
                    </div>
                </div>

                <div class="tile ">
                    <div class="tile-body">
                        <table class="table table-hover table-bordered datatable table-striped" id="dataTable">
                            <thead>
                                <tr>
                                    <th>#</th>

                                    <th>Staff Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Created at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $x = 1 @endphp
                                @foreach ($staffs as $staff)
                                    <tr>
                                        <td>@php echo $x++ @endphp</td>

                                        <td> {{ Str::limit($staff->staff_name ?? '', 30) }}</td>
                                        <td> {{ $staff->staff_email ?? '' }}</td>
                                        <td>
                                            @if ($staff->staff_status == 1)
                                                <div class="btn-group action-group">
                                                    <a class="btn btn-success"
                                                        href="{{ route('deactive-staff', $staff->id) }}">
                                                        <i class="fa fa fa-toggle-on"></i>
                                                    </a>
                                                </div>
                                            @else
                                                <div class="btn-group action-group">
                                                    <a class="btn btn-secondary"
                                                        href="{{ route('active-staff', $staff->id) }}">
                                                        <i class="fa fa fa-toggle-off"></i>
                                                    </a>
                                                </div>
                                            @endif
                                        </td>
                                        <td>{{ $staff->created_at ?? '' }}</td>
                                        <td>
                                            <div class="btn-group action-group">
                                                <a class="btn btn-primary" href="{{ route('edit-staff', $staff->id) }}">
                                                    <i class="fa fa fa-edit"></i>
                                                </a>
                                                <a type="submit" id="delete" class="btn btn-danger"
                                                    href="{{ route('destroy-staff', $staff->id) }}">
                                                    <i class="fa fa-lg fa-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
