<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class RegressionController extends Controller
{
    /**
     * linear regression function
     * @param $x array x-coords
     * @param $y array y-coords
     * @returns array() m=>slope, b=>intercept
     */

    public function x (Request $request)
    {
        $drug = $request->get('drug');
        $x = DB::table('stocks')
            ->join('drugs', 'drugs.id', '=', 'stocks.drug_id')
            ->join('diseases_drugs','drugs.id', '=', 'stocks.drug_id' )
            ->join('diseases' )
            ->join('diseases_incidences')
            ->join('weather')
            ->select( 'drugs.name', 'temperature','disease.id','rainfall','incidence')

            ->where('drug', $drug);
        array($x);
        array_push ( $x, 'temperature','rainfall' );


    }
    public function y (Request $request)
    {
        $drug = $request->get('drug');
        $y = DB::table('stocks')
            ->join('drugs', 'drugs.id', '=', 'stocks.drug_id')
            ->join('diseases_drugs','drugs.id', '=', 'stocks.drug_id' )
            ->select('stocks.amount_sold')

            ->where('drug', $drug);

        array_push ( $y, 'incidence' );


    }

    public function x1 (Request $request)
    {
        $drug = $request->get('drug');
        $x1 = DB::table('stocks')
            ->join('drugs', 'drugs.id', '=', 'stocks.drug_id')
            ->join('diseases_drugs', 'drugs.id', '=', 'stocks.drug_id')
            ->join('diseases')
            ->join('diseases_incidences')
            ->join('weather')
            ->select('drugs.name', 'temperature', 'disease.id', 'rainfall', 'incidence')
            ->where('drug', $drug);
        array($x1);
        array_push($x1, 'incidence');
    }

    public function y1 (Request $request)
    {
        $drug = $request->get('drug');
        $y1 = DB::table('stocks')
            ->join('drugs', 'drugs.id', '=', 'stocks.drug_id')
            ->join('diseases_drugs', 'drugs.id', '=', 'stocks.drug_id')
            ->join('diseases')
            ->join('diseases_incidences')
            ->join('weather')
            ->select('drugs.name', 'temperature', 'disease.id', 'rainfall', 'incidence')
            ->where('drug', $drug);
        array($y1);
        array_push($y1, 'amount_sold');
    }


    private $xGegeven = array();
    private $yGegeven = array();
    private $x1Gegeven = array();
    private $y1Gegeven = array();

    public function __construct($x = array(), $y = array(), $x1 = array(), $y1 = array()) {
        $x = $this->xGegeven;
        $y = $this->yGegeven;
        $x1 = $this->x1Gegeven;
        $y1 = $this->y1Gegeven;
        array_push($x, $xGegeven);
        array_push($y, $yGegeven);
        array_push($x1, $x1Gegeven);
        array_push($y1, $y1Gegeven);
    }

    public function NumberOfPoints($x) {
// calculate number points
        $x = $this->xGegeven;
//var_dump($x).’x’;
        $n = count($x);
//var_dump($n). ‘n’;
        return $n;
    }

    public function variableY($y) {
// ensure both arrays of points are the same size
        $y = $this->yGegeven;
        if ($n != count($y)) {
            trigger_error(“linear_regression(): Number of elements in coordinate arrays do not match.”, E_USER_ERROR);
}
    }

    public function xx_Sum($x) {
// calculate sums
        $x = $this->xGegeven;
        $n = $this->NumberOfPoints($this->xGegeven);

        $xx_sum = 0;

        for ($i = 0; $i < $n; $i++) {
            $xx_sum+=($x[$i] * $x[$i]);
            $yy_sum+=($y[$i]*$y[$i]);
        }
// echo 'xx_sum'.$xx_sum.'’;
        return $xx_sum;
    }

    public function xy_Sum($x, $y) {
// calculate sums
        $y = $this->yGegeven;
        $x = $this->xGegeven;
        $n = $this->NumberOfPoints($this->xGegeven);

        $xy_sum = 0;


        for ($i = 0; $i <yGegeven; i++){
            $y_sum = array_sum($y);
            return $y_sum;
        }
    }

    public function x_sum() {
        $x = $this->xGegeven;
        $x_sum = array_sum($x);
        return $x_sum;
    }

    public function calculateM() {
// calculate slope

        $xy_sum = $this->xy_sum($x, $y);
        $x_sum = $this->x_sum();
        $xx_sum = $this->xx_sum($x);
        $y_sum = $this->y_sum();
        $n = $this->NumberOfPoints($this->xGegeven);
        $m = (($n * $xy_sum) – ($x_sum * $y_sum)) / (($n * $xx_sum) – ($x_sum * $x_sum));
return $m;
}

    public function calculateB() {
// calculate intercept

        $x_sum = $this->x_sum();
        $y_sum = $this->y_sum();
        $n = $this->NumberOfPoints($this->xGegeven);
        $m = $this->calculateM();
        $b = ($y_sum – ($m * $x_sum))/ $n;
return $b;
}


}
/*// calculate r

$r = ($xy_sum - ((1/$n)*$x_sum*$y_sum))/

    (sqrt((($xx_sum)-((1/$n)*(pow($x_sum,2))))*(($yy_sum)-((1/$n)*(pow($y_sum,2))))));



$r2 = $r*$r;
}
// calculate number points
$n = count($x);

// ensure both arrays of points are the same size
if ($n != count($y)) {

    trigger_error("linear_regression(): Number of elements in coordinate arrays do not match.", E_USER_ERROR);

}

// calculate sums
$x_sum = array_sum($x);
$y_sum = array_sum($y);

$xx_sum = 0;
$xy_sum = 0;



// calculate slope
$m = (($n * $xy_sum) - ($x_sum * $y_sum)) / (($n * $xx_sum) - ($x_sum * $x_sum));

// calculate intercept
$b = ($y_sum - ($m * $x_sum)) / $n;

// return result
return array("m"=>$m, "b"=>$b);*/
