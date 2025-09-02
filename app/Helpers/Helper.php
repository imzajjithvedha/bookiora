<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

if(!function_exists('send_email')) {
    function send_email($mailable, $emails) {
        if(!is_array($emails)) {
            $emails = explode(", ", trim($emails, "[]"));
        }

        foreach($emails as $email) {
            try {
                Mail::to($email)->queue(clone $mailable);
            }
            catch (\Throwable $e) {
                Log::error("Failed to send email to {$email}: " . $e->getMessage());
                continue;
            }
        }
    }
}