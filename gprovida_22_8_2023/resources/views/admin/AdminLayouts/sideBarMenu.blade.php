<div id="page-container">
    <nav id="page-leftbar" role="navigation">
        <ul class="acc-menu" id="sidebar">
            <li id="search">
                <a href="javascript:;"><i class="fa fa-search opacity-control"></i></a>
                    <form>
                    <input type="text" class="search-query" placeholder="Search...">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </form>
            </li>
            <li class="divider"></li>
            <li>
                <a href="{{ url('admin/dashboard')     }}">
                    <i class="fa fa-home"></i>     <span>Dashboard</span>
                </a>
            </li>

            <li><a href="javascript:;"><i class="fa fa-th"></i> <span>Site Setting</span> </a>
                <ul class="acc-menu">
                    <li><a href="{{ url('admin/setting') }}"><span>general Settings</span></a></li>
                    <li><a href="{{ url('admin/currency') }}">Currency Management</a></li>
                    <li><a href="{{ url('admin/country') }}"><span>Countries</span></a></li>

                    <li><a href="javascript:;"><i class="fa fa-trophy"></i> <span>Award</span> </a>
                    <ul class="acc-menu">
                        <li><a href="{{ url('admin/award') }}"><span>All Awards</span></a></li>
                        <li><a href="{{ url('admin/award/create') }}">Add Award</a></li>
                    </ul>
                    </li>

                </ul>
            </li>

            <li><a href="{{ url('admin/members') }}"><i class="fa fa-users"></i><span>Members</span> </a> </li>


            <li><a href="javascript:;"><i class="fa fa-th"></i> <span>Transaction</span> </a>
                <ul class="acc-menu">
                    <li><a href="{{ url('admin/transaction') }}"><span>All Transaction</span></a></li>
                    <li><a href="{{ url('admin/transaction?status=pending') }}"><span>Pending</span></a></li>
                    <li><a href="{{ url('admin/transaction?status=processing') }}"><span>Processing</span></a></li>
                    <li><a href="{{ url('admin/transaction?status=shipped') }}"><span>Shipped</span></a></li>
                    <li><a href="{{ url('admin/transaction?status=cancelled') }}"><span>Cancelled</span></a></li>
                </ul>
            </li>

            <li><a href="{{ url('admin/package') }}"><i class="fa fa-users"></i><span>Package</span> </a> </li>


            <li><a href="javascript:;"><i class="fa fa-cubes"></i> <span>Product</span> </a>
                <ul class="acc-menu">
                    <li><a href="{{ url('admin/product') }}">All Product</a></li>
                    <li><a href="{{ url('admin/product/create') }}">Add New</a></li>
                    <li><a href="{{ url('admin/category') }}"><span>Categories</span></a></li>
                    <li><a href="{{ url('admin/tag') }}"><span>Tags</span></a></li>
                    <li><a href="{{ url('admin/reviews') }}"><span>Reviews</span></a></li>
                </ul>
            </li>

            <li><a href="javascript:;"><i class="fa fa-th"></i> <span>Inventory</span> </a>
                <ul class="acc-menu">
                    <li><a href="{{ url('admin/store') }}"><span>Store</span></a></li>
                    <li><a href="{{ url('admin/inventory/purchase') }}">Purchase</a></li>
                    <li><a href="{{ url('admin/inventory/supplier') }}">Supplier</a></li>
                    <li><a href="{{ url('admin/inventory/transfer') }}">Product Transfer</a></li>
                </ul>
            </li>

            <li><a href="javascript:;"><i class="fa fa-th"></i> <span>Pin Management</span> </a>
                <ul class="acc-menu">
                    <li><a href="{{ url('admin/pin') }}">All Pin</a>
                        <ul class="acc-menu" style="display:block;">
                            <li><a href="{{ url('admin/pin?status=pending') }}">Pending Pin</a></li>
                            <li><a href="{{ url('admin/pin?status=used') }}">Used Pin</a></li>
                            <li><a href="{{ url('admin/pin?status=assigned') }}">Assigned Pin</a></li>
                            <li><a href="{{ url('admin/pin?status=cancelled') }}">Cancelled Pin</a></li>
                        </ul>
                    </li>

                    <li><a href="{{ url('admin/pin/create') }}">Add New Pin</a></li>
                </ul>
            </li>

            <li><a href="javascript:;"><i class="fa fa-th"></i> <span>Pin Request</span> </a>
                <ul class="acc-menu">
                    <li><a href="{{ url('admin/pinrequest?status=pending') }}">Pending Request</a></li>
                    <li><a href="{{ url('admin/pinrequest?status=approved') }}">Approved Request</a></li>
                    <li><a href="{{ url('admin/pinrequest?status=cancelled') }}">Cancelled Request</a></li>
                    <li><a href="{{ url('admin/pinrequest') }}">All Request</a></li>
                </ul>
            </li>



            <li><a href="{{ url('admin/banks')   }}"><i class="fa fa-bank"></i>  <span>Banks</span></a> </li>
            <li><a href="{{ url('admin/bitcoin') }}"><i class="fa fa-btc"></i>  <span>Bitcoin</span></a> </li>
            <li><a href="{{ url('admin/complaint')}}"><i class="fa fa-calendar"></i> <span>complaints</span></a></li>
            <li><a href="{{ url('admin/testimonial')}}"><i class="fa fa-calendar"></i> <span>testimonial</span></a></li>
            <li><a href="{{ url('admin/notification')}}"><i class="fa fa-calendar"></i> <span>notification</span></a></li>


            <li><a href="javascript:;"><i class="fa fa-cubes"></i> <span>Estimated Bonus</span> </a>
                <ul class="acc-menu">
                    <li><a href="{{ url('admin/bonus/referral') }}">Referral</a></li>
                    <li><a href="{{ url('admin/bonus/binary') }}">Binary</a></li>
                    <li><a href="{{ url('admin/bonus/directrepurchase') }}">Direct Purchase</a></li>
                </ul>
            </li>

            <li><a href="javascript:;"><i class="fa fa-cubes"></i> <span>Payment</span> </a>
                <ul class="acc-menu">
                    <li><a href="{{ url('admin/payment/referral') }}">Referral</a></li>
                    <li><a href="{{ url('admin/payment/binary') }}">Binary</a></li>
                    <li><a href="{{ url('admin/payment/award') }}">Award</a></li>
                    <li><a href="{{ url('admin/payment/loyalty') }}">Loyality</a></li>
                    <li><a href="{{ url('admin/payment/directrepurchase') }}">Repurchase</a></li>
                    <li><a href="{{ url('admin/payment/global') }}">Global Sales/Registraion</a></li>
                    <li><a href="{{ url('admin/payment/stockist') }}">Skockist</a></li>
                    <li><a href="{{ url('admin/payment/referral_stockist') }}">Stockist Referral</a></li>
                    <li><a href="{{ url('admin/payment/special') }}">Special Bonus</a></li>
                </ul>
            </li>
            
              <li><a href="{{ url('admin/payment/paid')}}"><i class="fa fa-sack-dollar"></i> <span>Paid Earnins</span></a></li>




            <li><a href="{{ url('/logout')}}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();" >
                                        <i class="fa fa-calendar"></i> <span>Logout</span></a></li>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                    </form>


        </ul>
    </nav>
