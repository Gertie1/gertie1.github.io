<?php

namespace App\Http\Controllers;

use App\Report;
use App\Sale;
use App\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Drug;
use App\Http\Requests;
use App\Inventory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class SalesController extends Controller
{
    public function stocks()
    {
        $stocks = DB::table('sales')

            ->join('drugs', 'drugs.id', '=', 'sales.drug_id')
            ->join('inventories', 'inventories.batch_number', '=', 'sales.batch_number')
            ->select('sales.*', 'drugs.name','drugs.pack_size','inventories.amount_remaining')
            ->simplePaginate(10);

        return view('admin.sales')
            ->with('stocks', $stocks);

    }

    public function newStock()
    {
        $drugs = Drug::all();
        /*$receives = Stock::all()->pluck('batch_number');*/

        /*$drug_id = DB::table('receives')->select('drug_id');
        $batch_numbers = DB::table('receives')->where('drug_id', $drug_id)->pluck('batch_number');*/

        $query = DB::table('receives')->select('drug_id');
        $batch_numbers = $query->addSelect('batch_number')->get();

        $data=array('drugs'=>$drugs, 'batch_numbers'=>$batch_numbers);
        return \View::make("admin.salesr")->with($data);


        /*$name = DB::table('users')->where('name', 'John')->pluck('name');*/

        /*$query = DB::table('receives')->select('drug_id');
        $receives = $query->addSelect('batch_number')->get();*/
        /*$receives = DB::table('receives')->select('batch_number');*/

        /*$batch_numbers = DB::table('receives')
            ->join('drugs', 'drugs.id', '=', 'receives.drug_id')
            ->select('receives.batch_number');*/

    }

    public function addNewStock(Request $request)
    {
        $stock = count($request['drug']);

        for ($i = 0; $i < $stock; $i++) {
            $product_availability = Inventory::select('amount_remaining')->where('batch_number', $request['batch_number'][$i])->first();

            /*$rules['quantity_sold'] = 'max:'.$product_availability->amount_remaining;*/
            /*$rules = ['quantity_sold'=>'max:'.$product_availability->amount_remaining];*/


            $insert = array();
            $rules = array(
                'drug_id' => 'required',                        // just a normal required validation
                'batch_number' => 'required',
                /*'month_sold' => 'required',  */         // required and has to match the password field

                /*'amount_received' => 'required|greater_than_field:amount_sold',
                'amount_sold' => 'required',*/
                'quantity_sold' => 'integer|max:' . $product_availability->amount_remaining,
                /*'quantity_sold' => 'required',*/
                /* 'year_sold' => 'required',
                 'date_sold' => 'required',*/
                'complete_sold' => 'required',


            );
            $messages = [
                'required' => 'The :attribute field is required.',
                'amount_received.greater_than_field' => 'You cannot sell more than what you received',

            ];
            $success = 'Added successfully';
        }

        for ($i = 0; $i < $stock; $i++) {
            if (!empty($request['drug'][$i])) {
                array_push($insert, array( // iterate through each entry and create an array of inputs

                    /*'id' => $request['id'][$i],*/
                    'drug_id' => $request['drug'][$i],
                    'batch_number' => $request['batch_number'][$i],
                    'quantity_sold' => $request['quantity_sold'][$i],

                   /* 'month_sold' => $request['month_sold'][$i],
                    'year_sold' => $request['year_sold'][$i],
                    'date_sold' => $request['date_sold'][$i],*/
                    'complete_sold' => $request['complete_sold'][$i],
                    'total_price' => ($request['unit_price'][$i])*($request['quantity_sold'][$i]),


                    /*'amount_remaining' => ($request['amount_received'][$i]) - ($request['amount_sold'][$i]),*/

                ));

            }

        }
        /* for ($i = 0; $i < $stock; $i++) {
             if (!empty($request['drug'][$i])) {

                 DB::table('inventories')
                     ->where('batch_number', $request['batch_number'][$i])
                     ->update(array(

                         'quantity_sold' => $request['quantity_sold'][$i],
                         'month_sold' => $request['month_sold'][$i],
                         'year_sold' => $request['year_sold'][$i],
                         'date_sold' => $request['date_sold'][$i],
                         'complete_sold' => $request['complete_sold'][$i],

                     ));



             }

         }*/
        /* $available_stock= DB::table('stocks')
                    ->select( 'stocks.available_stock')
                    ->where('batch_number', $request['batch_number'][$i]);
                $quantity_received = $request->get('quantity_received');*/

        foreach ($insert as $key){
            // do the validation ----------------------------------
            // validate against the inputs from our form
            $validator = \Validator::make($key, $rules,$messages);

            // check if the validator failed -----------------------
            if ($validator->fails()) {

                // get the error messages from the validator
                $messages = $validator->messages();

                // redirect our user back to the form with the errors from the validator
                return \Redirect::to('salesr')
                    ->withErrors($messages)
                    ->withInput();


            }
        }
        Sale::insert($insert);
        /*Inventory::insert($insert);*/
        return redirect('sales');

    }

    public function deleteStock(Request $request)
    {
        if($request->ajax())
        {
            Sale::destroy($request->id);
            /*Inventory::destroy($request->id);*/
            /*    DB::table('inventories')->where('id',$request->id)
                    ->delete(array('quantity_sold'));*/
            return Response()->json(['sms'=>'Successfully deleted']);

        }

    }

    public function searchStock(Request $request)
    {
        if($request->ajax())
        {
            $output="";
            $stocks=DB::table('sales')->where('name','LIKE','%'.$request->search.'%')->get();

            if($stocks){
                foreach ($stocks as $key => $item){
                    $output.='<tr>'.
                        /*'<td>'. $item->id.'</td>'.*/
                        '<td>'. $item->drug_id.'</td>'.
                        '<td>'. $item->batch_number.'</td>'.
                        '<td>'. $item->quantity_sold.'</td>'.
                        '<td>'. $item->date_sold.'</td>'.
                        '<td>'. $item->month_sold.'</td>'.
                        '<td>'. $item->year_sold.'</td>'.

                        '<td>'. $item->complete_sold.'</td>'.

                        '<td><button class="delete-modal btn btn-danger btn-delete" data-id="'.$item->id.'">Delete</button></td>'.

                        '</tr>';
                }
                return response($output);

            }

        }
    }

    public function editStock($id)
    {
        $item = Sale::findOrFail($id);
        $drug = DB::table('drugs')->where('id',$item['drug_id'])->first();
        $batch_number = DB::table('receives')->where('batch_number',$item['batch_number'])->first();
        $quantity_sold = $item['quantity_sold'];
     /*   $date_sold = $item['date_sold'];
        $month_sold = $item['month_sold'];
        $year_sold = $item['year_sold'];*/
        $complete_sold = $item['complete_sold'];

        /*  $item1 = Inventory::findOrFail($id);
          $drug1 = DB::table('drugs')->where('id',$item1['drug_id'])->first();
          $batch_number1 = DB::table('receives')->where('batch_number',$item1['batch_number'])->first();
          $quantity_sold1 = $item1['quantity_sold'];
          $date_sold1 = $item1['date_sold'];
          $month_sold1 = $item1['month_sold'];
          $year_sold1 = $item1['year_sold'];
          $complete_sold1 = $item1['complete_sold'];*/

        return view('admin.salee')
            ->with(['item' => $item, 'drug' => $drug, 'batch_number' => $batch_number,'quantity_sold' => $quantity_sold,'complete_sold' => $complete_sold, ]);
        /*  ->with(['item' => $item1, 'drug' => $drug1, 'batch_number' => $batch_number1,'quantity_sold' => $quantity_sold1,'date_sold' => $date_sold1, 'month_sold' => $month_sold1,'year_sold' => $year_sold1,'complete_sold' => $complete_sold1, ]);*/

    }
    /* $item = $request->all();
           $item->save();*/
    /*$item->fill($input)->save();*/

    public function updateStock($id, Request $request)
    {

        $item=Sale::find($id);
        /* $item1=Inventory::find($id);*/
        $drug = $request->get('drug');
        /* $id = $request->get('id');*/
        $batch_number = $request->get('batch_number');
        $quantity_sold = $request->get('quantity_sold');
       /* $date_sold = $request->get('date_sold');
        $month_sold = $request->get('month_sold');
        $year_sold = $request->get('year_sold');*/
        $complete_sold = $request->get('complete_sold');


        DB::table('sales')
            ->where('id', $item['id'])
            ->update(array(
                /*'id' => $id,*/
                'drug_id' => $drug,
                'batch_number' =>$batch_number,
                'quantity_sold' =>$quantity_sold,
               /* 'date_sold' => $date_sold,
                'month_sold' => $month_sold,
                'year_sold' => $year_sold,*/
                'complete_sold' => $complete_sold,

                /* 'amount_remaining' =>($amount_received)-($amount_sold)*/

            ));
        /*  DB::table('inventories')
             ->where('id', $item1['id'])
              ->where('batch_number', $item1['batch_number'])

              ->update(array(

                  'quantity_sold' =>$quantity_sold,
                  'date_sold' => $date_sold,
                  'month_sold' => $month_sold,
                  'year_sold' => $year_sold,
                  'complete_sold' => $complete_sold,

              ));*/

        return redirect('sales');
        /*return redirect()->back();*/
    }


    public function likely2()
    {
        $drugs = Drug::all();
        /*$drugs = DB::table('drugs');*/
        //return view ('admin.drugs') ->with('drugs',$drugs);
        /*    return view('admin.likely2', ['drugs' => $drugs]);*/
        return view('admin.likely2')
            ->with('drugs', $drugs);

    }
    public function likely(Request $request)
    {
        $dt = Carbon::today();
        /*dd($dt);*/
        $yearStart = $dt->startOfYear();
        /*dd($yearStart);*/
        $yearEnd = $dt->endOfYear();
        /*dd($yearEnd);*/
        $first = $yearEnd->subYears(2);
        /*dd($first);*/
        $second = $yearEnd->subYears(1);
        /*dd($second);*/
        /*->whereBetween('complete_sold', array($first, $second))*/

        $stocks = DB::table('inventories')
            ->join('drugs', 'drugs.id', '=', 'inventories.drug_id')
            ->select('drugs.name','drugs.mos', 'inventories.drug_id',DB::raw ('sum(inventories.quantity_sold) as total_sales'), DB::raw ('sum(inventories.amount_remaining) as total_amount'),DB::raw ('AVG(inventories.quantity_sold) as average_sales'))
            ->whereYear('inventories.complete_sold','>','2014')
            ->whereYear('inventories.complete_sold','<','2017')
            ->whereMonth('inventories.complete_sold','=', Carbon::today()->month)
            /*->whereMonth('inventories.complete_sold','=', Carbon::now()->addMonths(1))*/
            ->groupBy('inventories.drug_id')
            ->get();

           /*dd($stocks);*/
        /*$stock2 = $stocks->addSelect(DB::raw ('sum(inventories.amount_remaining) as total_amount'));*/

        $stock2 = DB::table('inventories')
            ->join('drugs', 'drugs.id', '=', 'inventories.drug_id')
            ->select( DB::raw ('AVG(inventories.quantity_sold) as average_sales'))
            /*->whereMonth('complete_sold','=', Carbon::today()->month)*/
            ->whereBetween('complete_sold', array('2016-11-01', '2016-12-31' ))
            ->groupBy('inventories.drug_id')
            ->get();
        ;

   /*     $stock1 = DB::table('inventories')
            ->join('drugs', 'drugs.id', '=', 'inventories.drug_id')
            ->select(DB::raw ('sum(inventories.quantity_sold) as total_sales'))
            ->whereYear('inventories.complete_sold','>','2014')
            ->whereYear('inventories.complete_sold','<','2017')
            ->whereMonth('inventories.complete_sold','=', Carbon::today()->month)
            ->groupBy('inventories.drug_id')
            ->get();

        $stock3 = DB::table('inventories')
            ->join('drugs', 'drugs.id', '=', 'inventories.drug_id')
            ->select('drugs.name')
            ->whereYear('inventories.complete_sold','>','2014')
            ->whereYear('inventories.complete_sold','<','2017')
            ->whereMonth('inventories.complete_sold','=', Carbon::today()->month)
            ->groupBy('inventories.drug_id')
            ->get();*/



        $data = DB::table('report')
            ->join('drugs', 'drugs.id', '=', 'report.drug_id')
            ->select('drugs.name','drugs.mos', 'report.*')
            ->groupBy('report.drug_id')

            ->get();

     /*   $stock1 =collect((array) $stock1);
        $stock2 =$stock1->merge((array) $stock2);
        $stock2->all();
        $stock3 =$stock2->merge((array) $stock3);
        $data = $stock3;*/




        /*dd($stocks);*/
      /* $data = array_merge_recursive($stock2,$stocks);*/

        /*$array = array_pluck($data, 'name', 'total_sales','average_sales');*/
     /*   dd($data);*/

        return view('admin.likely')
            ->with('stocks', $stocks)
        ->with('stock2',$stock2) ;
          /* ->with('data', ['stocks' => $stocks, 'stock2' => $stock2]);*/
       /*    ->with('data',$data);*/



/*
            ->with('stocks', $stocks)*/
           /* ->with('data', $data);*/

    }

    public function display1(Request $request)
    {
        $disease = $request->get('disease');

        $drugs = DB::table('diseases_drugs')
            ->join('diseases', 'diseases.id', '=', 'diseases_drugs.disease_id')
            ->join('drugs', 'drugs.id', '=', 'diseases_drugs.drug_id')
            ->select('diseases_drugs.*', 'drugs.name')
            ->where('disease_id', $disease)
            ->get();

        /*$drugs_name = DB::table('drugs')
            ->select('id', 'name')->get()
            ->where('drug_id',$drugs);*/

        /*->join('diseases', 'diseases.id', '=', 'diseases_drugs.disease_id')
            ->select('diseases_drugs.*', 'diseases.name')*/
        /*    $disease = DB::table('diseases')->where('id',$item['disease_id'])->first();
       $drugs_arr = explode(",",$item['drug_id'] );
       $drugs = DB::table('drugs')->select('id', 'name')->get();*/


        /*$item = Disease_Drug::findOrFail($id);*/
        /*$disease = DB::table('diseases')->where('id',$item['disease_id'])->first();

        $diseaseDetails = Stock::where ( 'Month', 'January' )
        ->where('Year', $year)
        ->whereIn('drug_id', $drug)
        ->get ();*/

        return view('admin.test')
            ->with('drugs', $drugs);
    }



}
