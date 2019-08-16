    </main>
    
    <div class="modal-error">
        <div class="modal-card">
            <h2>Авторизация:</h2>
            <div class="text-center margin-bottom-20" id="uLogin3"
                data-ulogin="display=panel;theme=classic;fields=first_name,last_name,email,nickname,photo,city,country,bdate,sex;
                                    providers=facebook,vkontakte,odnoklassniki;hidden=;
                                    redirect_uri={{ urlencode('http://' . $_SERVER['HTTP_HOST'])}}/ulogin;mobilebuttons=0;">
            </div>
            <span class="modal-error__close-btn fa fa-times"></span>
        </div>
    </div>
    @auth
        @if(Auth::user()->profile_id)
            <span id="chat-vue" style="display: none">
                <online v-bind:friend="{{ Auth::user()->profile }}"
                        v-bind:onlineusers="onlineUsers"></online>
            </span>
        @endif
    @endauth

    <footer>
        @if (Route::has('login'))
            <div class="container">
                <div class="footer-nav-container">
                    <nav class="navbar navbar-expand-lg navbar-dark">
                        <a class="col-lg-3 navbar-brand logotype" href="{{ route('index') }}">
                            <i class="fas fa-user-friends"></i>
                            <span class="header_title">One Hour Friend</span>
                        </a>                       
                        <div class="col-lg-9 collapse navbar-collapse links_header" id="navbarNavAltMarkup">
                            <div class="navbar-nav justify-content-between">
                                @foreach(ArticleCategory::all() as $category)
                                    <a class="nav-item nav-link" href="articles?ctg={{$category->category_name}}">{{$category->display_name}}</a>
                                @endforeach
                                    {{--<a class="nav-item nav-link" href="javascript:void(0);">Знакомства</a>--}}
                                    {{--<a class="nav-item nav-link" href="javascript:void(0);">Услуги</a>--}}
                                    {{--<a class="nav-item nav-link" href="javascript:void(0);">Заработать</a>--}}
                                    {{--<a class="nav-item nav-link" href="javascript:void(0);">Отдохнуть</a>--}}                                                       
                                    <a class="nav-item nav-link" href="{{Request::root()}}/search">Найти друга</a>
                                    <a class="nav-item nav-link" href="{{Request::root()}}/contactToSupport">Тех Поддержка</a>                         
                            </div>                        
                        </div>
                    </nav>
                    <div class="copyright">
                        <a href="http://1-hf.com/"><p>&copy 2019 «1-hf.com».</p></a>
                    </div>
                    @else
                </div>
                
            </div>
        @endif
    </footer>

    <script type="text/javascript" src="{{ asset('js/jquery-3.4.1.min.js')}}"></script>
    @guest
    <script type="text/javascript" src="http://ulogin.ru/js/ulogin.js"></script>
    @endguest
    <script type="text/javascript" src="{{asset('js/forInputData.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/forComplain.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/forLists.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/app.js')}}" defer></script>
    <script type="text/javascript" src="{{asset('js/slick.js')}}" defer></script>
    <script type="text/javascript" src="{{asset('js/hammer.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/search-user-slider.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.fancybox.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/main.script.js')}}"></script>

    </body>
</html>