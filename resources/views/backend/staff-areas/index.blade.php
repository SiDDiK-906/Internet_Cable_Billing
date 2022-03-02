@extends('backend.layouts.master')

@section('content')

    <div class="col-md-12 col-sm-10">
        <div style=" text-align:right;" class="add-slider">
            <a class="btn btn-primary icon-btn" href="{{ route('create-staff-area') }}"><i class="fa fa-plus"></i> Assign New
                Staff Area
            </a>
        </div>

        <div class="row">
            <div class="col-md-12 col-sm-10">

                <div class="clearfix">
                    <div class="pull-right tableTools-container"></div>
                </div>

                <div class="table-header">
                    <div class="add-slider"><i class="fa fa-bars" aria-hidden="true"></i>
                        Result for All Assign Staff Areas
                    </div>
                </div>

                <div class="tile ">
                    <div class="tile-body">
                        <table class="table table-hover table-bordered datatable table-striped dataTable" id="dataTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Staff ID</th>
                                    <th>Area ID</th>
                                    <th>Created at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $x = 1 @endphp
                                @foreach ($staffAreas as $staffArea)
                                    <tr>
                                        <td>@php echo $x++ @endphp</td>
                                        <td> {{ $staffArea->fk_staff_id ?? ''}}</td>
                                        <td> {{ $staffArea->fk_area_id ?? ''}}</td>
                                        <td> {{ $staffArea->created_at ?? '' }}</td>
                                        <td>
                                            <div class="btn-group action-group">
                                                <a class="btn btn-primary" href="{{ route('edit-staff-area', $staffArea->id) }}">
                                                    <i class="fa fa fa-edit"></i>
                                                </a>
                                                <a type="submit" id="delete" class="btn btn-danger"
                                                    href="{{ route('destroy-staff-area', $staffArea->id) }}">
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
