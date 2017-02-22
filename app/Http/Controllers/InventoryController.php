<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{
    public function stocks()
    {
        $stocks = DB::table('inventories')

            ->join('sales', 'sales.drug_id', '=', 'inventories.drug_id')
            ->select('inventories.*')

            ->simplePaginate(10);

        return view('admin.inventory')
            ->with('stocks', $stocks);

    }

    public function stock()
    {
        $incoming = DB::table('receives')->select('quantity_received');
        $outgoing = DB::table('sales')->select('quantity_sold');

        dd($incoming);

        /*$amount_remaining = ($incoming)-($outgoing);


        dd($amount_remaining);*/
    }
}
