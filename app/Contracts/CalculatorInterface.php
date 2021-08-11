<?php

declare(strict_types=1);

namespace App\Contracts;

use App\Http\Requests\CalculatorRequest;
use Illuminate\Http\JsonResponse;

interface CalculatorInterface
{
    /** 
     * @param CalculatorRequest $request
     * 
     * @return JsonResponse 
    */
    public function calculate(CalculatorRequest $request): JsonResponse;

    /** 
     * @param int $object_price
     * @param int $started_sum
     * @param int $period_monthes
     * 
     * @return JsonResponse 
    */
    public function calculateMonthlyPayment(int $object_price, int $started_sum, int $period_monthes): int;
}
