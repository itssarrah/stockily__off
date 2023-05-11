<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!-- User details -->
    

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="../../manager/admin/index" class="waves-effect">
                        <i class="ri-dashboard-line"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
    
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-mail-send-line"></i>
                        <span>Manage supplier</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('supplier.all')}}">All supplier</a></li>
                    </ul>
                </li>

                 <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-mail-send-line"></i>
                        <span>Manage Locations</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('unit.all')}}">All Locations</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-mail-send-line"></i>
                        <span>Manage Categories</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('category.all')}}">All Categories</a></li>
                    </ul>
                </li>

                
                 <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-mail-send-line"></i>
                        <span>Manage Product</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('product.all')}}">All Products</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-mail-send-line"></i>
                        <span>Manage Purchase</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('purchase.all')}}">All Purchase</a></li>
                        <li><a href="{{route('purchase.pending')}}">Approved Purchase</a></li>
                        <li><a href="{{route('daily.purchase.report')}}">Daily Purchase Report</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-mail-send-line"></i>
                        <span>Manage Invoice</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('invoice.all')}}">All Invoice</a></li>
                        <li><a href="{{route('invoice.pending.list')}}">Approved Invoice</a></li>
                        <li><a href="{{route('print.invoice.list')}}">Print Invoice List</a></li>
                        <li><a href="{{route('daily.invoice.report')}}">Daily Invoice Reportt</a></li>
                    </ul>
                </li>

               

               
                    

               

                
             

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>