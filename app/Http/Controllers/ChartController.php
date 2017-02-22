<?php

namespace App\Http\Controllers;

use App\Sale;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Redirect;
use App\Drug;
use Illuminate\Support\Facades\DB;


class ChartController extends Controller
{
    public function display()
    {

        $drugs = Drug::all();

        return view('admin.blank')
            ->with('drugs', $drugs);


    }


    public function highcharts(Request $request) {
        $year = $request->get('year');
        $drug = $request->get('drug');
        /*$string = implode(",", $request->get('drug'));*/


        $januaryDetails = Sale::whereMonth ( 'complete_sold', '=','01' )
            ->whereYear('complete_sold', '=',$year)
            ->whereIn('drug_id', $drug)
            ->get ();
        $februaryDetails = Sale::whereMonth ( 'complete_sold','=', '02' )
            ->whereYear('complete_sold', '=',$year)
            ->whereIn('drug_id', $drug)
            ->get ();
        $marchDetails = Sale::whereMonth ( 'complete_sold','=', '03')
            ->whereYear('complete_sold','=', $year)
            ->whereIn('drug_id', $drug)
            ->get ();
        $aprilDetails = Sale::whereMonth ( 'complete_sold', '=','04')
            ->whereYear('complete_sold','=', $year)
            ->whereIn('drug_id', $drug)
            ->get ();
        $mayDetails = Sale::whereMonth ('complete_sold','=', '05')
            ->whereYear('complete_sold', '=',$year)
            ->whereIn('drug_id', $drug)
            ->get ();
        $juneDetails = Sale::whereMonth ( 'complete_sold','=', '06')
            ->whereYear('complete_sold','=', $year)
            ->whereIn('drug_id', $drug)
            ->get ();
        $julyDetails = Sale::whereMonth ( 'complete_sold','=', '07')
            ->whereYear('complete_sold','=', $year)
            ->whereIn('drug_id', $drug)
            ->get ();
        $augustDetails = Sale::whereMonth ( 'complete_sold', '=','08' )
            ->whereYear('complete_sold', '=',$year)
            ->whereIn('drug_id', $drug)
            ->get ();
        $septemberDetails = Sale::whereMonth ( 'complete_sold', '=','09' )
            ->whereYear('complete_sold','=', $year)
            ->whereIn('drug_id', $drug)
            ->get ();
        $octoberDetails = Sale::whereMonth ( 'complete_sold','=', '10' )
            ->whereYear('complete_sold','=', $year)
            ->whereIn('drug_id', $drug)
            ->get ();
        $novemberDetails = Sale::whereMonth ( 'complete_sold','=', '11' )
            ->whereYear('complete_sold','=', $year)
            ->whereIn('drug_id', $drug)
            ->get ();
        $decemberDetails = Sale::whereMonth ( 'complete_sold','=', '12' )
            ->whereYear('complete_sold','=', $year)
            ->whereIn('drug_id', $drug)
            ->get ();


      /*  $featureNames = Drug::select ( 'name' )->groupBy ( 'name' )->get ();*/


        $featureNames  = DB::table('sales')
            ->join('drugs', 'drugs.id', '=', 'sales.drug_id')
            /*->select( 'drugs.name')*/
            ->select( DB::raw("CONCAT(drugs.name,' ',drugs.pack_size)  AS fullname"))

            ->whereIn('drug_id', $drug)
            ->groupBy ( 'drugs.id' )
            ->get();
        $chartArray ["title"] = array (
            "text" => "Sales Trend for [$year]"

        );
        $chartArray ["credits"] = array (
            "enabled" => false
        );

        $chartArray ["tooltip"] = array (
            "valueSuffix" => "units"
        );

        $categoryArray = array (
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December'
        );
        $January = [ ];
        $February = [ ];
        $March = [ ];
        $April = [ ];
        $May = [ ];
        $June = [ ];
        $July = [ ];
        $August = [ ];
        $September = [ ];
        $October = [ ];
        $November = [ ];
        $December = [ ];
        $dataArray = [ ];
        $featureNamesArray = [ ];
        $idx = 0;

        foreach ( $featureNames as $name ) {
            array_push ( $featureNamesArray, $name->fullname );
            /*dd($featureNamesArray);*/
            /*dd($name);*/

        }


        foreach ( $januaryDetails as $det )
            array_push ( $January, ( int ) $det->quantity_sold );
        foreach ( $februaryDetails as $det )
            array_push ( $February, ( int ) $det->quantity_sold );
        foreach ( $marchDetails as $det )
            array_push ( $March, ( int ) $det->quantity_sold );
        foreach ( $aprilDetails as $det )
            array_push ( $April, ( int ) $det->quantity_sold );
        foreach ( $mayDetails as $det )
            array_push ( $May, ( int ) $det->quantity_sold );
        foreach ( $juneDetails as $det )
            array_push ( $June, ( int ) $det->quantity_sold );
        foreach ( $julyDetails as $det )
            array_push ( $July, ( int ) $det->quantity_sold );
        foreach ( $augustDetails as $det )
            array_push ( $August, ( int ) $det->quantity_sold );
        foreach ( $septemberDetails as $det )
            array_push ( $September, ( int ) $det->quantity_sold );
        foreach ( $octoberDetails as $det )
            array_push ( $October, ( int ) $det->quantity_sold );
        foreach ( $novemberDetails as $det )
            array_push ( $November, ( int ) $det->quantity_sold );
        foreach ( $decemberDetails as $det )
            array_push ( $December, ( int ) $det->quantity_sold );


        array_push ($dataArray, $January, $February, $March, $April, $May, $June, $July, $August, $September, $October, $November, $December);


        $chartArray ["series"] = [];

        foreach($featureNamesArray as $nm) {
            $data = [];

            if (!empty($dataArray) || count($dataArray)>0) {
                for ($i = 0; $i < count($dataArray); $i++) {
                    array_push($data, $dataArray[$i][$idx]);


                }

            }

            array_push($chartArray ["series"], array(
                "name" => $nm,
                "data" => $data
            ));

            $chartArray ["xAxis"] = array(
                "categories" => $categoryArray
            );
            $chartArray ["yAxis"] = array(
                "title" => array(
                    "text" => "Amount ( Kshs  )"
                )
            );
            $idx++;
        }
        $chartArray = array_filter($chartArray);

       /* if(empty($chartArray){
            return view('admin.blank2')->with('message', 'Missing data elements');
        }*/

        if(!empty($chartArray)) {
            return view('admin.blank2')->with('chartArray', $chartArray);
        }


    }


}
