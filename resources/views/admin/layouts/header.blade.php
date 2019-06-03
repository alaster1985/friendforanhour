<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>

    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,500,700,900' rel='stylesheet' type='text/css'/>
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'/>

    <link rel="stylesheet" href="{{asset('font-awesome-4.2.0/css/font-awesome.css')}}" type="text/css"/>
    <link rel="stylesheet" href="{{asset('css/fontawesome-free-5.6.3-web/css/all.css')}}" type="text/css"/>
    <link rel="stylesheet" type="text/css" media="all" href="{{asset('css/daterangepicker-bs3.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" type="text/css"/>
    {{--<link rel="stylesheet" href="{{asset('css/jquery-jvectormap.css')}}" type="text/css"/>--}}
    {{--<link rel="stylesheet" href="{{asset('css/owl.carousel.css')}}" type="text/css"/>--}}
    <link rel="stylesheet" href="{{asset('css/styledash.css')}}" type="text/css"/>
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}" type="text/css"/>

</head>
<body>

<div class="main">
    <header class="header">
        <div class="logo">
            <a href="{{ route('dashboard') }}" title=""  style="margin-right: 20px"><i class="fa fa-home"></i></a>
            <a href="{{ route('index') }}" title=""><i class="fa fa-map"></i></a>
            <a title="" class="toggle-menu"><i class="fa fa-bars"></i></a>
        </div>
        <div class="dropdown profile">
            <a title="">
                <img src="" alt=""/>{{\App\User::find(Auth::id())->name}}<i class="caret"></i>
            </a>
            <div class="profile drop-list">
                <ul>
                    <li><a href="{{ route('logout') }}" title=""><i class="fa fa-times-circle"></i>LOGout</a></li>
                    {{--<li><a href={{ route('changePassword') }} title=""><i class="fa fa-edit"></i>Change password</a></li>--}}
                </ul>
            </div>
        </div>
    </header>