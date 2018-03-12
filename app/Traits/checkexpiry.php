<?php namespace App\Traits;

class CheckExpiry
{

    function checkexpiry()
    {


        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['EX_TIME']) && ($_SESSION['EX_TIME'] - time() > 0)) {
            return true;
        } else {
            session_unset();
            session_destroy();

            return false;
        }

    }
}
?>