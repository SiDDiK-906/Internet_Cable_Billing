@extends('backend.layouts.master')

@section('content')
   <div class="col-md-12 col-sm-10">
       <div style=" text-align:right;" class="add-slider">
           <a class="btn btn-primary icon-btn" href="{{ route('create-account') }}"><i class="fa fa-plus"></i> Add New
               Account
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
                                    <th>Account</th>
                                    <th>Current Balance</th>
                                    <th>Company Name</th>
                                    <th>Status</th>
                                    <th>Created at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $x = 1 @endphp
                                @foreach ($accounts as $account)
                                    <tr>
                                        <td>@php echo $x++ @endphp</td>
                                        <td> {{ Str::limit($account->account_name ?? '', 30) }}</td>
                                        <td> {{ $account->current_balance ?? '' }}</td>
                                        <td> {{ $account->company_name ?? '' }}</td>
                                        <td>
                                            @if ($account->account_status == 1)
                                                <div class="btn-group action-group">
                                                    <a class="btn btn-success"
                                                        href="{{ route('deactive-account', $account->id) }}">
                                                        <i class="fa fa fa-toggle-on"></i>
                                                    </a>
                                                </div>
                                            @else
                                                <div class="btn-group action-group">
                                                    <a class="btn btn-secondary"
                                                        href="{{ route('active-account', $account->id) }}">
                                                        <i class="fa fa fa-toggle-off"></i>
                                                    </a>
                                                </div>
                                            @endif
                                        </td>
                                        <td>{{ $account->created_at ?? '' }}</td>
                                        <td>
                                            <div class="btn-group action-group">
                                                <a class="btn btn-primary" href="{{ route('edit-account', $account->id) }}">
                                                    <i class="fa fa fa-edit"></i>
                                                </a>
                                                <a type="submit" id="delete" class="btn btn-danger"
                                                    href="{{ route('destroy-account', $account->id) }}">
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
