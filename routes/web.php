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
use Microsoft\Graph\Graph;
use Microsoft\Graph\Model;
use PHPMailer\PHPMailer;

use Illuminate\Support\Facades\DB as DB;

Route::get('/', function () { return view('welcome'); });

Route::get('/login', function () { return view('login', ['State' => session('state')]); });


Route::post('/UpdateDB', 'UpdadteDBController')->name('Enter Your Details');


Route::get('/EnterYourDetails', function () {

    if (!app('App\Traits\CheckExpiry')->checkexpiry()) { return redirect('/'); }

    $Name = session('Name');

    return view('details', ['Name' => $Name]);


});

Route::get('/testhome',function(){return  view('User Homepage/index');  //File::get(public_path() . '/User Homepage/index.html');
});

Route::get('/logout', function () { return view('logout'); });

//Route::get('/oauth', 'MicrosoftAuthController')->name('login');

Route::get('/oauth', 'LoginController@redirectToProvider');
Route::get('/oauth/callback', 'LoginController@handleProviderCallback');




Route::get('/getCat','GetCatController');

Route::get('/getProd','GetProductController');


Route::get('/getava','GetAvailabilityController');


Route::post('/addtocart','AddToCartController');



Route::post('/deletefromcart',function (Request $request) {


    DB::table('cart')->where('ID', '=', $request->input("CartID"))->delete();
});


Route::post('/checkout',function(Request $request){

    $me=app('App\Traits\GetMe')->getme();
    $Cart = \DB::select('select * from cart WHERE user=?', [$me->userid]);

    foreach ($Cart as $c) {

        DB::table('transaction')->insert([
            ['USER_ID' => $c->user, 'BARCODE_ID' => $c->barcode, 'START_DATE' => $c->START_DATE, 'END_DATE' => $c->END_DATE, 'STATUS' => 'Pending', 'REASON' => $request->input('Reason')]
        ]);

        DB::table('cart')->where('ID', '=', $c->ID)->delete();
        DB::commit();

    }
    echo 1;
});

Route::get('/YourCart','CartController');

Route::get('/testCart',function(){

    $cartvalue=array();

    $Cart = \DB::select('select * from cart');



    foreach ($Cart as $c)
    {
        $begin = new DateTime( $c->START_DATE);
        $end = new DateTime( $c->END_DATE);
        $end = $end->modify( '+1 day' );

        $interval = new DateInterval('P1D');
        $daterange = new DatePeriod($begin, $interval ,$end);

        foreach($daterange as $date)
        {
            array_push($cartvalue, array($c->barcode,$c->user,$date->format('Y-M-d')));
        }
    }
    print_r($cartvalue);
    function custom_sort($a, $b)
    {
        // sort by last name
        $retval = strnatcmp($a[0], $b[0]);
        // if last names are identical, sort by first name
        if(!$retval) $retval = strnatcmp($a[2], $b[2]);
        return $retval;
    }

    // sort alphabetically by firstname and lastname
    usort($cartvalue, __NAMESPACE__ . '\custom_sort');

    print_r($cartvalue);
});



Route::resource('products','ProductsController');

Route::get('/mail',function(){

    $data = array('name'=>"Our Code World");
    // Path or name to the blade template to be rendered
    $template_path = 'mail';

    Mail::send(['text'=> $template_path->with('students',"sanjeev")], $data, function($message) {
        // Set the receiver and subject of the mail.
        $message->to('m.panda1@nuigalway.ie', 'Receiver Name')->subject('Laravel First Mail');
        // Set the sender
        $message->from('NUIGSOCSInventory@nuigalway.ie','Our Code World');
    });

    return "Basic email sent, check your inbox.";

});



