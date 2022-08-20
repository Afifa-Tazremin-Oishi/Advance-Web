<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PieChartController extends Controller
{
    function productPieChart(){

        $result=DB::select(DB::raw("SELECT count(*) as total_category, category from products group by category"));
        $productPieChartData="";
        foreach($result as $list)
        {
            $productPieChartData.="['".$list->category."',    ".$list->total_category."],";
        }
        $arr['productPieChartData']=rtrim($productPieChartData,",");
        
        return view('pages.product.productPieChart',$arr);


    }
    function allOrderListStatusPieChart(){
   

        $result=DB::select(DB::raw("SELECT count(*) as total_status, status from orders group by status"));
        $orderStatusPieChartData="";
        foreach($result as $list)
        {
            $orderStatusPieChartData.="['".$list->status."',    ".$list->total_status."],";
        }
        $arr['orderStatusPieChartData']=rtrim($orderStatusPieChartData,",");

        return view("pages.order.allOrderListStatusPieChart",$arr);
    }
    
}
