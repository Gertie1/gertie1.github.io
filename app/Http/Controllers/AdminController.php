<?php

namespace App\Http\Controllers;

use App\Disease;
use App\Disease_Incidence;
use App\Drug;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use App\Pharmacy;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use App\Http\Controllers\Controller;



class AdminController extends Controller
{
    public function home(){
        return view ('admin.index');
    }
   // public function login(){
     //   return view ('admin.login');
   // }
    public function welcome(){
        return view ('admin.welcome');
    }
    public function welcome2(){
        return view ('admin.welcome2');
    }
    public function admin(){
        return view ('admin.admin');
    }

    public function grid(){
        return view ('admin.grid');
    }
    public function buttons(){
        return view ('admin.buttons');
    }

    public function users(Request $request){
        $users = User::all();
        return view ('admin.users') ->with('users',$users);
    }

    public function drugs(Request $request){
        $drugs = Drug::all();
        return view ('admin.drugs') ->with('drugs',$drugs);
    }

    public function diseases(Request $request){
        $diseases = Disease::all();
        return view ('admin.diseases') ->with('diseases',$diseases);
    }

    public function newUser(Request $request){
        if($request->ajax()){
            $item = User::create($request->all());
            $item->save();
            return response()->json($item);
        }
    }

    public function logout() {
        auth()->logout();

        return redirect()->route('/');
    }

    public function getUpdate(Requests $request){
        if($request->ajax())
        {
            $item=User::find($request->id);
            return Response($item);

        }
    }
    public function newUpdate(Request $request)
    {
        if($request->ajax())
        {
            $item=User::find($request->id);
            $item->Username=$request->name;
            $item->email=$request->email;
            $item->save();
            return Response($item);
        }

    }

    public function deleteUser(Request $request)
    {
        if($request->ajax())
        {
            User::destroy($request->id);
            return Response()->json(['sms'=>'Successfully deleted']);

        }

    }
    public function locations(Request $request){
        $pharmacies = DB::table('pharmacies')->simplePaginate(10);
        //return view ('admin.drugs') ->with('drugs',$drugs);
        return view('admin.locations', ['pharmacies' => $pharmacies]);
    }
    public function settings(Request $request){
        $drugs = DB::table('pharmacies')->simplePaginate(10);
        //return view ('admin.drugs') ->with('drugs',$drugs);
        return view('admin.settings', ['drugs' => $drugs]);
    }

    public function editSetting($id)
    {
        $item = Pharmacy::findOrFail($id);
        $drug = DB::table('pharmacies')->where('id',$item['pharmacy_id'])->first();
        $name = $item['name'];
        $location = $item['location'];


        return view('admin.settinge')
            ->with(['item' => $item, 'name' => $name, 'location' => $location, ]);


    }
    /* $item = $request->all();
           $item->save();*/
    /*$item->fill($input)->save();*/

    public function updateSetting($id, Request $request)
    {

        $item=Pharmacy::find($id);
        $name = $request->get('name');
        $location = $request->get('location');


        DB::table('pharmacies')
            ->where('id', $item['id'])
            ->update(array(
                'name' => $name,
                'location' =>$location,

            ));


        return redirect('settings');
        /*return redirect()->back();*/
    }
    public function addNewSetting(Request $request)
    {
        /*    $input = Input::all();
             $drug = $request->drug('drug');
             $amount_received = $request->drug('amount_received');*/


       /* $stock = count($request['drug']);

        $insert = array();*/

        $rules = array(
            'location'             => 'required',                        // just a normal required validation
            'name' => 'required|unique:pharmacies',

        );
        $messages = [
            'required' => 'The :attribute field is required.',
            'unique' => 'Duplicate record exists.',

        ];

        $input=([
            'name' => $request->get('name'),
            'location' => $request->get('location'),
        ]);


        $validator = \Validator::make($input,$rules,$messages);

        if ($validator->fails()) {
            return redirect('newSetting')
                ->withErrors($messages)
                ->withInput();
        }


        $item = Pharmacy::create([
            'name' => $request->get('name'),
            'location' => $request->get('location'),
        ]);

        $item->save();
        return redirect()->back()
            ->with('message','Successful');



    }
    public function newSetting()
    {


        return view('admin.newSetting');


    }

    public function editIncidence($id)
    {
        $item = Disease_Incidence::findOrFail($id);
        /*$incidence = DB::table('diseases_incidences')->where('id',$item['id'])->first();*/
        $disease = $item['disease'];
        $location = $item['location'];
        $year = $item['year'];
        $month = $item['month'];
        $incidence = $item['incidence'];


        return view('admin.incidencee')
            ->with(['item' => $item, 'disease' => $disease, 'location' => $location, 'year' => $year,'month' => $month,'incidence' => $incidence,]);


    }
    /* $item = $request->all();
           $item->save();*/
    /*$item->fill($input)->save();*/

    public function updateIncidence($id, Request $request)
    {

        $item=Disease_Incidence::find($id);
        $disease = $request->get('disease');
        $location = $request->get('location');
        $year = $request->get('year');
        $month = $request->get('month');
        $incidence = $request->get('incidence');


        DB::table('diseases_incidences')
            ->where('id', $item['id'])
            ->update(array(
                'disease' => $disease,
                'location' =>$location,
                'year' =>$year,
                'month' =>$month,
                'incidence' =>$incidence,

            ));


        return redirect('disease_incidence');
        /*return redirect()->back();*/
    }
    public function addNewIncidence(Request $request)
    {
        $rules = array(
            'location'             => 'required',                        // just a normal required validation
            'disease' => 'required',
            'year' => 'required',
            'month' => 'required',
            'incidence' => 'required',

        );
        $messages = [
            'required' => 'The :attribute field is required.',
            'unique' => 'Duplicate record exists.',

        ];

        $input=([
            'disease' => $request->get('disease'),
            'location' => $request->get('location'),
            'year' => $request->get('year'),
            'month' => $request->get('month'),
            'incidence' => $request->get('incidence'),
        ]);


        $validator = \Validator::make($input,$rules,$messages);

        if ($validator->fails()) {
            return redirect('newIncidence')
                ->withErrors($messages)
                ->withInput();
        }


     /*   $item = Disease_Incidence::create([
            'disease' => $request->get('disease'),
            'location' => $request->get('location'),
            'year' => $request->get('year'),
            'month' => $request->get('month'),
            'incidence' => $request->get('incidence'),
        ]);*/
        DB::table('diseases_incidences')

            ->insert(array(
                'disease' => $request->get('disease'),
                'location' => $request->get('location'),
                'year' => $request->get('year'),
                'month' => $request->get('month'),
                'incidence' => $request->get('incidence'),

            ));

        /*$item->save();*/
        return redirect('admin.disease_incidence')
            ->with('message','Successful');



    }
    public function newIncidence()
    {


        return view('admin.newDisease_incidence');


    }
}


