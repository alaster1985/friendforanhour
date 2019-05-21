@include('layouts.header')
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>

                @include('auth.loginTest')
            @endif

            <div class="content">
                <div class="title m-b-md">
                    First page
                </div>

                <div class="links">
                    <a href="lara2">second page just for example link</a>
                </div>
                <div class="links">
                    <a href="profile">personal profile page</a>
                </div>
            </div>
        </div>
    </body>
@include('layouts.footer')