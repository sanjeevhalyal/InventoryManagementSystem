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

use Illuminate\Support\Facades\DB as DB;

Route::get('/', function () { return view('welcome'); });

Route::get('/login', function () { return view('login', ['State' => session('state')]); });


Route::post('/UpdateDB', 'UpdadteDBController')->name('Enter Your Details');


Route::get('/EnterYourDetails', function () {

    if (!app('App\Traits\CheckExpiry')->checkexpiry()) { return redirect('/'); }

    $Name = session('Name');

    return view('details', ['Name' => $Name]);


});

Route::get('/logout', function () { return view('logout'); });

Route::get('/oauth', 'MicrosoftAuthController')->name('login');

Route::resource('products','ProductsController');