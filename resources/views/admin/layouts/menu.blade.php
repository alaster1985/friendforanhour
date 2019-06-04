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
                            <li><a href="{{route('viewProfileUsers')}}" title="">All Profile Users</a></li>
                        </ul>
                    </div>
                </div>
                {{--<div class="single-menu">--}}
                    {{--<h2><a title=""><i class="fa fa-seedling"></i><span>Categories</span></a></h2>--}}
                    {{--<div class="sub-menu">--}}
                        {{--<ul>--}}
                            {{--<li><a href="--}}{{--{{route('viewCategories')}}--}}{{--" title="">All Categories</a></li>--}}
                        {{--</ul>--}}
                        {{--@if(\App\User::find(Auth::id())->role_id === 3)--}}
                        {{--@else--}}
                        {{--<ul>--}}
                            {{--<li><a href="--}}{{--{{route('createCategory')}}--}}{{--" title="">Create Category</a></li>--}}
                        {{--</ul>--}}
                        {{--@endif--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="single-menu">--}}
                    {{--<h2><a title=""><i class="fa fa-tags"></i><span>Lots</span></a></h2>--}}
                    {{--<div class="sub-menu">--}}
                        {{--<ul>--}}
                            {{--<li><a href="--}}{{--{{route('viewLots')}}--}}{{--" title="">All Lots</a></li>--}}
                        {{--</ul>--}}
                        {{--                        @if(\App\User::find(Auth::id())->role_id === 3)--}}
                        {{--@else--}}
                        {{--<ul>--}}
                            {{--<li><a href="--}}{{--{{route('createLot')}}--}}{{--" title="">Create Lot</a></li>--}}
                        {{--</ul>--}}
                        {{--@endif--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="single-menu">--}}
                    {{--<h2><a title=""><i class="fa fa-globe"></i><span>Languages</span></a></h2>--}}
                    {{--<div class="sub-menu">--}}
                        {{--<ul>--}}
                            {{--<li><a href="--}}{{--{{route('viewLanguages')}}--}}{{--" title="">All Languages</a></li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="single-menu">--}}
                {{--<h2><a title=""><i class="fa fa-shopping-basket"></i><span>Exclusive proposal</span></a></h2>--}}
                {{--<div class="sub-menu">--}}
                {{--<ul>--}}
                {{--<li><a href="{{route('viewExLots')}}" title="">All exclusive proposal</a></li>--}}
                {{--</ul>--}}
                {{--</div>--}}
                {{--</div>--}}
                {{--<div class="single-menu">--}}
                    {{--<h2><a title=""><i class="fa fa-globe-americas"></i><span>Socials</span></a></h2>--}}
                    {{--<div class="sub-menu">--}}
                        {{--<ul>--}}
                            {{--<li><a href="--}}{{--{{route('viewSocials')}}--}}{{--" title="">All socials</a></li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="single-menu">--}}
                    {{--<h2><a title=""><i class="fa fa-file-pdf"></i><span>Presentations</span></a></h2>--}}
                    {{--<div class="sub-menu">--}}
                        {{--<ul>--}}
                            {{--<li><a href="--}}{{--{{route('viewPresentations')}}--}}{{--" title="">All Presentations</a></li>--}}
                        {{--</ul>--}}
                        {{--@if(\App\User::find(Auth::id())->role_id === 3)--}}
                        {{--@else--}}
                            {{--<ul>--}}
                                {{--<li><a href="--}}{{--{{route('createPresentation')}}--}}{{--" title="">Add Presentation</a></li>--}}
                            {{--</ul>--}}
                        {{--@endif--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="single-menu">--}}
                    {{--<h2><a title=""><i class="fa fa-donate"></i><span>Charity</span></a></h2>--}}
                    {{--<div class="sub-menu">--}}
                        {{--<ul>--}}
                            {{--<li><a href="--}}{{--{{route('viewCharityPosts')}}--}}{{--" title="">All Charity Posts</a></li>--}}
                        {{--</ul>--}}
                        {{--@if(\App\User::find(Auth::id())->role_id === 3)--}}
                        {{--@else--}}
                        {{--<ul>--}}
                            {{--<li><a href="--}}{{--{{route('createCharityPost')}}--}}{{--" title="">Add Charity Post</a></li>--}}
                        {{--</ul>--}}
                        {{--@endif--}}
                    {{--</div>--}}
                {{--</div>--}}
            </div>
        </div>
    </aside>
