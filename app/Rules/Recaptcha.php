<?php

namespace App\Rules;

use Closure;
use Throwable;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;

class Recaptcha implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (config('app.env') !== 'testing') {
            $data = [
                'secret' => config('services.google.recaptcha.secret_key'),
                'response' => $value,
                'remoteip' => request()->ip(),
            ];

            $score = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', $data)['score'] ?? 0;

            if (empty($score) || $score < config('services.google.recaptcha.threshold')) {
                $fail("The recaptcha response was invalid. Please try again.");
            }
        }
    }
}
