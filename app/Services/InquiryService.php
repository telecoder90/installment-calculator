<?php

declare(strict_types=1);

namespace App\Services;

use App\Inquiry;

class InquiryService
{
    public function handle(string $email): void
    {
        Inquiry::create([
            'email' => $email
        ]);
    }
}
