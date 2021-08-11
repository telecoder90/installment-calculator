<?php

namespace Tests\Unit;

use App\Http\Controllers\CalculatorController;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    /**
     * @return void
     * 
     * @dataProvider testCalculatorForTwelveMonthesProvider
     */
    public function testCalculatorForTwelveMonthes($expected_monthly_amount, $object_price, $started_sum, $period_monthes)
    {
        $this->assertEquals($expected_monthly_amount, (new CalculatorController())->calculateMonthlyPayment(
            $object_price, 
            $started_sum, 
            $period_monthes
        ));
    }

    public function testCalculatorForTwelveMonthesProvider(){
        return [
            [118417, 1000000, 300000, 12],
            [101501, 1000000, 400000, 12]
        ];
    }

    /**
     * @return void
     * 
     * @dataProvider testCalculatorForTwentyFourMonthesProvider
     */
    public function testCalculatorForTwentyFourMonthes($expected_monthly_amount, $object_price, $started_sum, $period_monthes)
    {
        $this->assertEquals($expected_monthly_amount, (new CalculatorController())->calculateMonthlyPayment(
            $object_price, 
            $started_sum, 
            $period_monthes
        ));
    }

    public function testCalculatorForTwentyFourMonthesProvider(){
        return [
            [60667, 1000000, 300000, 24],
            [52000, 1000000, 400000, 24]
        ];
    }

    /**
     * @return void
     * 
     * @dataProvider testCalculatorForThirtySixMonthesProvider
     */
    public function testCalculatorForThirtySixMonthes($expected_monthly_amount, $object_price, $started_sum, $period_monthes)
    {
        $this->assertEquals($expected_monthly_amount, (new CalculatorController())->calculateMonthlyPayment(
            $object_price, 
            $started_sum, 
            $period_monthes
        ));
    }

    public function testCalculatorForThirtySixMonthesProvider(){
        return [
            [41417, 1000000, 300000, 36],
            [35500, 1000000, 400000, 36]
        ];
    }
}
