<?php namespace App\Traits;
use Microsoft\Graph\Graph;
use Microsoft\Graph\Model;
class GetMe
{

    function getme()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if(isset($_SESSION['Access_Token'])) {
            $graph = new Graph();

            $graph->setAccessToken($_SESSION['Access_Token']);
            $me = $graph->createRequest("get", "/me")
                ->setReturnType(Model\User::class)
                ->execute()->getmail();

        }

        return $me;
    }
}
?>