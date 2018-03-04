<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/components/bootstrap.min.js"></script>
</head>
<body>

<?php
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


?>
</body>
</html>