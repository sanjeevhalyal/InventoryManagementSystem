<?php
/**
 * Created by PhpStorm.
 * User: sanjeev halyal
 * Date: 28-03-2018
 * Time: 21:07
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class GetProductController extends Controller
{
    public function __invoke(Request $request)
    {


        $pro = \DB::table('products')->select('name as n','description  as d','productID as p')->where('category', 'like',$request->input('category') )->get();

        foreach ($pro as $key =>$pp)
        {


            echo '<tr>
                        <th scope="row">'.($key+1).'</th>
                        <td>'.$pp->n.'</td>
                        <td>'.$pp->d.'</td>
                        <td>'.$pp->p.'</td>
                        <td><button onclick="viewprod('.$pp->p.');">View</button></td>
                    </tr>';

        }




    }
}