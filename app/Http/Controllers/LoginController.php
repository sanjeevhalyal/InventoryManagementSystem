<?php
/**
 * Created by PhpStorm.
 * User: sanjeev halyal
 * Date: 27-03-2018
 * Time: 18:21
 */

namespace App\Http\Controllers;

use Socialite;
use Microsoft\Graph\Graph;
use Microsoft\Graph\Model;


class LoginController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['EX_TIME']) && ($_SESSION['EX_TIME'] - time() > 0)) {
            return redirect('/');
        }
        return Socialite::with('graph')->scopes(['profile','openid','email','offline_access','User.Read','Mail.Send'])
            ->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        try {
            $user = Socialite::with('graph')->user();

            echo $user->token;

            $token = $user->token;


            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            if (isset($_SESSION['EX_TIME']) && ($_SESSION['EX_TIME'] - time() > 0)) {
                return redirect('/');
            }

            $_SESSION['Access_Token'] = $token;
            $_SESSION['EX_TIME'] = time() + 1000;


            $graph = new Graph();

            $graph->setAccessToken($token);

            $me = $graph->createRequest("get", "/me")
                ->setReturnType(Model\User::class)
                ->execute();

            echo $me->getDisplayName() . '<br> eMAIL-  ';
            echo $me->getMail();

            $pos = strpos($me->getMail(), '@nuigalway.ie');

            if ($pos === false) {
                echo "LogIn using NUI galway ID";
            } else {
                $user = \DB::select('select count(*) as c from user WHERE EMAIL=?', [$me->getMail()]);

                if ($user[0]->c == 0) {
                    $parameters = ['Name' => $me->getDisplayName()];
                    return redirect('/EnterYourDetails')->with($parameters);
                } else {
                    return redirect('/');
                }
            }
            // $user->token;
        }
        catch (Exception $exception)
        {
            echo "<script>alert(\"I am an alert box!\");</script>";
        }

    }
}