@extends('backend.layouts.master')

@section('content')

    <div class="col-md-12 col-sm-10">
        <div style=" text-align:right;" class="add-slider">
            <a class="btn btn-primary icon-btn" href="{{ route('create-area') }}"><i class="fa fa-plus"></i> Add New
                Area
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
                        Result for All Areas
                    </div>
                </div>

                <div class="tile ">
                    <div class="tile-body">
                        <table class="table table-hover table-bordered datatable table-striped" id="dataTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Area</th>
                                    <th>Status</th>
                                    <th>Created at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($areas as $area)
                                    @if ($area->id == 37 or $area->id == 38 or $area->id == 39 or $area->id == 40)
                                        
                                    @else
                                        <tr>
                                            <td>{{ $loop->index+1 }}</td>
                                            <td> {{ Str::limit($area->area_name ?? '', 30) }}</td>
                                            <td>
                                                @if ($area->status == 1)
                                                    <div class="btn-group action-group">
                                                        <a class="btn btn-success"
                                                            href="{{ route('deactive-area', $area->id) }}">
                                                            <i class="fa fa fa-toggle-on"></i>
                                                        </a>
                                                    </div>
                                                @else
                                                    <div class="btn-group action-group">
                                                        <a class="btn btn-secondary"
                                                            href="{{ route('active-area', $area->id) }}">
                                                            <i class="fa fa fa-toggle-off"></i>
                                                        </a>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>{{ $area->created_at ?? '' }}</td>
                                            <td>
                                                <div class="btn-group action-group">
                                                    <a class="btn btn-primary" href="{{ route('edit-area', $area->id) }}">
                                                        <i class="fa fa fa-edit"></i>
                                                    </a>
                                                    <a type="submit" id="delete" class="btn btn-danger"
                                                        href="{{ route('destroy-area', $area->id) }}">
                                                        <i class="fa fa-lg fa-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
