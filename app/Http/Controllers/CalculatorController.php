<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Contracts\CalculatorInterface;
use App\Http\Requests\CalculatorRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CalculatorController extends Controller implements CalculatorInterface
{

    private const DEFAULT_FEE_VALUE = 1;
    private const FEE_FOR_12_MONTHS = 1.03;
    private const FEE_FOR_24_MONTHS = 1.08;
    private const FEE_FOR_36_MONTHS = 1.13;

    public function index()
    {
        return view('calculator.index');
    }

    public function calculate(CalculatorRequest $request): JsonResponse
    {
        $monthly_payment = $this->calculateMonthlyPayment(
            (int) $request->object_price,
            (int) $request->started_sum,
            (int) $request->period_monthes
        );

        return response()->json([
            'monthly_payment' => $monthly_payment,
            'message' => 'Monthly payment calculated!'
        ]);
        
    }

    public function calculateMonthlyPayment(int $object_price, int $started_sum, int $period_monthes): int
    {
        $fee = self::DEFAULT_FEE_VALUE;
        switch ($period_monthes) {
            case 12:
                $fee = self::FEE_FOR_12_MONTHS; 
                break;
            case 24:
                $fee = self::FEE_FOR_24_MONTHS; 
                break;
            case 36:
                $fee = self::FEE_FOR_36_MONTHS; 
                break;
            default:
                break;
        }
        return (int) ceil((($object_price-$started_sum)/$period_monthes)*$fee);
    }
}
