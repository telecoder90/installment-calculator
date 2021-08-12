<?php

namespace Tests\Feature;

use App\Services\InquiryService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery;
use Tests\TestCase;

class InquiryTest extends TestCase
{ 
    /**
     * Inquiry test
     *
     * @return void
     */
    public function testInquiryMetodIsReturnSuccess()
    {
        /**
         * Creating the mock of the service class and set its the expectation
        */
        $this->instance(InquiryService::class, Mockery::mock(InquiryService::class, function ($mock) {
            $mock->shouldReceive('handle')
                ->once()
                ->withArgs(['clienttestmail@xtesthostx.com'])
                ->andReturnNull();
        }));

        $this->postJson('/inquiry', [
            'email' => 'clienttestmail@xtesthostx.com'
        ])->assertExactJson([
            'success' => true, 
            'message' => 'Thank you for the inquiry! We will contact with you as soon as possible :)'
        ]);
    }
}
