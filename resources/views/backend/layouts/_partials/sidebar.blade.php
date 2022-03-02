<div id="sidebar" class="sidebar responsive ace-save-state" style="font-family: 'Ubuntu', sans-serif;">
    <script type="text/javascript">
        try {
            ace.settings.loadState('sidebar')
        } catch (e) {}
    </script>

    <div class="sidebar-shortcuts" id="sidebar-shortcuts">
        <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
            <button class="btn btn-success">
                <i class="ace-icon fa fa-signal"></i>
            </button>

            <button class="btn btn-info">
                <i class="ace-icon fa fa-pencil"></i>
            </button>

            <button class="btn btn-warning">
                <i class="ace-icon fa fa-users"></i>
            </button>

            <button class="btn btn-danger">
                <i class="ace-icon fa fa-cogs"></i>
            </button>
        </div>

        <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
            <span class="btn btn-success"></span>

            <span class="btn btn-info"></span>

            <span class="btn btn-warning"></span>

            <span class="btn btn-danger"></span>
        </div>
    </div><!-- /.sidebar-shortcuts -->


    <!-- side menu start here -->
    <ul class="nav nav-list">

        <!-- dashboard index -->
        <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}">
                <i class="menu-icon fa fa-tachometer"></i>
                <span class="menu-text"> Dashboard </span>
            </a>

            <b class="arrow"></b>
        </li>



        {{-- Billing System --}}
        <li
            class="
                {{ request()->routeIs('all-bill-generate') ? 'open active' : '' }}
                {{ request()->routeIs('all-bill-generate-get') ? 'open active' : '' }}

                {{ request()->routeIs('all-bill-month-wise') ? 'open active' : '' }}
                {{ request()->routeIs('all-bill-month-wise-get') ? 'open active' : '' }}

                {{ request()->routeIs('create-bill-month-wise') ? 'open active' : '' }}
                {{ request()->routeIs('create-bill-month-wise-get') ? 'open active' : '' }}
                {{ request()->routeIs('view-bill-month-wise') ? 'open active' : '' }}
                {{ request()->routeIs('view-bill-month-wise-get') ? 'open active' : '' }}

                {{ request()->routeIs('all-bill-status') ? 'open active' : '' }}
                {{ request()->routeIs('all-bill-status-get') ? 'open active' : '' }}

                {{ request()->routeIs('all-bill-report') ? 'open active' : '' }}
                {{ request()->routeIs('all-bill-report-get') ? 'open active' : '' }}

                {{-- for Billing Payment --}}
                {{ request()->routeIs('create-bill-month-wise') ? 'open active' : '' }}
                {{ request()->routeIs('view-all-paid-bill-payment') ? 'open active' : '' }}
                {{ request()->routeIs('view-all-due-bill-payment') ? 'open active' : '' }}
                {{ request()->routeIs('make_voucher') ? 'open active' : '' }}
                {{-- for setting --}}
                {{ request()->routeIs('all-area') ? 'open active' : '' }}
                {{ request()->routeIs('create-area') ? 'open active' : '' }}
                {{ request()->routeIs('edit-area') ? 'open active' : '' }}

                {{ request()->routeIs('all-line-category') ? 'open active' : '' }}
                {{ request()->routeIs('create-line-category') ? 'open active' : '' }}
                {{ request()->routeIs('edit-line-category') ? 'open active' : '' }}

                {{ request()->routeIs('all-transaction-type') ? 'open active' : '' }}
                {{ request()->routeIs('create-transaction-type') ? 'open active' : '' }}
                {{ request()->routeIs('edit-transaction-type') ? 'open active' : '' }}

                {{ request()->routeIs('all-payment-option') ? 'open active' : '' }}
                {{ request()->routeIs('create-payment-option') ? 'open active' : '' }}
                {{ request()->routeIs('edit-payment-option') ? 'open active' : '' }}

                {{ request()->routeIs('all-customer') ? 'open active' : '' }}

                {{-- for customer --}}
                {{ request()->routeIs('create-customer') ? 'open active' : '' }}
                {{ request()->routeIs('edit-customer') ? 'open active' : '' }}
                {{ request()->routeIs('active-all-customer') ? 'open active' : '' }}
                {{ request()->routeIs('active_customer_search') ? 'open active' : '' }}
                {{ request()->routeIs('inactive_customer_search') ? 'open active' : '' }}
                {{ request()->routeIs('inactive-all-customer') ? 'open active' : '' }}
                {{ request()->routeIs('customer-transaction') ? 'open active' : '' }}

            ">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-usd"></i>
                <span class="menu-text"> Billing System </span>
                <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>

            <ul class="submenu">


                <!-- Month Wise Transition -->
                <li
                    class="
                            {{ request()->routeIs('all-bill-month-wise') ? 'active' : '' }}
                            {{ request()->routeIs('all-bill-month-wise-get') ? 'active' : '' }}
                        ">
                    <a href="{{ route('all-bill-month-wise') }}">
                        <i class="fa fa-credit-card"></i>
                        <span class="menu-text">Month Wise Payment</span>
                    </a>
                    <b class="arrow"></b>
                </li>






                {{-- Bill Payment --}}

                <li
                    class="
                            {{ request()->routeIs('create-bill-month-wise') ? 'active' : '' }}
                            {{ request()->routeIs('view-all-paid-bill-payment') ? 'active' : '' }}
                            {{ request()->routeIs('view-all-due-bill-payment') ? 'active' : '' }}
                            {{ request()->routeIs('make_voucher') ? 'active' : '' }}
                        ">
                    <a class="dropdown-toggle" style="cursor: pointer">
                        <i class="fa fa-credit-card"></i>

                        Billing Payment
                        <b class="arrow fa fa-angle-down"></b>
                    </a>

                    <b class="arrow"></b>

                    <ul class="submenu">
                        <li class="{{ request()->routeIs('create-bill-month-wise') ? 'active' : '' }}">
                            <a href="{{ route('create-bill-month-wise') }}">
                                <i class="fa fa-plus-square"></i>
                                Add New Payment
                            </a>

                            <b class="arrow"></b>
                        </li>

                        <li class="{{ request()->routeIs('view-all-paid-bill-payment') ? 'active' : '' }}">
                            <a href="{{ route('view-all-paid-bill-payment') }}">
                                <i class="fa fa-check-circle"></i>
                                Paid Transition
                            </a>

                            <b class="arrow"></b>
                        </li>
                        <li class="{{ request()->routeIs('view-all-due-bill-payment') ? 'active' : '' }}">
                            <a href="view-all-due-bill-payment">
                                <i class="fa fa-exclamation-triangle"></i>
                                Due Transition
                            </a>

                            <b class="arrow"></b>
                        </li>

                    </ul>
                </li>






                @if (Auth()->User()->type == 0)
                    <!-- Billing Status -->
                    <li
                        class="
                            {{ request()->routeIs('all-bill-status') ? 'active' : '' }}
                            {{ request()->routeIs('all-bill-status-get') ? 'active' : '' }}

                        ">
                        <a href="{{ route('all-bill-status') }}">
                            <i class="fa fa-info-circle"></i>
                            <span class="menu-text">Billing Status</span>
                        </a>
                        <b class="arrow"></b>
                    </li>
                @endif





                @if (Auth()->User()->type == 0)
                    <!-- Billing Report -->
                    <li
                        class="
                            {{ request()->routeIs('all-bill-report') ? 'active' : '' }}
                            {{ request()->routeIs('all-bill-report-get') ? 'active' : '' }}

                        ">
                        <a href="{{ route('all-bill-report') }}">
                            <i class="fa fa-flag"></i>
                            <span class="menu-text">Daily Report</span>
                        </a>
                        <b class="arrow"></b>
                    </li>
                @endif




                @if (Auth()->User()->type == 0)
                    <!-- Bill Generate -->
                    <li
                        class="
                            {{ request()->routeIs('all-bill-generate') ? 'active' : '' }}
                            {{ request()->routeIs('all-bill-generate-get') ? 'active' : '' }}

                        ">
                        <a href="{{ route('all-bill-generate') }}">
                            <i class="fa fa-credit-card"></i>
                            <span class="menu-text">Generate Bill</span>
                        </a>
                        <b class="arrow"></b>
                    </li>
                @endif




                @if (Auth()->User()->type == 0)

                    <!-- customer for admin-->
                    <li class="
                                {{ request()->routeIs('all-customer') ? 'active' : '' }}
                                {{ request()->routeIs('create-customer') ? 'active' : '' }}
                                {{ request()->routeIs('edit-customer') ? 'active' : '' }}
                                {{ request()->routeIs('active-all-customer') ? 'active' : '' }}
                                {{ request()->routeIs('active_customer_search') ? 'active' : '' }}
                                {{ request()->routeIs('inactive_customer_search') ? 'active' : '' }}
                                {{ request()->routeIs('inactive-all-customer') ? 'active' : '' }}
                                {{ request()->routeIs('customer-transaction') ? 'active' : '' }}
                                ">

                        <a class="dropdown-toggle" style="cursor: pointer">
                            <i class="fa fa-users"></i>

                            Customers
                            <b class="arrow fa fa-angle-down"></b>
                        </a>

                        <b class="arrow"></b>

                        <ul class="submenu">
                            <li class="
                                    {{ request()->routeIs('create-customer') ? 'active' : '' }}
                                ">
                                <a href="{{ route('create-customer') }}">
                                    <i class="fa fa-user-plus"></i>
                                    Add New Customer
                                </a>

                                <b class="arrow"></b>
                            </li>
                            {{-- <li class="">
                                <a href="{{ route('all-customer') }}">
                                    <i class="menu-icon fa fa-users"></i>
                                    All Customer
                                </a>

                                <b class="arrow"></b>
                            </li> --}}
                            <li class="
                                {{ request()->routeIs('active-all-customer') ? 'active' : '' }}
                                {{ request()->routeIs('active_customer_search') ? 'active' : '' }}
                                ">
                                <a href="{{ route('active-all-customer') }}">
                                    <i class="menu-icon fa fa-check-square-o"></i>
                                    Active Customer
                                </a>

                                <b class="arrow"></b>
                            </li>
                            <li class="
                                {{ request()->routeIs('inactive-all-customer') ? 'active' : '' }}
                                {{ request()->routeIs('inactive_customer_search') ? 'active' : '' }}
                            ">
                                <a href="{{ route('inactive-all-customer') }}">
                                    <i class="menu-icon fa fa-times"></i>
                                    Inactive Customer
                                </a>

                                <b class="arrow"></b>
                            </li>

                        </ul>
                    </li>

                @endif




                @if (Auth()->User()->type == 1)

                    <!-- customer for staff -->
                    <li class="
                                {{ request()->routeIs('active-all-customer-staff') ? 'open active' : '' }}
                                {{ request()->routeIs('inactive-all-customer-staff') ? 'open active' : '' }}
                                {{ request()->routeIs('customer-transaction-staff') ? 'open active' : '' }}
                                {{ request()->routeIs('inactive_customer_search') ? 'open active' : '' }}
                                {{ request()->routeIs('active_customer_search') ? 'open active' : '' }}

                            ">

                        <a class="dropdown-toggle" style="cursor: pointer">
                            <i class="menu-icon fa fa-users"></i>

                            Customers
                            <b class="arrow fa fa-angle-down"></b>
                        </a>

                        <b class="arrow"></b>

                        <ul class="submenu">
                            <li class="
                                    {{ request()->routeIs('active-all-customer-staff') ? 'active' : '' }}
                                    {{ request()->routeIs('active_customer_search') ? 'active' : '' }}
                                ">
                                <a href="{{ route('active-all-customer-staff',Auth()->user()->id) }}">
                                    <i class="menu-icon fa fa-check-square-o"></i>
                                    Active Customer
                                </a>

                                <b class="arrow"></b>
                            </li>
                            <li class="
                                    {{ request()->routeIs('inactive-all-customer-staff') ? 'active' : '' }}
                                    {{ request()->routeIs('inactive_customer_search') ? 'active' : '' }}
                                ">
                                <a href="{{ route('inactive-all-customer-staff',Auth()->user()->id) }}">
                                    <i class="menu-icon fa fa-times"></i>
                                    Inactive Customer
                                </a>

                                <b class="arrow"></b>
                            </li>

                        </ul>
                    </li>

                @endif



                @if (Auth()->User()->type == 0)

                    <!-- settings -->
                    <li
                        class="
                        {{ request()->routeIs('all-area') ? 'active' : '' }}
                        {{ request()->routeIs('create-area') ? 'active' : '' }}
                        {{ request()->routeIs('edit-area') ? 'active' : '' }}

                        {{ request()->routeIs('all-line-category') ? 'active' : '' }}
                        {{ request()->routeIs('create-line-category') ? 'active' : '' }}
                        {{ request()->routeIs('edit-line-category') ? 'active' : '' }}

                        {{ request()->routeIs('all-transaction-type') ? 'active' : '' }}
                        {{ request()->routeIs('create-transaction-type') ? 'active' : '' }}
                        {{ request()->routeIs('edit-transaction-type') ? 'active' : '' }}

                        {{ request()->routeIs('all-payment-option') ? 'active' : '' }}
                        {{ request()->routeIs('create-payment-option') ? 'active' : '' }}
                        {{ request()->routeIs('edit-payment-option') ? 'active' : '' }}

                        ">
                        <a href="#" class="dropdown-toggle">
                            <i class="fa fa-cogs"></i>
                            <span class="menu-text"> Settings </span>
                            <b class="arrow fa fa-angle-down"></b>
                        </a>
                        <b class="arrow"></b>

                        <ul class="submenu">
                            <!-- area setting -->
                            <li
                                class="{{ request()->routeIs('all-area') ? 'active' : '' }}
                                    {{ request()->routeIs('create-area') ? 'active' : '' }}
                                    {{ request()->routeIs('edit-area') ? 'active' : '' }}
                                ">
                                <a href="{{ route('all-area') }}">
                                    <i class="fa fa-map-marker"></i>
                                    <span class="menu-text">Area Settings </span>
                                </a>
                                <b class="arrow"></b>
                            </li>

                            <!-- line-category -->
                            <li
                                class="{{ request()->routeIs('all-line-category') ? 'active' : '' }}
                                    {{ request()->routeIs('create-line-category') ? 'active' : '' }}
                                    {{ request()->routeIs('edit-line-category') ? 'active' : '' }}
                                ">
                                <a href="{{ route('all-line-category') }}">
                                    <i class="fa fa-bars"></i>
                                    <span class="menu-text">Line Categories </span>
                                </a>
                                <b class="arrow"></b>
                            </li>


                            <!-- transaction-type -->
                            <li
                                class="{{ request()->routeIs('all-transaction-type') ? 'active' : '' }}
                                    {{ request()->routeIs('create-transaction-type') ? 'active' : '' }}
                                    {{ request()->routeIs('edit-transaction-type') ? 'active' : '' }}
                                ">
                                <a href="{{ route('all-transaction-type') }}">
                                    <i class="fa fa-exchange"></i>
                                    <span class="menu-text">Transaction Types </span>
                                </a>
                                <b class="arrow"></b>
                            </li>

                            <!-- payment-option -->
                            <li
                                class="{{ request()->routeIs('all-payment-option') ? 'active' : '' }}
                                    {{ request()->routeIs('create-payment-option') ? 'active' : '' }}
                                    {{ request()->routeIs('edit-payment-option') ? 'active' : '' }}
                                ">
                                <a href="{{ route('all-payment-option') }}">
                                    <i class="fa fa-credit-card"></i>
                                    <span class="menu-text">Payment Options </span>
                                </a>
                                <b class="arrow"></b>
                            </li>

                        </ul>
                    </li>

                @endif



            </ul>

        </li>




        @if (Auth()->User()->type == 0)

            <!-- Users -->
            <li
                class="
                {{ request()->routeIs('all-user') ? 'open active' : '' }}
                {{ request()->routeIs('create-user') ? 'open active' : '' }}
                {{ request()->routeIs('edit-user') ? 'open active' : '' }}

                {{ request()->routeIs('all_admin') ? 'open active' : '' }}

                {{ request()->routeIs('all-staff') ? 'open active' : '' }}
                {{ request()->routeIs('create-staff') ? 'open active' : '' }}
                {{ request()->routeIs('edit-staff') ? 'open active' : '' }}

                ">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-users"></i>
                    <span class="menu-text"> Users </span>
                    <b class="arrow fa fa-angle-down"></b>
                </a>
                <b class="arrow"></b>

                <ul class="submenu">

                    <!-- add new users -->
                    <li
                        class=" {{ request()->routeIs('create-user') ? 'active' : '' }} ">
                        <a href="{{ route('create-user') }}">
                            <i class="fa fa-user-plus"></i>
                            <span class="menu-text">Add New Users</span>
                        </a>
                        <b class="arrow"></b>
                    </li>



                    <!-- admin -->
                    <li
                        class="{{ request()->routeIs('all_admin') ? 'active' : '' }}
                        ">
                        <a href="{{ route('all_admin') }}">
                            <i class="fa fa-user-secret"></i>
                            <span class="menu-text">Admin</span>
                        </a>
                        <b class="arrow"></b>
                    </li>



                    <!-- staffs -->
                    <li
                        class="{{ request()->routeIs('all-staff') ? 'active' : '' }}
                            {{ request()->routeIs('edit-staff') ? 'active' : '' }}
                        ">
                        <a href="{{ route('all-staff') }}">
                            <i class="fa fa-user"></i>
                            <span class="menu-text">Staff</span>
                        </a>
                        <b class="arrow"></b>
                    </li>


                </ul>

            </li>

        @endif



        @if (Auth()->User()->type == 0)

            <!-- company-info -->
            <li class="
                    {{ request()->routeIs('all-company-info') ? 'active' : '' }}
                ">
                <a href="{{ route('all-company-info') }}">
                    <i class="menu-icon fa fa-info"></i>
                    <span class="menu-text">Company Info</span>
                </a>
                <b class="arrow"></b>
            </li>

        @endif


        <!-- category -->
        {{-- <li
            class="{{ request()->routeIs('all-category') ? 'active' : '' }}
                        {{ request()->routeIs('create-category') ? 'active' : '' }}
                        {{ request()->routeIs('edit-category') ? 'active' : '' }}
                    ">
            <a href="{{ route('all-category') }}">
                <i class="menu-icon fa fa-bars"></i>
                <span class="menu-text">Category</span>
            </a>
            <b class="arrow"></b>
        </li> --}}


        <!-- staff-area -->
        {{-- <li
            class="{{ request()->routeIs('all-staff-area') ? 'active' : '' }}
             {{ request()->routeIs('create-staff-area') ? 'active' : '' }}
             {{ request()->routeIs('edit-staff-area') ? 'active' : '' }}
         ">
            <a href="{{ route('all-staff-area') }}">
                <i class="menu-icon fa fa-area-chart"></i>
                <span class="menu-text">Staffs Assign Area</span>
            </a>
            <b class="arrow"></b>
        </li> --}}








        <!-- line_payment_transition_method -->
        {{-- <li
            class="{{ request()->routeIs('all-bill-payment-due') ? 'active' : '' }}
                    {{ request()->routeIs('create-bill-payment-due') ? 'active' : '' }}
                    {{ request()->routeIs('edit-bill-payment-due') ? 'active' : '' }}
                ">
            <a href="{{ route('all-bill-payment-due') }}">
                <i class="menu-icon fa fa-credit-card"></i>
                <span class="menu-text">Due Payment</span>
            </a>
            <b class="arrow"></b>
        </li> --}}








        <!-- account -->
        {{-- <li
            class="{{ request()->routeIs('all-account') ? 'active' : '' }}
                    {{ request()->routeIs('create-account') ? 'active' : '' }}
                    {{ request()->routeIs('edit-account') ? 'active' : '' }}
                ">
            <a href="{{ route('all-account') }}">
                <i class="menu-icon fa fa-bank"></i>
                <span class="menu-text">Account</span>
            </a>
            <b class="arrow"></b>
        </li> --}}







        <!-- address -->
        {{-- <li
            class="{{ request()->routeIs('all-address') ? 'active' : '' }}
                    {{ request()->routeIs('create-address') ? 'active' : '' }}
                    {{ request()->routeIs('edit-address') ? 'active' : '' }}
                ">
            <a href="{{ route('all-address') }}">
                <i class="menu-icon fa fa-map-marker"></i>
                <span class="menu-text">Address</span>
            </a>
            <b class="arrow"></b>
        </li> --}}







        <!-- client -->
        {{-- <li
            class="{{ request()->routeIs('all-client') ? 'active' : '' }}
                    {{ request()->routeIs('create-client') ? 'active' : '' }}
                    {{ request()->routeIs('edit-client') ? 'active' : '' }}
                ">
            <a href="{{ route('all-client') }}">
                <i class="menu-icon fa fa-user"></i>
                <span class="menu-text">Clients</span>
            </a>
            <b class="arrow"></b>
        </li> --}}






        <!-- project-item -->
        {{-- <li
            class="{{ request()->routeIs('all-project-item') ? 'active' : '' }}
                    {{ request()->routeIs('create-project-item') ? 'active' : '' }}
                    {{ request()->routeIs('edit-project-item') ? 'active' : '' }}
                ">
            <a href="{{ route('all-project-item') }}">
                <i class="menu-icon fa fa-folder"></i>
                <span class="menu-text">Project Item</span>
            </a>
            <b class="arrow"></b>
        </li> --}}







        <!-- user-type -->
        {{-- <li
            class="{{ request()->routeIs('all-user-type') ? 'active' : '' }}
                    {{ request()->routeIs('create-user-type') ? 'active' : '' }}
                    {{ request()->routeIs('edit-user-type') ? 'active' : '' }}
                ">
            <a href="{{ route('all-user-type') }}">
                <i class="menu-icon fa fa-user-plus"></i>
                <span class="menu-text">User Types</span>
            </a>
            <b class="arrow"></b>
        </li> --}}








        <!-- unit-measurement -->
        {{-- <li
            class="{{ request()->routeIs('all-unit-measurement') ? 'active' : '' }}
                    {{ request()->routeIs('create-unit-measurement') ? 'active' : '' }}
                    {{ request()->routeIs('edit-unit-measurement') ? 'active' : '' }}
                ">
            <a href="{{ route('all-unit-measurement') }}">
                <i class="menu-icon fa fa-balance-scale"></i>
                <span class="menu-text">Unit Measurement</span>
            </a>
            <b class="arrow"></b>
        </li> --}}









        <!-- product -->
        {{-- <li
            class="
            {{ request()->routeIs('all-product-brand') ? 'open active' : '' }}
            {{ request()->routeIs('create-product-brand') ? 'open active' : '' }}
            {{ request()->routeIs('edit-product-brand') ? 'open active' : '' }}

            {{ request()->routeIs('all-product-category') ? 'open active' : '' }}
            {{ request()->routeIs('create-product-category') ? 'open active' : '' }}
            {{ request()->routeIs('edit-product-category') ? 'open active' : '' }}



            ">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-product-hunt"></i>
                <span class="menu-text"> Product </span>
                <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>

            <ul class="submenu">
                <!-- product-brand -->
                <li
                    class="{{ request()->routeIs('all-product-brand') ? 'active' : '' }}
                    {{ request()->routeIs('create-product-brand') ? 'active' : '' }}
                    {{ request()->routeIs('edit-product-brand') ? 'active' : '' }}
                ">
                    <a href="{{ route('all-product-brand') }}">
                        <i class="menu-icon fa fa-product-hunt"></i>
                        <span class="menu-text">Product Brand</span>
                    </a>
                    <b class="arrow"></b>
                </li>

                <!-- product-category -->
                <li
                    class="{{ request()->routeIs('all-product-category') ? 'active' : '' }}
                    {{ request()->routeIs('create-product-category') ? 'active' : '' }}
                    {{ request()->routeIs('edit-product-category') ? 'active' : '' }}
                ">
                    <a href="{{ route('all-product-category') }}">
                        <i class="menu-icon fa fa-list-alt"></i>
                        <span class="menu-text">Product Category</span>
                    </a>
                    <b class="arrow"></b>
                </li>


            </ul>
        </li> --}}

        <!-- terms-condition -->
        {{-- <li
            class="{{ request()->routeIs('all-terms-condition') ? 'active' : '' }}
                        {{ request()->routeIs('create-terms-condition') ? 'active' : '' }}
                        {{ request()->routeIs('edit-terms-condition') ? 'active' : '' }}
                    ">
            <a href="{{ route('all-terms-condition') }}">
                <i class="menu-icon fa fa-file"></i>
                <span class="menu-text">Terms & Condition</span>
            </a>
            <b class="arrow"></b>
        </li> --}}







    </ul><!-- /.nav-list -->

    <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
        <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state"
            data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
    </div>

</div>
