@extends('backend.layouts.master')

@section('content')

    <div class="col-md-12 col-sm-10">
        <div style=" text-align:right;" class="add-slider">
            <a class="btn btn-primary icon-btn" href="{{ route('create-user') }}"><i class="fa fa-plus"></i> Add New
                User
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
                        Result for All Users
                    </div>
                </div>

                <div class="tile ">
                    <div class="tile-body">
                        <table class="table table-hover table-bordered datatable table-striped" id="dataTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Profile Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Status</th>
                                    <th>Created at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $x = 1 @endphp
                                @foreach ($users as $user)
                                    <tr>
                                        <td>@php echo $x++ @endphp</td>
                                        <td> <img height="50" src="{{ asset($user->profile_image ?? '') }}" alt="User Profile Image">
                                        </td>
                                        <td> {{ Str::limit($user->name ?? '', 30) }}</td>
                                        <td> {{ $user->email ?? '' }}</td>
                                        <td> {{ $user->phone_number ?? '' }}</td>
                                        <td> {{ $user->address ?? '' }}</td>
                                        <td>
                                            @if ($user->status == 1)
                                                <div class="btn-group action-group">
                                                    <a class="btn btn-success"
                                                        href="{{ route('deactive-user', $user->id) }}">
                                                        <i class="fa fa fa-toggle-on"></i>
                                                    </a>
                                                </div>
                                            @else
                                                <div class="btn-group action-group">
                                                    <a class="btn btn-secondary"
                                                        href="{{ route('active-user', $user->id) }}">
                                                        <i class="fa fa fa-toggle-off"></i>
                                                    </a>
                                                </div>
                                            @endif
                                        </td>
                                        <td>{{ $user->created_at ?? '' }}</td>
                                        <td>
                                            <div class="btn-group action-group">
                                                <a class="btn btn-primary" href="{{ route('edit-user', $user->id) }}">
                                                    <i class="fa fa fa-edit"></i>
                                                </a>
                                                @if ($user->type == 0)
                                                    <a type="submit" id="delete" class="btn btn-danger not-allowed">
                                                        <i class="fa fa-lg fa-trash"></i>
                                                    </a>
                                                @else
                                                    <a type="submit" id="delete" class="btn btn-danger"
                                                        href="{{ route('destroy-user', $user->id) }}">
                                                        <i class="fa fa-lg fa-trash"></i>
                                                    </a>
                                                @endif
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
