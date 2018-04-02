<?php
/**
 * Created by PhpStorm.
 * User: sanjeev halyal
 * Date: 25-03-2018
 * Time: 10:51
 */

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Microsoft\Graph\Graph;
use Microsoft\Graph\Model;

class MicrosoftAuthController extends Controller
{


    public function __invoke(Request $request) {
        $provider = new \League\OAuth2\Client\Provider\GenericProvider([
            'clientId' => 'ead9d9e3-f1d2-4b47-be43-b044994f496a',
            'clientSecret' => 'on46*ssvciBCCVEJA113?$$',
            'redirectUri' => 'http://localhost:80/oauth',
            'urlAuthorize' => 'https://login.microsoftonline.com/common/oauth2/v2.0/authorize',
            'urlAccessToken' => 'https://login.microsoftonline.com/common/oauth2/v2.0/token',
            'urlResourceOwnerDetails' => '',
            'scopes' => 'profile openid email offline_access User.Read Mail.Send'
        ]);

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['EX_TIME']) && ($_SESSION['EX_TIME'] - time() > 0)) {
            return redirect('/');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'GET' && !isset($_GET['code'])) {
            $authorizationUrl = $provider->getAuthorizationUrl();
            // The OAuth library automaticaly generates a state value that we can
            // validate later. We just save it for now.
            $_SESSION['state'] = $provider->getState();
            header('Location: ' . $authorizationUrl);
            exit();
        }
        elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['code'])) {
            // Validate the OAuth state parameter
            if (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['state'])) {
                unset($_SESSION['state']);
                exit('State value does not match the one initially sent');
            }
            // With the authorization code, we can retrieve access tokens and other data.
            try {
                // Get an access token using the authorization code grant
                $accessToken = $provider->getAccessToken('authorization_code', [
                    'code' => $_GET['code']
                ]);
                $_SESSION['Cart']="000000";
                $_SESSION['Access_Token'] = $accessToken->getToken();
                $_SESSION['EX_TIME'] = $accessToken->getExpires() - 3500;

                /*// The id token is a JWT token that contains information about the user
                // It's a base64 coded string that has a header, payload and signature
                $idToken = $accessToken->getValues()['id_token'];
                $_SESSION["Id_Token"]=$accessToken->getValues()['id_token'];

                $decodedAccessTokenPayload = base64_decode(
                    explode('.', $idToken)[1]
                );
                $jsonAccessTokenPayload = json_decode($decodedAccessTokenPayload, true);
                // The following user properties are needed in the next page
                $_SESSION['preferred_username'] = $jsonAccessTokenPayload['preferred_username'];
                $_SESSION['given_name'] = $jsonAccessTokenPayload['name'];
                //header('Location: http://localhost:8000/');*/

                $graph = new Graph();

                $graph->setAccessToken($accessToken->getToken());

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
            } catch (League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
                echo 'Something went wrong, couldn\'t get tokens: ' . $e->getMessage();
            }
        }


    }
}