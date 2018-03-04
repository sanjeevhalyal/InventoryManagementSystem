<html>
<body>

<?php
if (session_status() == PHP_SESSION_NONE) {
    echo $State;
}
?>

<br/>You will logout from microsoft in few moments.
<script>
    window.setTimeout(function(){

        // Move to a new location or you can do something else
        window.location.href = "{{url('/oauth')}}";

    }, 2000);
</script>

</body>
</html>