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

    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

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

<!--Import jQuery before materialize.js-->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>

<div class="flex-center position-ref full-height">

                <a href="{{ url('/') }}">  Home(
                       <?php
                    use Microsoft\Graph\Graph;
                    use Microsoft\Graph\Model;
                    $graph = new Graph();

                    $graph->setAccessToken($_SESSION['Access_Token']);

                    $me = $graph->createRequest("get", "/me")

                        ->setReturnType(Model\User::class)

                        ->execute();
                    echo $me->getMail();
                    ?> ) </a>


            <a href="{{ url('/logout')}}" >  Log out  </a>
        </div>

    <div class="content">


        <?php
        echo 'Test';
        if(empty($_SESSION['Access_Token'])) {
            echo 'Not set!';
        }
        else
        {
            echo $_SESSION['EX_TIME']-time();
            echo "</br>";
        }
        ?>

        <a href="{{url('/logout')}}">Log out</a>

        <div class="title m-b-md">
            Laravel
        </div>
        <div class="links">
            <a href="https://laravel.com/docs">Documentation</a>
            <a href="https://laracasts.com">Laracasts</a>
            <a href="https://laravel-news.com">News</a>
            <a href="https://forge.laravel.com">Forge</a>
            <a href="https://github.com/laravel/laravel">GitHub</a>
        </div>
    </div>
</div>
</body>
</html>
