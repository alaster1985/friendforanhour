<div class="page-container menu-left">
    <aside class="sidebar">
        <div class="menu-sec">
            <div id="menu-toogle" class="menus">
                <div class="single-menu">
                    <h2><a title=""><i class="fa fa-user"></i><span>Admin Users</span></a></h2>
                    <div class="sub-menu">
                        <ul>
                            <li><a href="{{route('viewAdminUsers')}}" title="">All Admin Users</a></li>
                            @if(Auth::user()->hasRole('admin'))
                                <li><a href="{{route('createAdminUser')}}" title="">Create Admin User</a></li>
                            @endif
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
                <div class="single-menu">
                    <h2><a title=""><i class="fa fa-shopping-cart"></i><span>Articles</span></a></h2>
                    <div class="sub-menu">
                        <ul>
                            <li><a href="{{route('viewArticles',['ctg' => 'all'])}}" title="">View all articles</a></li>
                            <li><a href="{{route('viewArticles',['ctg' => 'dating'])}}" title="">View all dating articles</a></li>
                            <li><a href="{{route('viewArticles',['ctg' => 'services'])}}" title="">View all services articles</a></li>
                            <li><a href="{{route('viewArticles',['ctg' => 'earn'])}}" title="">View all earn articles</a></li>
                            <li><a href="{{route('viewArticles',['ctg' => 'relax'])}}" title="">View all relax articles</a></li>
                            <li><a href="{{route('createArticles')}}" title="">Create new Article</a></li>
                        </ul>
                    </div>
                </div>
                <div class="single-menu">
                    <h2><a title=""><i class="fa fa-user"></i><span>News</span></a></h2>
                    <div class="sub-menu">
                        <ul>
                            <li><a href="{{route('viewNews')}}" title="">All news</a></li>
                            <li><a href="{{route('createNews')}}" title="">Create News</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </aside>
