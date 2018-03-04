<html>
<body>
You will logout from microsoft in few moments.
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
    session_unset();
    session_destroy();
}
?>

<script>
    window.setTimeout(function(){

        // Move to a new location or you can do something else
        window.location.href = "https://login.windows.net/common/oauth2/logout";

    }, 2000);
</script>

</body>
</html>