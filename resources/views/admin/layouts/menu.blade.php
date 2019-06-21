<div class="page-container menu-left">
    <aside class="sidebar">
        <div class="menu-sec">
            <div id="menu-toogle" class="menus">
                <div class="single-menu">
                    <h2><a title=""><i class="fa fa-user"></i><span>Admin Users</span></a></h2>
                    <div class="sub-menu">
                        <ul>
                            <li><a href="{{route('viewAdminUsers')}}" title="">All Admin Users</a></li>
                            <li><a href="{{route('createAdminUser')}}" title="">Create Admin User</a></li>
                        </ul>
                    </div>
                </div>
                <div class="single-menu">
                    <h2><a title=""><i class="fa fa-shopping-cart"></i><span>Profile Users</span></a></h2>
                    <div class="sub-menu">
                        <ul>
                            <li><a href="{{route('viewProfileUsers',['param' => 'all'])}}" title="">All subscription list</a></li>
                            <li><a href="{{route('viewProfileUsers',['param' => 'current'])}}" title="">All current Profile Users</a></li>
                            <li><a href="{{route('viewProfileUsers',['param' => 'expired'])}}" title="">All expired Profile Users</a></li>
                            {{--<li><a href="{{route('viewProfileUsers',['param' => 'demo'])}}" title="">All demo Profile Users</a></li>--}}
                        </ul>
                    </div>
                </div>
                <div class="single-menu">
                    <h2><a title=""><i class="fa fa-seedling"></i><span>Tickets</span></a></h2>
                    <div class="sub-menu">
                        <ul>
                            <li><a href="{{route('viewTickets')}}" title="">All Tickets</a></li>
                        </ul>
                    </div>
                </div>
                <div class="single-menu">
                    <h2><a title=""><i class="fa fa-shopping-cart"></i><span>Ban list</span></a></h2>
                    <div class="sub-menu">
                        <ul>
                            <li><a href="{{route('viewBanList',['param' => 'all'])}}" title="">All ban list</a></li>
                            <li><a href="{{route('viewBanList',['param' => 'current'])}}" title="">All current ban list</a></li>
                            <li><a href="{{route('viewBanList',['param' => 'expired'])}}" title="">All expired ban list</a></li>
                        </ul>
                    </div>
                </div>
                <div class="single-menu">
                    <h2><a title=""><i class="fa fa-shopping-cart"></i><span>Subscription list</span></a></h2>
                    <div class="sub-menu">
                        <ul>
                            <li><a href="{{route('viewSubscriptionList')}}" title="">All subscription list</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </aside>
