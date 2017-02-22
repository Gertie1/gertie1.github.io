<?php

namespace App\Http\Controllers;

use App\Inventory;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Drug;
use Illuminate\Support\Facades\Input;
use App\Stock;
use Illuminate\Support\Facades\DB;
use App\Disease;
use App\Disease_Drug;



class StockController extends Controller
{
    public function stocks()
    {
        $stocks = DB::table('receives')

            ->join('drugs', 'drugs.id', '=', 'receives.drug_id')
            ->select('receives.*', 'drugs.name','drugs.pack_size')
            ->simplePaginate(10);

        return view('admin.stock')
            ->with('stocks', $stocks);

    }
    public function track()
    {
        $drugs = Drug::all();

        return view('admin.track')
            ->with('drugs', $drugs);

    }

    public function newStock()
    {
        $drugs = Drug::all();

        return view('admin.stockr')

            ->with('drugs', $drugs);
    }

    public function addNewStock(Request $request)
    {

        $stock = count($request['drug']);

        $insert = array();
        $insert1 = array();
        $rules = array(
            'drug_id'             => 'required',                        // just a normal required validation
            'batch_number' => 'required|unique:receives',
            /*'month_received' => 'required', */          // required and has to match the password field

            /*'amount_received' => 'required|greater_than_field:amount_sold',
            'amount_sold' => 'required',
            'finish_date' => 'required|date|after:start_date'
            'start_date' => 'required|date|after:tomorrow'*/
            'quantity_received'=>'required',
            /*'year_received' => 'required',
            'date_received' => 'required',*/
            'complete_received' => 'required',
            'expiry_date' => 'required',

        );
        $messages = [
            'required' => 'The :attribute field is required.',
            'amount_received.greater_than_field'=>'You cannot sell more than what you received'
        ];
        $success = 'Added successfully';


        for ($i = 0; $i < $stock; $i++) {
            if (!empty($request['drug'][$i])) {
                array_push($insert, array( // iterate through each entry and create an array of inputs

                    'id' => $request['id'][$i],
                    'drug_id' => $request['drug'][$i],
                    'batch_number' => $request['batch_number'][$i],
                    'quantity_received' => $request['quantity_received'][$i],

                   /* 'month_received' => $request['month_received'][$i],
                    'year_received' => $request['year_received'][$i],
                    'date_received' => $request['date_received'][$i],*/
                    'complete_received' => $request['complete_received'][$i],
                    'expiry_date' => $request['expiry_date'][$i],

                    /*'amount_remaining' => ($request['amount_received'][$i]) - ($request['amount_sold'][$i]),*/

                ));

            }

        }


        for ($i = 0; $i < $stock; $i++) {
            if (!empty($request['drug'][$i])) {
               /* $available_stock= DB::table('stocks')
                    ->select( 'stocks.available_stock')
                    ->where('batch_number', $request['batch_number'][$i]);
                $quantity_received = $request->get('quantity_received');*/


                DB::table('stocks')
                    ->where('batch_number', $request['batch_number'][$i])
                    ->update(array(

                        'available_stock' =>$request['quantity_received'][$i],

                    ));



            }
        }

        foreach ($insert as $key){
            // do the validation ----------------------------------
            // validate against the inputs from our form
            $validator = \Validator::make($key, $rules,$messages);

            // check if the validator failed -----------------------
            if ($validator->fails()) {

                // get the error messages from the validator
                $messages = $validator->messages();

                // redirect our user back to the form with the errors from the validator
                return \Redirect::to('stockr')
                    ->withErrors($messages)
                    ->withInput();


            }
        }
        $result=Stock::insert($insert);

        \Session::flash('flash_message','Stock successfully added.');
        /*Inventory::insert($insert);*/

        return redirect('stock');

    }

    public function deleteStock(Request $request)
    {
        if($request->ajax())
        {
            Stock::destroy($request->id);
            Inventory::destroy($request->id);
            return Response()->json(['sms'=>'Successfully deleted']);

        }

    }

    public function searchStock(Request $request)
    {
        if($request->ajax())
        {
            $output="";
            $stocks=DB::table('receives')->where('batch_number','LIKE','%'.$request->search.'%')->get();

            if($stocks){
                foreach ($stocks as $key => $item){
                    $output.='<tr>'.
                        '<td>'. $item->id.'</td>'.
                        '<td>'. $item->drug_id.'</td>'.
                        '<td>'. $item->batch_number.'</td>'.
                        '<td>'. $item->quantity_received.'</td>'.
                        /*'<td>'. $item->date_received.'</td>'.
                        '<td>'. $item->month_received.'</td>'.
                        '<td>'. $item->year_received.'</td>'.*/
                        '<td>'. $item->expiry_date.'</td>'.
                        '<td>'. $item->complete_received.'</td>'.

                        '<td><button class="delete-modal btn btn-danger btn-delete" data-id="'.$item->id.'">Delete</button></td>'.

                         '<td><button class="delete-modal btn btn-danger btn-delete" data-id="'.$item->id.'">Delete</button><a class="edit-modal btn btn-info btn-edit" href= "{{ route(\'editStock\', \'.$item->id.\') }}" >Edit</a> </td>'.

                        '</tr>';
                }
                return response($output);

            }

        }
    }

    public function editStock($id)
    {
        $item1 = Inventory::findOrFail($id);
        $drug1 = DB::table('drugs')->where('id',$item1['drug_id'])->first();
        $batch_number1 = $item1['batch_number'];
        $quantity_received1 = $item1['quantity_received'];
        /*$date_received1 = $item1['date_received'];
        $month_received1 = $item1['month_received'];
        $year_received1 = $item1['year_received'];*/
        $expiry_date1 = $item1['expiry_date'];
        $complete_received1 = $item1['complete_received'];

        $item = Stock::findOrFail($id);
        $drug = DB::table('drugs')->where('id',$item['drug_id'])->first();
        $batch_number = $item['batch_number'];
        $quantity_received = $item['quantity_received'];
        /*$date_received = $item['date_received'];
        $month_received = $item['month_received'];
        $year_received = $item['year_received'];*/
        $expiry_date = $item['expiry_date'];
        $complete_received = $item['complete_received'];

        return view('admin.stocke')
            ->with(['item' => $item, 'drug' => $drug, 'batch_number' => $batch_number,'quantity_received' => $quantity_received,'expiry_date' => $expiry_date,'complete_received' => $complete_received, ])
            ->with(['item' => $item1, 'drug' => $drug1, 'batch_number' => $batch_number1,'quantity_received' => $quantity_received1,'expiry_date' => $expiry_date1,'complete_received' => $complete_received1, ]);

    }
    /* $item = $request->all();
           $item->save();*/
    /*$item->fill($input)->save();*/

    public function updateStock($id, Request $request)
    {

        $item=Stock::find($id);
        $item1=Inventory::find($id);
        /*$id = $request->get('id');*/
        $drug = $request->get('drug');
        $batch_number = $request->get('batch_number');
        $quantity_received = $request->get('quantity_received');
        /*$date_received = $request->get('date_received');
        $month_received = $request->get('month_received');
        $year_received = $request->get('year_received');*/
        $expiry_date= $request->get('expiry_date');
        $complete_received = $request->get('complete_received');


        DB::table('receives')
            ->where('id', $item['id'])
            ->update(array(
               /* 'id' => $id,*/
                'drug_id' => $drug,
                'batch_number' =>$batch_number,
                'quantity_received' =>$quantity_received,
                /*'date_received' => $date_received,
                'month_received' => $month_received,
                'year_received' => $year_received,*/
                'expiry_date' => $expiry_date,
                'complete_received' => $complete_received,

                /* 'amount_remaining' =>($amount_received)-($amount_sold)*/


            ));
        DB::table('inventories')
            /*->where('id', $item1['id'])*/
            ->where('batch_number', $item1['batch_number'])
            ->update(array(
                /*'id' => $id,*/
                'drug_id' => $drug,
                'batch_number' =>$batch_number,
                'quantity_received' =>$quantity_received,
                /*'date_received' => $date_received,
                'month_received' => $month_received,
                'year_received' => $year_received,*/
                'expiry_date' => $expiry_date,
                'complete_received' => $complete_received,

                /* 'amount_remaining' =>($amount_received)-($amount_sold)*/


            ));



        return redirect()->back();
    }

    public function often(Request $request)
    {
        /*$reservations = Reservation::whereBetween('reservation_from', [$from, $to])->get();*/
        $from = $request->get('start_date');
        $to = $request->get('end_date');
        $stocks = Inventory::whereBetween('complete_sold', [$from, $to])
            ->join('drugs', 'drugs.id', '=', 'inventories.drug_id')
            ->select('inventories.*', 'drugs.name',DB::raw('SUM(inventories.quantity_sold) as total_sales'))
            ->where('percentage_consumed', '>',69)
            ->groupBy('drugs.id')
            ->get();

        return view('admin.often')
            ->with('stocks', $stocks);
    }

    public function minimum(Request $request)
    {
        /*$reservations = Reservation::whereBetween('reservation_from', [$from, $to])->get();*/
        $from = $request->get('start_date');
        $to = $request->get('end_date');
        $stocks = Inventory::whereBetween('complete_sold', [$from, $to])
            ->join('drugs', 'drugs.id', '=', 'inventories.drug_id')
            ->select('inventories.*', 'drugs.name')
            ->where('min_stock', '<',10)
            ->groupBy('drugs.id')
            ->get();

        return view('admin.minimum')
            ->with('stocks', $stocks);
    }

    public function none(Request $request)
    {

        $from = $request->get('start_date');
        $to = $request->get('end_date');
        $stocks = Inventory::whereBetween('complete_sold', [$from, $to])
            ->join('drugs', 'drugs.id', '=', 'inventories.drug_id')
            ->select('inventories.*', 'drugs.name')
            ->where('amount_remaining', '=',0)
            /*->simplePaginate(10)*/
            ->groupBy('drugs.id')
            ->get();

  /*      $year = $request->get('year');
        $month = $request->get('month');
        $stocks = DB::table('stocks')
            ->join('drugs', 'drugs.id', '=', 'stocks.drug_id')
            ->select('stocks.*', 'drugs.name')

            ->where('Year', $year)
            ->where('Month', $month)
            ->where('amount_remaining', '=',0)
            ;*/

        return view('admin.none')
            ->with('stocks', $stocks);
    }

    public function rarely(Request $request)
    {
        $from = $request->get('start_date');
        $to = $request->get('end_date');
        $stocks = Inventory::whereBetween('complete_sold', [$from, $to])
            ->join('drugs', 'drugs.id', '=', 'inventories.drug_id')
            ->select('inventories.*', 'drugs.name',DB::raw('SUM(inventories.quantity_sold) as total_sales'))
            ->where('percentage_consumed', '<',40)
            ->groupBy('drugs.id')
            ->get();

        return view('admin.rarely')
            ->with('stocks', $stocks);
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

        return view('admin.likely')
            ->with('drugs', $drugs);
    }

    public function display()
    {
        $diseases = Disease::all();
        $drugs = Drug::all();

        /*  $chunks = $drugs->chunk(3);
          $chunks->toArray();*/

        return view('admin.likely2')
            ->with('diseases', $diseases)
            ->with('drugs', $drugs);

    }
    public function viewMapping($id)
    {
        $item = Disease_Drug::findOrFail($id);
        $disease = DB::table('diseases')->where('id',$item['disease_id'])->first();
        $drugs_arr = explode(",",$item['drug_id'] );
        $drugs = DB::table('drugs')->select('id', 'name')->get();

        return view('admin.likely2')
            ->with(['item' => $item,'disease' => $disease, 'drugs' => $drugs, 'checked_drugs' => $drugs_arr]);


    }
    public function report(Request $request)
    {
        /*$reservations = Reservation::whereBetween('reservation_from', [$from, $to])->get();*/
        $drug = $request->get('drug');
        $drugs = DB::table('inventories')

            ->select('inventories.*')
            ->where('drug_id', $drug)
           
            ->get();

        return view('admin.track2')
            ->with('drugs', $drugs);
    }

}
