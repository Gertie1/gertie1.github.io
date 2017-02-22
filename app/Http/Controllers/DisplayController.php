<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Drug;
use App\Disease;
use App\Disease_Drug;
use Illuminate\Support\Facades\DB;

class DisplayController extends Controller
{

    public function display()
    {
        $display = DB::table('diseases_drugs')
            ->join('diseases', 'diseases.id', '=', 'diseases_drugs.disease_id')
            ->select('diseases_drugs.*', 'diseases.name')
            ->get();
        /*dd($display);*/
        return view('admin.display')
            ->with('display', $display);

    }



    public function editMapping($id)
    {
        $item = Disease_Drug::findOrFail($id);
        $disease = DB::table('diseases')->where('id',$item['disease_id'])->first();
        $drugs_arr = explode(",",$item['drug_id'] );
        $drugs = DB::table('drugs')->select('id', 'name')->get();

        return view('admin.form')
            ->with(['item' => $item,'disease' => $disease, 'drugs' => $drugs, 'checked_drugs' => $drugs_arr]);


    }
    public function viewMapping($id)
    {
        $item = Disease_Drug::findOrFail($id);
        $disease = DB::table('diseases')->where('id',$item['disease_id'])->first();
        $drugs_arr = explode(",",$item['drug_id'] );
        $drugs = DB::table('drugs')
            ->join('stocks','stocks.drug_id' , '=', 'drugs.id')
            ->select('drugs.id', 'drugs.name', 'stocks.amount_sold')->get();
        $incidence = DB::table('diseases_incidences')
            ->select(DB::raw('AVG(incidence)'))
            ->get();
            /*->where('Month', $month)*/
       $stocks = DB::table('stocks')
           ->join('drugs', 'drugs.id', '=', 'stocks.drug_id')
           /*->select('stocks.*',DB::raw('AVG(stocks.amount_sold) as amount_average'))*/
           ->select('stocks.amount_sold')
           ->where('Month', 'July')
           /*->where('drug_id', $drugs)*/


           ->get();


        /*dd($stocks);*/

        /*$quantity = ($stocks) + (0.05 * $incidence);*/

        return view('admin.likely2')
            ->with(['item' => $item,'disease' => $disease, 'drugs' => $drugs,'stocks' => $stocks, 'incidence' => $incidence, 'checked_drugs' => $drugs_arr]);


    }
    /* $item = $request->all();
           $item->save();*/
    /*$item->fill($input)->save();*/

    public function updateMapping($id, Request $request)
    {
        $item = Disease_Drug::findOrFail($id);

        $string = implode(",", $request->get('drug'));
        $input = [
            'drug_id' => $string,
            'disease_id' => $request->get('disease'),

        ];

        DB::table('diseases_drugs')
            ->where('id', $item['id'])
            ->update($input);


        return redirect()->back();
    }

/*foreach (Input::get('result') as $studentId=>$value)
{
$attendance = new Attendances();
$attendance->status = $value;
$attendance->comment = Input::get('comment');
    //We should save the student id somewhere.
$attendance->student_id = $studentId;
$attendance->save();
}*/
    /* Disease_Drug::where('id', $item)->update();*/
    /* Session::flash('flash_message', 'Task successfully added!');*/

    public function display2()
    {
        $display = DB::table('diseases_drugs')
            ->join('diseases', 'diseases.id', '=', 'diseases_drugs.disease_id')
            ->select('diseases_drugs.*', 'diseases.name')
            ->get();
        /*dd($display);*/
        return view('admin.likely')
            ->with('display', $display);

    }
}