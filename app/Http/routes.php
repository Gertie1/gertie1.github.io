<?php

use App\Http\Requests;


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('login',function (){
    return view('auth.login');
});
Route::get('register',function (){
    return view('auth.register');
});
/*Route::get('login', array('as'=>'login','uses'=>'Auth\AuthController@getLogin'));*/
Route::post('login', array('as'=>'login','uses'=>'Auth\AuthController@postLogin'));
//Route::get('auth/logout', array('as'=>'logout','uses'=>'Auth\AuthController@getLogout'));

/*Route::get('register', array('as'=>'register','uses'=>'Auth\AuthController@getRegister') );*/
Route::post('register', array('as'=>'register','uses'=>'Auth\AuthController@postRegister'));

Route::group(['middleware'=>'auth'],function (){
    Route::get('/welcome',array('as'=>'welcome','uses'=>'AdminController@welcome'));
    Route::get('/welcome2',array('as'=>'welcome2','uses'=>'AdminController@welcome2'));
    Route::get('/settings',array('as'=>'settings','uses'=>'AdminController@settings'));
    Route::get('/home',array('as'=>'home','uses'=>'AdminController@home'));
    Route::get('/logout', array('as'=>'logout','uses'=>'Auth\AuthController@logout'));
    Route::get('/grid',array('as'=>'grid','uses'=>'AdminController@grid'));
    Route::get('/buttons',array('as'=>'buttons','uses'=>'AdminController@buttons'));
    Route::get('/users',array('as'=>'users','uses'=>'AdminController@users'));
    Route::post('/users',array('as'=>'users','uses'=>'AdminController@users'));
    Route::get('/newUser',array('as'=>'newUser','uses'=>'AdminController@newUser'));
    Route::post('/newUser',array('as'=>'newUser','uses'=>'Auth\AuthController@newUser'));
    Route::get('/getUpdate',array('as'=>'getUpdate','uses'=>'AdminController@getUpdate'));
    Route::put('/newUpdate',array('as'=>'newUpdate','uses'=>'AdminController@newUpdate'));
    Route::post('/deleteUser',array('as'=>'deleteUser','uses'=>'AdminController@newUser'));

    Route::get('/drugs',array('as'=>'drugs','uses'=>'DrugController@drugs'));
    Route::post('/newDrug',array('as'=>'newDrug','uses'=>'DrugController@newDrug'));
    Route::get('/getDrugUpdate',array('as'=>'getDrugUpdate','uses'=>'DrugController@getDrugUpdate'));
    Route::put('/newDrug',array('as'=>'newDrugUpdate','uses'=>'DrugController@newDrugUpdate'));
    Route::post('/deleteDrug',array('as'=>'deleteDrug','uses'=>'DrugController@deleteDrug'));
    Route::get('/searchDrug',array('as'=>'searchDrug','uses'=>'DrugController@searchDrug'));

    Route::get('/diseases',array('as'=>'diseases','uses'=>'DiseaseController@diseases'));
    Route::post('/newDisease',array('as'=>'newDisease','uses'=>'DiseaseController@newDisease'));
    Route::get('/getDiseaseUpdate',array('as'=>'getDiseaseUpdate','uses'=>'DiseaseController@getDiseaseUpdate'));
    Route::put('/newDisease',array('as'=>'newDiseaseUpdate','uses'=>'DiseaseController@newDiseaseUpdate'));
    Route::post('/deleteDisease',array('as'=>'deleteDisease','uses'=>'DiseaseController@deleteDisease'));
    Route::get('/searchDisease',array('as'=>'searchDisease','uses'=>'DiseaseController@searchDisease'));

    Route::get('/charts',array('as'=>'charts','uses'=>'PredictionController@highcharts'));

    Route::get('/form2',array('as'=>'form2','uses'=>'Disease_DrugController@form'));
    Route::post('/mapping',array('as'=>'mapping','uses'=>'Disease_DrugController@mapping'));
    Route::get('/display',array('as'=>'display','uses'=>'DisplayController@display'));
   // Route::get('/getDisplayUpdate',array('as'=>'getDisplayUpdate','uses'=>'DisplayController@getDisplayUpdate'));

    Route::get('/editMapping{id}',array('as'=>'editMapping','uses'=>'DisplayController@editMapping'));
    Route::patch('/updateMapping{id}',array('as'=>'updateMapping','uses'=>'DisplayController@updateMapping'));

    Route::get('/stock',array('as'=>'stock','uses'=>'StockController@stocks'));
    Route::get('/stockr',array('as'=>'stockr','uses'=>'StockController@newStock'));
    Route::post('/newStock',array('as'=>'newStock','uses'=>'StockController@addNewStock'));
    Route::post('/deleteStock',array('as'=>'deleteStock','uses'=>'StockController@deleteStock'));
    Route::get('/editStock{id}',array('as'=>'editStock','uses'=>'StockController@editStock'));
    Route::patch('/updateStock{id}',array('as'=>'updateStock','uses'=>'StockController@updateStock'));

    Route::get('/sales',array('as'=>'sales','uses'=>'SalesController@stocks'));
    Route::get('/salesr',array('as'=>'salesr','uses'=>'SalesController@newStock'));
    Route::post('/newSale',array('as'=>'newSale','uses'=>'SalesController@addNewStock'));
    Route::post('/deleteSale',array('as'=>'deleteSale','uses'=>'SalesController@deleteStock'));
    Route::get('/editSale{id}',array('as'=>'editSale','uses'=>'SalesController@editStock'));
    Route::patch('/updateSale{id}',array('as'=>'updateSale','uses'=>'SalesController@updateStock'));

    Route::get('/blank',array('as'=>'blank','uses'=>'ChartController@display'));
    Route::post('/blank2',array('as'=>'blank2','uses'=>'ChartController@highcharts'));

    Route::get('/often',array('as'=>'often','uses'=>'StockController@often'));
    Route::post('/often',array('as'=>'often','uses'=>'StockController@often'));
    Route::get('/none',array('as'=>'none','uses'=>'StockController@none'));
    Route::post('/none',array('as'=>'none','uses'=>'StockController@none'));
    Route::get('/rarely',array('as'=>'rarely','uses'=>'StockController@rarely'));
    Route::post('/rarely',array('as'=>'rarely','uses'=>'StockController@rarely'));
    Route::get('/minimum',array('as'=>'minimum','uses'=>'StockController@minimum'));
    Route::post('/minimum',array('as'=>'minimum','uses'=>'StockController@minimum'));
    /*Route::post('/likely',array('as'=>'likely','uses'=>'StockController@display1'));
    Route::get('/likely2',array('as'=>'likely2','uses'=>'StockController@display'));*/
    /*Route::post('/likely2',array('as'=>'likely2','uses'=>'StockController@display'));*/
    Route::get('/likely',array('as'=>'likely','uses'=>'SalesController@likely'));
    Route::post('/likely',array('as'=>'likely','uses'=>'SalesController@likely'));
    Route::get('/unlikely',array('as'=>'unlikely','uses'=>'DisplayController@display'));
    Route::get('/viewMapping{id}',array('as'=>'viewMapping','uses'=>'DisplayController@viewMapping'));
    Route::get('/likely2',array('as'=>'likely2','uses'=>'SalesController@likely2'));


   Route::get('/trial',array('as'=>'trial','uses'=>'HavenController@init'));
   Route::get('/admin',array('as'=>'admin','uses'=>'AdminController@admin'));
    Route::get('/locations',array('as'=>'locations','uses'=>'AdminController@locations'));

    Route::get('/incidence',array('as'=>'incidence','uses'=>'Disease_IncidenceController@disease_incidence'));
    Route::get('/newIncidence',array('as'=>'newIncidence','uses'=>'Disease_IncidenceController@newIncidence'));
    Route::post('/newIncidence',array('as'=>'newIncidence','uses'=>'Disease_IncidenceController@addNewIncidence'));
    Route::post('/deleteIncidence',array('as'=>'deleteIncidence','uses'=>'Disease_IncidenceController@deleteIncidence'));
    Route::get('/editIncidence{id}',array('as'=>'editIncidence','uses'=>'Disease_IncidenceController@getIncidenceUpdate'));
    Route::patch('/updateIncidence{id}',array('as'=>'updateIncidence','uses'=>'Disease_IncidenceController@newIncidenceUpdate'));



    Route::get('/newSetting',array('as'=>'newSetting','uses'=>'AdminController@newSetting'));
    Route::post('/newSetting',array('as'=>'newSetting','uses'=>'AdminController@addNewSetting'));
    /*Route::post('/deleteStock',array('as'=>'deleteStock','uses'=>'StockController@deleteStock'));*/
    Route::get('/editSetting{id}',array('as'=>'editSetting','uses'=>'AdminController@editSetting'));
    Route::patch('/updateSetting{id}',array('as'=>'updateSetting','uses'=>'AdminController@updateSetting'));


    Route::get('/inventory',array('as'=>'inventory','uses'=>'InventoryController@stocks'));


    Route::get('/weather',array('as'=>'weather','uses'=>'WeatherController@weather'));
    Route::get('/newWeather',array('as'=>'newWeather','uses'=>'WeatherController@newWeather'));
    Route::post('/newWeather',array('as'=>'newWeather','uses'=>'WeatherController@addNewWeather'));
    Route::post('/deleteWeather',array('as'=>'deleteWeather','uses'=>'WeatherController@deleteWeather'));
    Route::get('/editWeather{id}',array('as'=>'editWeather','uses'=>'WeatherController@editWeather'));
    Route::patch('/updateWeather{id}',array('as'=>'updateWeather','uses'=>'WeatherController@updateWeather'));

    Route::get('/track',array('as'=>'track','uses'=>'StockController@track'));
    Route::post('/track',array('as'=>'track','uses'=>'StockController@report'));
});

