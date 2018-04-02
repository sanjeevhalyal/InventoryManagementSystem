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
                ->execute();
            $user = \DB::select('select TYPE,ID  from user WHERE EMAIL=?', [$me->getMail()]);

            $me->usertype="Not a User";
            $me->usertype=$user[0]->TYPE;
            $me->userid=-1;
            $me->userid=$user[0]->ID;

            return $me;
        }

    }
}
?>