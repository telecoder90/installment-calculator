<?php

namespace App\Http\Controllers;

use App\Contracts\CalculatorInterface;
use App\Http\Requests\CalculatorRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CalculatorController extends Controller implements CalculatorInterface
{
    public function index()
    {
        return view('calculator.index');
    }

    public function calculate(CalculatorRequest $request): JsonResponse
    {
        $monthly_payment = $this->calculateMonthlyPayment(
            $request->object_price,
            $request->started_sum,
            $request->period_monthes
        );

        return response()->json([
            'monthly_payment' => $monthly_payment,
            'message' => 'Monthly payment calculated!'
        ]);
        
    }

    public function calculateMonthlyPayment(int $object_price, int $started_sum, int $period_monthes): int
    {
        $fee = 1;
        switch($period_monthes){
            case 12:
                $fee += 1.03; 
                break;
            case 24:
                $fee += 1.08; 
                break;
            case 36:
                $fee += 1.13; 
                break;
            default:
                break;
        }
        return ceil( ( ($object_price-$started_sum) / $period_monthes ) * $fee );
    }
}
