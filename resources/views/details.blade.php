<!DOCTYPE html>
<html lang="en">
<head>
    <title>Your Details</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/components/bootstrap.min.js"></script>
</head>
<body>

<?php
/*
echo 'Hi '.$Name . '<br/> please enter your details for approval';

echo Form::open(['url' => '/UpdateDB']) ;
//
echo Form::label('Contact', 'Contact Number: ');
echo Form::number('Contact');echo "<br/>";

echo Form::label('Society', 'Society');
echo Form::text('Society');echo "<br/>";

echo Form::label('Post', 'Your post in society');
echo Form::text('Post');echo "<br/>";

echo Form::submit('Click Me!');
echo Form::close() ;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
echo $_SESSION['EX_TIME']-time();

*/
?>

<div class="form-style-8">

    <h2><?php
echo 'Hi '.$Name . '<br/> Please Enter Your Details For Approval';?></h2>
    <form action='/UpdateDB' method="post">
        <input type="number" name="Contact" placeholder="Contact Number" />
        <input type="text" name="Society" placeholder="Society" />
        <input type="text" name="Post" placeholder="Post" />
        <input type="submit" value="Submit For Approval" />
        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
    </form>
</div>
</body>

<script type="text/javascript">
    //auto expand textarea
    function adjust_textarea(h) {
        h.style.height = "20px";
        h.style.height = (h.scrollHeight)+"px";
    }
</script>

    <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
                                                                                                                <style type="text/css">
                                                                                                                                      .form-style-8{
                                                                                                                                          font-family: 'Open Sans Condensed', arial, sans;
                                                                                                                                          width: 500px;
                                                                                                                                          padding: 30px;
                                                                                                                                          background: #FFFFFF;
                                                                                                                                          margin: 50px auto;
                                                                                                                                          box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.22);
                                                                                                                                          -moz-box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.22);
                                                                                                                                          -webkit-box-shadow:  0px 0px 15px rgba(0, 0, 0, 0.22);

                                                                                                                                      }
    .form-style-8 h2{
        background: #4D4D4D;
        text-transform: uppercase;
        font-family: 'Open Sans Condensed', sans-serif;
        color: #797979;
        font-size: 18px;
        font-weight: 100;
        padding: 20px;
        margin: -30px -30px 30px -30px;
    }
    .form-style-8 input[type="text"],
    .form-style-8 input[type="date"],
    .form-style-8 input[type="datetime"],
    .form-style-8 input[type="email"],
    .form-style-8 input[type="number"],
    .form-style-8 input[type="search"],
    .form-style-8 input[type="time"],
    .form-style-8 input[type="url"],
    .form-style-8 input[type="password"],
    .form-style-8 textarea,
    .form-style-8 select
    {
        box-sizing: border-box;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        outline: none;
        display: block;
        width: 100%;
        padding: 7px;
        border: none;
        border-bottom: 1px solid #ddd;
        background: transparent;
        margin-bottom: 10px;
        font: 16px Arial, Helvetica, sans-serif;
        height: 45px;
    }
    .form-style-8 textarea{
        resize:none;
        overflow: hidden;
    }
    .form-style-8 input[type="button"],
    .form-style-8 input[type="submit"]{
        -moz-box-shadow: inset 0px 1px 0px 0px #45D6D6;
        -webkit-box-shadow: inset 0px 1px 0px 0px #45D6D6;
        box-shadow: inset 0px 1px 0px 0px #45D6D6;
        background-color: #2CBBBB;
        border: 1px solid #27A0A0;
        display: inline-block;
        cursor: pointer;
        color: #FFFFFF;
        font-family: 'Open Sans Condensed', sans-serif;
        font-size: 14px;
        padding: 8px 18px;
        text-decoration: none;
        text-transform: uppercase;
    }
    .form-style-8 input[type="button"]:hover,
    .form-style-8 input[type="submit"]:hover {
        background:linear-gradient(to bottom, #34CACA 5%, #30C9C9 100%);
        background-color:#34CACA;
    }
</style>
</html>