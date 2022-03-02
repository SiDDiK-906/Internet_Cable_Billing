@extends('backend.layouts.master')

@section('content')
   <div class="col-md-12 col-sm-10">
       <div style=" text-align:right;" class="add-slider">
           <a class="btn btn-primary icon-btn" href="{{ route('create-address') }}"><i class="fa fa-plus"></i> Add New
               Address
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
                                    <th>Address</th>
                                    <th>Country Name</th>
                                    <th>City Name</th>
                                    <th>Created at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $x = 1 @endphp
                                @foreach ($addresses as $address)
                                    <tr>
                                        <td>@php echo $x++ @endphp</td>
                                        <td> {{ Str::limit($address->address ?? '', 30) }}</td>
                                        <td> {{ $address->country_name ?? '' }}</td>
                                        <td> {{ $address->city_name ?? '' }}</td>

                                        <td>{{ $address->created_at ?? '' }}</td>
                                        <td>
                                            <div class="btn-group action-group">
                                                <a class="btn btn-primary" href="{{ route('edit-address', $address->id) }}">
                                                    <i class="fa fa fa-edit"></i>
                                                </a>
                                                <a type="submit" id="delete" class="btn btn-danger"
                                                    href="{{ route('destroy-address', $address->id) }}">
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

