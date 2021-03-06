<?php
/**
 * Created by PhpStorm.
 * User: sanjeev halyal
 * Date: 25-03-2018
 * Time: 10:59
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Microsoft\Graph\Model;

class UpdadteDBController  extends Controller
{


    public function __invoke(Request $request) {
        if (!app('App\Traits\CheckExpiry')->checkexpiry()) {
            return redirect('/');
        }


        $graph = new Graph();

        $graph->setAccessToken($_SESSION['Access_Token']);

        $me = $graph->createRequest("get", "/me")
            ->setReturnType(Model\User::class)
            ->execute();

        echo $me->getDisplayName() . '<br> eMAIL-  ';
        echo $me->getMail();

        DB::insert(
            'INSERT INTO user
( NAME,EMAIL, CONTACT,TYPE,STATUS,SOCIETY,POST)
VALUES
(\'' . $me->getDisplayName() . '\',\'' . $me->getMail() . '\',' . $request->input('Contact') . ',' . '"User",' . '"UnderReview",\'' . $request->input('Society') . '\',\'' . $request->input('Post') . '\');'
        );
        DB::commit();
        return redirect('/');
    }
}