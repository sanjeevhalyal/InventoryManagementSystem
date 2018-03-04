<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Microsoft\Graph\Graph;
use Microsoft\Graph\Model;

use Illuminate\Support\Facades\DB as DB;

Route::get('/', function () {
    return view('welcome');
})->middleware('expiry');

Route::get('/login', function ()
{
    //echo session('state');
    return view('login',['State' => session('state')]);

});


Route::post('/UpdateDB',function(Request $request)
{
    $email = $request->input('email');
    $password = $request->input('password');
    echo "Email: " . $email . " and Password: " . $password ;



    $graph = new Graph();

    $graph->setAccessToken($_SESSION['Access_Token']);

    $me = $graph->createRequest("get", "/me")

        ->setReturnType(Model\User::class)

        ->execute();

    echo $me->getDisplayName() . '<br> eMAIL-  ';
    echo $me->getMail();

    DB::insert('INSERT INTO user
(
NAME,
EMAIL,
CONTACT,
TYPE,
STATUS,
SOCIETY,
POST)
VALUES
(\''.$me->getDisplayName()
        .'\',\''. $me->getMail()
        .'\','. $request->input('Contact')
        .','. '"User",'. '"UnderReview",\''
        . $request->input('Society')
        .'\',\''. $request->input('Post')
        .'\');'
    );
    DB::commit();
    return redirect('/');
})->middleware('expiry');

Route::get('/EnterYourDetails', function () {

    $Email=session('Email');
    $Name = session('Name');


    return view('details',['Email' => $Email,'Name' => $Name]);

})->middleware('expiry');


Route::get('/logout', function () {

    return view('logout');
});

Route::get('/oauth', function (Request $request) {
    $provider = new \League\OAuth2\Client\Provider\GenericProvider([
        'clientId' => 'ead9d9e3-f1d2-4b47-be43-b044994f496a',
        'clientSecret' => 'on46*ssvciBCCVEJA113?$$',
        'redirectUri' => 'http://localhost:8000/oauth',
        'urlAuthorize' => 'https://login.microsoftonline.com/common/oauth2/v2.0/authorize',
        'urlAccessToken' => 'https://login.microsoftonline.com/common/oauth2/v2.0/token',
        'urlResourceOwnerDetails' => '',
        'scopes' => 'profile openid email offline_access User.Read Mail.Send'
    ]);

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if(isset($_SESSION['EX_TIME']) && ($_SESSION['EX_TIME']-time()>0))
    {
        return redirect('/');
    }
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && !isset($_GET['code'])) {
        $authorizationUrl = $provider->getAuthorizationUrl();
        // The OAuth library automaticaly generates a state value that we can
        // validate later. We just save it for now.
        $_SESSION['state'] = $provider->getState();
        header('Location: ' . $authorizationUrl);
        exit();
    } elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['code'])) {
        // Validate the OAuth state parameter
        if (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['state'])) {
            unset($_SESSION['state']);
            exit('State value does not match the one initially sent');
        }
        // With the authorization code, we can retrieve access tokens and other data.
        try {
            // Get an access token using the authorization code grant
            $accessToken = $provider->getAccessToken('authorization_code', [
                'code'     => $_GET['code']
            ]);
            $_SESSION['Access_Token'] = $accessToken->getToken();
            $_SESSION['EX_TIME']=$accessToken->getExpires()-3500;

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

// Note our use of ===.  Simply == would not work as expected
// because the position of 'a' was the 0th (first) character.
            if ($pos === false) {
                echo "LogIn using NUI galway ID";
            } else {

                $user = \DB::select('select count(*) as c from user WHERE EMAIL=?',[$me->getMail()]);
                if ($user[0]->c == 0) {
                    $parameters = ['Email' => $me->getMail(), 'Name' => $me->getDisplayName()];
                    return redirect('/EnterYourDetails')->with($parameters);
                } else {
                    return redirect('/');
                }
            }
        } catch (League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
            echo 'Something went wrong, couldn\'t get tokens: ' . $e->getMessage();
        }
    }
echo "test";



})->name('login');