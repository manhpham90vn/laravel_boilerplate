<?php

namespace App\Helpers;
use Log;

class Helper
{
    public function Debug(string $message, array $context = [])
    {
        Log::debug($message, $context);
    }

    public function Error(string $message, array $context = [])
    {
        Log::error($message, $context);
    }
}

