<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <div class="title" >
    Welcome

    </div>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">



    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
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

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>



@if(app('App\Traits\CheckExpiry')->checkexpiry())

<?php
$me=app('App\Traits\GetMe')->getme();
$path=app_path().'\Python\Mail.py';
?>


<!--Import jQuery before materialize.js-->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>

<div class="flex-center position-ref full-height">

                <a href="{{ url('/') }}">  Home(
                    <?php

                    ?>
                    {{  $me->getmail()}}
                     ) </a>

        </div>

    <div class="content">

        <a href="{{url('/logout')}}">Log out</a>


        <div class="title m-b-md">
            Laravel
            {{ $me->usertype}}
        </div>


    </div>

</div>

@else
    <?php


    $parameters = ['state' => "Your Session Has Logged out,   Please Login Again"];
    if (session_status() == PHP_SESSION_NONE) {
    session_start();
    }
    $_SESSION['EX_TIME'] = (isset($_SESSION['EX_TIME']) ? $_SESSION['EX_TIME'] : null);
    if(!($_SESSION['EX_TIME']-time()>0))
    {
    session_unset();
    session_destroy();
    }

    ?>
    @include('loginoption');
@endif

</body>
</html>
