<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MultiplicationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function multiply(Request $request): object
    {
        $a = $request->a;
        $b = $request->b;
        $m=count($a);
        $n=count($a[0]);
        $p=count($b);
        $q=count($b[0]);
        $result=array();
        if($n != $p){
            return response()->json([
                'status' => 'fail',
                'data' => null,
                ]);
        }
        for ($i=0; $i < $m; $i++) {
            for($j=0; $j < $q; $j++){
                $result[$i][$j] = 0;
                $res = 0;
                for($k=0; $k < $n; $k++){
                    $res += $a[$i][$k] * $b[$k][$j];
                }
                $result[$i][$j] = $this->getCharFromNumber($res);
            }
        }
        return response()->json([
            'status' => 'success',
            'data' => $result,
        ]);
    }
    private function getCharFromNumber(int $num): string
    {
        $numeric = ($num - 1) % 26;
        $letter = chr(65 + $numeric);
        $num2 = intval(($num - 1) / 26);
        if ($num2 > 0) {
            return getCharFromNumber($num2) . $letter;
        } else {
            return $letter;
        }
    }
}
