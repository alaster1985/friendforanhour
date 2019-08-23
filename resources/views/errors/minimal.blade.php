<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{asset('font-awesome-4.2.0/css/font-awesome.css')}}"/>
        <link rel="stylesheet" type="text/css" href="{{asset('css/fontawesome-free-5.6.3-web/css/all.css')}}"/>

        <!-- Libs -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.fancybox.min.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}"/>

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .code {
                font-size: 4rem;
                font-weight: 400;
                padding: 0 15px
            }

            .message {
                text-align: center;
                font-size: 4rem;
                font-weight: 400;
                text-transform: uppercase;
                padding: 0 15px;
                color: rgba(68, 68, 68, 0.39)
            }

            @media all and (max-width: 991px) {

                .code {
                    font-size: 3rem
                }

                .message {
                    font-size: 3rem
                } 
            }

            @media all and (max-width: 576px) {

                .code {
                    font-size: 2rem
                }

                .message {
                    font-size: 2rem
                } 
            }

            @media all and (max-width: 320px) {

                .code {
                    font-size: 1.75rem
                }

                .message {
                    font-size: 1.75rem
                } 
            }
            
        </style>
    </head>
    <body style="display:flex;flex-direction:column-reverse;justify-content:center;color:rgba(68, 68, 68, 0.39);">
        
        <div class="flex-center position-ref">
            <div class="code">
                @yield('code')
            </div>
            <div class="message" style="">
                @yield('message')
            </div>
        </div>
    </body>
</html>
