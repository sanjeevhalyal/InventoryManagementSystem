<?php
/**
 * Created by PhpStorm.
 * User: sanjeev halyal
 * Date: 30-03-2018
 * Time: 13:32
 */

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use DB;
class AddToCartController extends Controller
{
    public function __invoke(Request $request)
    {

        $me=app('App\Traits\GetMe')->getme();

        foreach ($request->input('Dates') as $date) {

            $startdate=$date;
            $enddate=$date;

            $inCartAfter = \DB::select('select count(*) as c from cart WHERE DATE_ADD(END_DATE, INTERVAL 1 DAY)=? and barcode=? and user=?', [$date, $request->input("ProdId"), $me->userid]);

            $inCartBefore = \DB::select('select count(*) as c from cart WHERE DATE_ADD(START_DATE, INTERVAL -1 DAY)=? and barcode=? and user=?', [$date, $request->input("ProdId"), $me->userid]);


            if ($inCartAfter[0]->c == 1) {

                $START_DATE = DB::select('select ID,START_DATE from cart WHERE DATE_ADD(END_DATE, INTERVAL 1 DAY)=? and barcode=? and user=?', [$date, $request->input("ProdId"), $me->userid]);

                DB::table('cart')->where('ID', '=', $START_DATE[0]->ID)->delete();

                DB::commit();

                $startdate=$START_DATE[0]->START_DATE;


            } else if ($inCartBefore[0]->c == 1)
            {

                $END_DATE =\DB::select('select ID,END_DATE from cart WHERE DATE_ADD(START_DATE, INTERVAL -1 DAY)=? and barcode=? and user=?', [$date, $request->input("ProdId"), $me->userid]);

                DB::table('cart')->where('ID', '=', $END_DATE[0]->ID)->delete();
                DB::commit();

                $enddate=$END_DATE[0]->END_DATE;

            }

                DB::table('cart')->insert([
                    ['extime' => time()+1800, 'barcode' => $request->input("ProdId"),'user'=> $me->userid ,'START_DATE'=>$startdate,'END_DATE'=>$enddate]
                ]);
                DB::commit();
                echo 1;

        }
    }


}