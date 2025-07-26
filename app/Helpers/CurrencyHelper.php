<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use GeoIP;

if (!function_exists('getConvertedAfricanCurrencies')) {
    function getConvertedAfricanCurrencies($amount = 10): array
    {
        return Cache::remember("african_currency_rates_{$amount}", 3600000, function () use ($amount) {
            $apiKey = 'cur_live_oroOPVDi7o5XANtqGKtJPvVtBwYQulHgvyYVSjCk';
            $baseUrl = 'https://api.currencyapi.com/v3/latest';

            $currencies = ['NGN', 'GHS', 'KES', 'ZAR', 'TZS', 'UGX', 'RWF', 'XAF', 'XOF', 'MWK'];

            $response = Http::get($baseUrl, [
                'apikey' => $apiKey,
                'base_currency' => 'USD',
                'currencies' => implode(',', $currencies),
            ]);

            if ($response->failed() || !$response->json('data')) {
                return ['error' => 'Failed to fetch exchange rates.'];
            }

            $data = $response->json('data');
            $converted = [];

            foreach ($currencies as $currency) {
                if (isset($data[$currency])) {
                    $converted[$currency] = round($data[$currency]['value'] * $amount, 2);
                }
            }

            return $converted;
        });
    }
}

if (!function_exists('getUserCountryCode')) {
    function getUserCountryCode($ip = null): ?string
    {
        $ip = $ip ?? request()->header('X-Forwarded-For') ?? request()->ip();

        if (app()->environment('local') && ($ip === '127.0.0.1' || $ip === '::1')) {
            $ip = '102.89.32.1'; // Default Nigerian IP for local testing
        }

        try {
            $location = geoip()->getLocation($ip);
            return $location->iso_code ?? null; // Returns e.g., "NG", "GH", etc.
        } catch (\Exception $e) {
            return null;
        }
    }
}


if (!function_exists('getUserLocalCurrencyConversion')) {
    function getUserLocalCurrencyConversion($amount = 10, $currencyCodeOverride = null): array
    {
        // Ensure amount is numeric
        $amount = is_numeric($amount) ? floatval($amount) : 0;

        // Country-to-currency map
        $countryToCurrency = [
            'NG' => ['code' => 'NGN', 'symbol' => '₦'],
            'GH' => ['code' => 'GHS', 'symbol' => '₵'],
            'KE' => ['code' => 'KES', 'symbol' => 'KSh'],
            'ZA' => ['code' => 'ZAR', 'symbol' => 'R'],
            'TZ' => ['code' => 'TZS', 'symbol' => 'TSh'],
            'UG' => ['code' => 'UGX', 'symbol' => 'USh'],
            'RW' => ['code' => 'RWF', 'symbol' => 'FRw'],
            'CM' => ['code' => 'XAF', 'symbol' => 'FCFA'],
            'GA' => ['code' => 'XAF', 'symbol' => 'FCFA'],
            'TD' => ['code' => 'XAF', 'symbol' => 'FCFA'],
            'CI' => ['code' => 'XOF', 'symbol' => 'CFA'],
            'BF' => ['code' => 'XOF', 'symbol' => 'CFA'],
            'SN' => ['code' => 'XOF', 'symbol' => 'CFA'],
            'BJ' => ['code' => 'XOF', 'symbol' => 'CFA'],
            'NE' => ['code' => 'XOF', 'symbol' => 'CFA'],
            'ML' => ['code' => 'XOF', 'symbol' => 'CFA'],
            'TG' => ['code' => 'XOF', 'symbol' => 'CFA'],
            'MW' => ['code' => 'MWK', 'symbol' => 'MK'],
        ];

        $currencyCode = strtoupper(trim($currencyCodeOverride ?? ''));
        $currencySymbol = null;
        $countryCodeOut = null;

        // Validate override or fall back to user's country
        $validCurrencyCodes = array_column($countryToCurrency, 'code');

        if (!$currencyCode || !in_array($currencyCode, $validCurrencyCodes)) {
            $userCountry = getUserCountryCode();
            if (!$userCountry || !isset($countryToCurrency[$userCountry])) {
                return [
                    'country_code' => null,
                    'currency_code' => 'USD',
                    'currency_symbol' => '$',
                    'converted_amount' => round($amount, 2),
                    'is_estimate' => true
                ];
            }

            $currencyData = $countryToCurrency[$userCountry];
            $currencyCode = $currencyData['code'];
            $currencySymbol = $currencyData['symbol'];
            $countryCodeOut = $userCountry;
        } else {
            foreach ($countryToCurrency as $country => $data) {
                if ($data['code'] === $currencyCode) {
                    $currencySymbol = $data['symbol'];
                    break;
                }
            }

            // Fallback if symbol not found
            if (!$currencySymbol) {
                $currencySymbol = '$';
            }
        }

        // Get conversion rates (from USD)
        $allRates = getConvertedAfricanCurrencies($amount);
        $convertedAmount = isset($allRates[$currencyCode])
            ? $allRates[$currencyCode]
            : round($amount, 2);

        return [
            'country_code' => $countryCodeOut,
            'currency_code' => $currencyCode,
            'currency_symbol' => $currencySymbol,
            'converted_amount' => $convertedAmount,
            'is_estimate' => !isset($allRates[$currencyCode])
        ];
    }
}
