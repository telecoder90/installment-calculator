<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\InquiryService;
use Illuminate\Http\JsonResponse;

class InquiryController extends Controller
{
    /**
     * sendInquiry - method save client inquiry into DB
     * 
     * @param Request $request
     * @return JsonResponse
    */
    public function sendInquiry(Request $request): JsonResponse
    {
        $service = resolve(InquiryService::class);
        $service->handle($request->email);

        return response()->json(
            [
                'success' => true, 
                'message' => 'Thank you for the inquiry! We will contact with you as soon as possible :)'
            ]
        );
    }
}
