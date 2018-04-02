<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>NUI Socs</title>

</head>
<body>
  @include('Header.header')

  @if(app('App\Traits\CheckExpiry')->checkexpiry())

      <?php
      $me=app('App\Traits\GetMe')->getme();
      $path=app_path().'\Python\Mail.py';
      ?>

  @yield('content')

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

      echo '<div style="height:100%"></div>';
      ?>
      @include('loginoption')


  @endif
  @include('Footer.footer')

  @yield('script')

</body>
</html>
