<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Weather;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Input;
use App\Disease;

class WeatherController extends Controller
{
    public function weather(Request $request){

        $weathers = DB::table('weather')
            ->select('weather.*')
            ->simplePaginate(10);
        return view('admin.weather', ['weathers' => $weathers]);

    }

    public function deleteWeather(Request $request)
    {
        if($request->ajax())
        {
            Weather::destroy($request->id);
            return Response()->json(['sms'=>'Successfully deleted']);

        }
    }

    public function newWeather()
    {
        return view('admin.newWeather');
    }

    public function addNewWeather(Request $request)
    {
        $weathers = DB::table('weather')
            ->select('weather.*')
            ->simplePaginate(10);
        $rules = array(
            'rainfall'             => 'required',                        // just a normal required validation
            'max_temp' => 'required',
            'year' => 'required',
            'month' => 'required',

        );
        $messages = [
            'required' => 'The :attribute field is required.',

        ];
        $input=([
            'rainfall' => $request->get('rainfall'),
            'max_temp' => $request->get('max_temp'),
            'year' => $request->get('year'),
            'month' => $request->get('month'),

        ]);

        $validator = \Validator::make($input,$rules,$messages);

        if ($validator->fails()) {
            return redirect('newWeather')
                ->withErrors($messages)
                ->withInput();
        }
        $item = Weather::create([
            'rainfall' => $request->get('rainfall'),
            'max_temp' => $request->get('max_temp'),
            'year' => $request->get('year'),
            'month' => $request->get('month'),
        ]);

        $item->save();
        return view('admin.weather')
            ->with('weathers',$weathers);


    }

    public function editWeather($id)
    {
        $item = Weather::findOrFail($id);

        $rainfall = $item['rainfall'];
        $max_temp = $item['max_temp'];
        $year = $item['year'];
        $month = $item['month'];

        return view('admin.weathere')
            ->with(['item' => $item, 'rainfall' => $rainfall, 'max_temp' => $max_temp,'year' => $year,'month' => $month, ]);


    }

    public function updateWeather($id, Request $request)
    {

        $item=Weather::find($id);
        $rainfall = $request->get('rainfall');
        $max_temp = $request->get('max_temp');
        $month = $request->get('month');
        $year = $request->get('year');

        DB::table('weather')
            ->where('id', $item['id'])
            ->update(array(
                'rainfall' => $rainfall,
                'max_temp' =>$max_temp,
                'month' => $month,
                'year' =>$year,

            ));

        return redirect('weather');
    }


}
