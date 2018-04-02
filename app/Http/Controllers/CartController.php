<?php
/**
 * Created by PhpStorm.
 * User: sanjeev halyal
 * Date: 30-03-2018
 * Time: 22:09
 */

namespace App\Http\Controllers;

use DB;
use DateTime,DateInterval,DatePeriod;
class CartController  extends Controller
{

    public function __invoke()
    {
        $cartvalue = array();

        $Cart = \DB::select('select * from cart');


        foreach ($Cart as $c) {


            DB::table('cart')->where('ID', '=', $c->ID)->delete();

            DB::commit();


            $begin = new DateTime($c->START_DATE);
            $end = new DateTime($c->END_DATE);
            $end = $end->modify('+1 day');

            $interval = new DateInterval('P1D');
            $daterange = new DatePeriod($begin, $interval, $end);

            foreach ($daterange as $date) {
                array_push($cartvalue, array($c->barcode, $c->user, $date->format('y-m-d')));
            }
        }

        function custom_sort($a, $b)
        {
            // sort by last name
            $retval = strnatcmp($a[0], $b[0]);
            // if last names are identical, sort by first name
            if (!$retval) $retval = strnatcmp($a[2], $b[2]);
            return $retval;
        }

// sort alphabetically by firstname and lastname
        usort($cartvalue, __NAMESPACE__ . '\custom_sort');


        foreach ($cartvalue as $c) {

            $startdate = $c[2];
            $enddate = $c[2];

            $inCartAfter = \DB::select('select count(*) as c from cart WHERE DATE_ADD(END_DATE, INTERVAL 1 DAY)=? and barcode=? and user=?', [$c[2], $c[0], $c[1]]);

            $inCartBefore = \DB::select('select count(*) as c from cart WHERE DATE_ADD(START_DATE, INTERVAL -1 DAY)=? and barcode=? and user=?', [$c[2], $c[0], $c[1]]);


            if ($inCartAfter[0]->c == 1) {

                $START_DATE = DB::select('select ID,START_DATE from cart WHERE DATE_ADD(END_DATE, INTERVAL 1 DAY)=? and barcode=? and user=?', [$c[2], $c[0], $c[1]]);

                DB::table('cart')->where('ID', '=', $START_DATE[0]->ID)->delete();

                DB::commit();

                $startdate = $START_DATE[0]->START_DATE;


            } else if ($inCartBefore[0]->c == 1) {

                $END_DATE = \DB::select('select ID,END_DATE from cart WHERE DATE_ADD(START_DATE, INTERVAL -1 DAY)=? and barcode=? and user=?', [$c[2], $c[0], $c[1]]);

                DB::table('cart')->where('ID', '=', $END_DATE[0]->ID)->delete();
                DB::commit();

                $enddate = $END_DATE[0]->END_DATE;

            }

            DB::table('cart')->insert([
                ['extime' => time() + 1800, 'barcode' => $c[0], 'user' => $c[1], 'START_DATE' => $startdate, 'END_DATE' => $enddate]
            ]);
            DB::commit();


        }


        return view('cart/cart');
    }
}