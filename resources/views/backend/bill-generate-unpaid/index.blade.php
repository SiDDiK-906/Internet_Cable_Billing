@extends('backend.layouts.master')

@section('content')

    <div class="col-md-12 col-sm-10">

        <div class="row">
            <div class="col-md-12 col-sm-10">

                <div class="clearfix">
                    <div class="pull-right tableTools-container"></div>
                </div>

                {{-- <div class="table-header">
                    <div class="add-slider"><i class="fa fa-bars" aria-hidden="true"></i>
                        Generate Unpaid Bill
                    </div>
                </div> --}}
                <div class="form-group margin-top margin-bottom">
                    <form action="{{ route('all-bill-generate-get') }}" method="GET">
                        @csrf
                        @php
                            $carbon = \Carbon\Carbon::today();
                        @endphp
                        <div class="flex flex-position">
                            <div class="year">
                                <div class="label-position"><strong>Select Year</strong></div>
                                <div class="main-select">
                                    <select name="year">
                                        <option value=""> Select a Year </option>

                                        @for($i= date('Y'); $i >= date('Y') - 3; $i--)
                                            <option value="{{ $i }}" {{ old('year',date('Y')) == $i ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor

                                    </select>
                                </div>
                            </div>
                            <div class="month">
                                <div class="label-position"><strong>Select Month</strong></div>

                                <div class="main-select">
                                    <select name="month">
                                        <option value=""> Select a Month </option>
                                        @for($i = 1; $i <= 12; $i++)

                                            @php
                                                $m = str_pad($i, 2, "0", STR_PAD_LEFT);
                                                $month = date('Y-') . $m;
                                            @endphp

                                            <option value="{{ $i }}" {{ old('month',date('m')) == $m ? 'selected' : '' }}>{{ Carbon::parse($month)->format('F') }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="area">
                                <div class="label-position"><strong>Select Area</strong></div>
                                <div class="main-select">
                                    <select name="area">

                                        @if (Auth()->user()->type == 1)

                                            @if (staff_id_check(Auth()->id()) == NULL)

                                                <option>{{ 'You dont have any Staff Credential' }}</option>

                                            @else

                                                <option value="{{ role(Auth()->user()->fk_staff_id)->id }}">{{ role(Auth()->user()->fk_staff_id)->area_name }}</option>

                                            @endif

                                        @else

                                            {{-- <option value=""> Select a Area </option> --}}

                                            @foreach ($areas as $area)
                                                <option value="{{ $area->id }}">{{ $area->area_name }}</option>
                                            @endforeach

                                        @endif
                                    </select>
                                </div>
                            </div>
                                @if (Auth()->user()->type == 1)

                                    @if (staff_id_check(Auth()->id()) == NULL)

                                        <button class="my-button border-radius button-position" disabled>Confirm</button>

                                    @else

                                        <button type="submit" class="my-button border-radius button-position">Confirm</button>

                                    @endif

                                @else
                                    <button type="submit" class="my-button border-radius button-position">Confirm</button>
                                @endif
                        </div>
                    </form>
                </div>
                @if ($customers == '0')
                <div class="text-right" style="margin-bottom: 10px">
                    <button class="my-button generate-button" type="submit">Generate Unpaid Bill</button>
                </div>
                <div class="tile ">
                    <div class="tile-body">
                        <table class="table table-hover table-bordered datatable table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Year</th>
                                    <th>Month</th>
                                    <th>Area</th>
                                    <th>Customer Id</th>
                                    <th>Customer Name</th>
                                    <th>Customer Phone</th>
                                    {{-- <th class="text-center">Action</th> --}}
                                    <th>
                                        <input type="checkbox" id="selectAll"  style="cursor: pointer">
                                    </th>
                                </tr>
                            </thead>
                                <tbody>

                                </tbody>
                        </table>
                        {{-- {{ url()->current() }} --}}
                        {{-- {{ $customers->links() }} --}}
                    </div>
                </div>
                @else
                    @if ($customers->count() == 0)
                        <tbody>
                            <tr>
                                <td colspan="50">
                                    <div class="alert alert-danger text-center">
                                        <span class="text-danger"> No Data To Show </span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    @else
                    <form action="{{ route('store-bill-generate') }}" method="POST">
                        @csrf
                        <div class="text-right" style="margin-bottom: 10px">
                            <button class="my-button generate-button" type="submit">Generate Unpaid Bill</button>
                        </div>
                        <div class="tile ">
                            <div class="tile-body">
                                <table class="table table-hover table-bordered datatable table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Year</th>
                                            <th>Month</th>
                                            <th>Area</th>
                                            <th>Customer Id</th>
                                            <th>Customer Name</th>
                                            <th>Customer Phone</th>
                                            {{-- <th class="text-center">Action</th> --}}
                                            <th>
                                                <input type="checkbox" id="selectAll"  style="cursor: pointer">
                                            </th>
                                        </tr>
                                    </thead>
                                        <tbody>
                                            @php $x = 1 @endphp
                                            @foreach ($customers as $customer)
                                                <tr>
                                                    <td>@php echo $x++ @endphp</td>
                                                    <td>{{ Session::get('year_session') }}</td>
                                                    <td>
                                                        @if (Session::get('month_session') == 1)
                                                            January
                                                        @elseif (Session::get('month_session') == 2)
                                                            February
                                                        @elseif (Session::get('month_session') == 3)
                                                            March
                                                        @elseif (Session::get('month_session') == 4)
                                                            April
                                                        @elseif (Session::get('month_session') == 5)
                                                            May
                                                        @elseif (Session::get('month_session') == 6)
                                                            June
                                                        @elseif (Session::get('month_session') == 7)
                                                            July
                                                        @elseif (Session::get('month_session') == 8)
                                                            August
                                                        @elseif (Session::get('month_session') == 9)
                                                            September
                                                        @elseif (Session::get('month_session') == 10)
                                                            October
                                                        @elseif (Session::get('month_session') == 11)
                                                            November
                                                        @else
                                                            December
                                                        @endif
                                                    </td>
                                                    <td>{{ $customer->areas->area_name }}</td>
                                                    <td>{{ $customer->customer_id }}</td>
                                                    <td>{{ $customer->customer_name }}</td>
                                                    <td>{{ $customer->customer_phone }}</td>
                                                    {{-- <td id="generate_button_td{{ $customer->id }}" class="text-center generate_button_td{{ $customer->id }}">
                                                        <option class="btn btn-sm btn-primary generate_button_class" value="{{ $customer->id }}">Generate Bill</option>
                                                    </td> --}}
                                                    <td>
                                                        <input type="checkbox" name="customer_id[]" value="{{ $customer->id }}"  style="cursor: pointer">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </form>
                                </table>
                                {{-- {{ url()->current() }} --}}
                                {{-- {{ $customers->links() }} --}}
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>


@endsection
@section('scripts')
<!-- checkbox js -->
<script src="{{ asset('assets/backend/js/jquery-1.12.4.min.js') }}"></script>
<script src="{{ asset('assets/backend/js/jquery.selectallcheckbox.js') }}"></script>
<script>

    function onChange( checkboxes, checkedState ) {}

    $( document ).ready( function(){
       $( "#selectAll" ).selectAllCheckbox({
          checkboxesName   : "customer_id[]",
          onChangeCallback : onChange,
          useIndeterminate : false
       });
    });


    // generate bill
    $(document).ready(function(){

        // catching id
        $('.generate_button_class').click(function(){
            var id = $(this).val();

            // ajax basic start
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // ajax custom start
            $.ajax({
                type:'POST',
                url:'/get/generate/data',
                data:{id:id},
                success:function(data){
                    $('.generate_button_td'+id).html(data);
                }
            });
        });
    });
</script>
@endsection
