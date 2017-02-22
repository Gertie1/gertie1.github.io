<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Disease_Incidence;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Input;
use App\Disease;


use App\Http\Requests;

class Disease_IncidenceController extends Controller
{
    public function disease_incidence(Request $request){
        $data = DB::table('diseases_incidences')
            ->join('diseases', 'diseases.id', '=', 'diseases_incidences.disease_id')
            ->select('diseases_incidences.*', 'diseases.name')
            ->simplePaginate(10);

        return view('admin.disease_incidence', ['data' => $data]);
    }

    public function newIncidence()
    {
        $diseases = Disease::all();
        return view('admin.newDisease_incidence')
            ->with('diseases', $diseases);
    }

    public function addNewIncidence(Request $request){
        $data = DB::table('diseases_incidences')
            ->join('diseases', 'diseases.id', '=', 'diseases_incidences.disease_id')
            ->select('diseases_incidences.*', 'diseases.name')
            ->simplePaginate(10);

        $rules = array(
            'disease_id' => 'required',
            'incidence' => 'required',
            'date' => 'required',
        );
        $messages = [
            'required' => 'The :attribute field is required.',
                 ];

        $success = 'Added successfully';

        $input=([
            'disease_id' => $request->get('disease'),
            'incidence' => $request->get('incidence'),
            'date' => $request->get('date'),
        ]);


        $validator = \Validator::make($input,$rules,$messages);

        if ($validator->fails()) {
            return redirect('newIncidence')
                ->withErrors($messages)
                ->withInput();
        }

        $item = Disease_Incidence::create([
            'disease_id' => $request->get('disease'),
            'incidence' => $request->get('incidence'),
            'date' => $request->get('date'),
        ]);

        $item->save();

        /*DB::table('diseases_incidences')

            ->insert(array(
                'disease' => $request->get('disease'),
                'date' => $request->get('date'),
                'incidence' => $request->get('incidence'),

            ));*/
        return view('admin.disease_incidence')
            ->with('data',$data);

       /* \Session::flash('flash_message','Stock successfully added.');*/
    }




    public function getIncidenceUpdate($id){
        $item = Disease_Incidence::findOrFail($id);
        $disease = DB::table('diseases')->where('id',$item['disease_id'])->first();
        $incidence = $item['incidence'];
        $date = $item['date'];

        return view('admin.incidencee')

            ->with(['item' => $item, 'disease' => $disease, 'incidence' => $incidence,'date' => $date ]);


    }
    public function newIncidenceUpdate($id, Request $request)
    {
        $item=Disease_Incidence::find($id);

        $disease = $request->get('disease');
        $incidence = $request->get('incidence');
        $date= $request->get('date');

        DB::table('diseases_incidences')
            ->where('id', $item['id'])
            ->update(array(
                'disease_id' => $disease,
                'incidence' =>$incidence,
                'date' => $date,

                /* 'amount_remaining' =>($amount_received)-($amount_sold)*/

            ));

        return redirect()->back();

    }

    public function deleteIncidence(Request $request)
    {
        if($request->ajax())
        {
            Disease_Incidence::destroy($request->id);
            return Response()->json(['sms'=>'Successfully deleted']);

        }

    }

    public function searchIncidence(Request $request)
    {
        if($request->ajax())
        {
            $output="";
            $data=DB::table('diseases_incidences')->where('name','LIKE','%'.$request->search.'%')->get();

            if($data){
                foreach ($data as $key => $item){
                    $output.='<tr>'.
                        '<td>'. $item->id.'</td>'.
                        '<td>'. $item->disease.'</td>'.
                        '<td>'. $item->date.'</td>'.
                        '<td>'. $item->incidence.'</td>'.
                        '<td><button class="edit-modal btn btn-info btn-edit" data-id="'.$item->id.'">Edit</button>
                             <button class="delete-modal btn btn-danger btn-delete" data-id="'.$item->id.'">Delete</button></td>'.

                        '</tr>';
                }
                return response($output);

            }




        }
    }

}
