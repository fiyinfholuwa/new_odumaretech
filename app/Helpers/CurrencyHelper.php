<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Torann\GeoIP\Facades\GeoIP;
use GeoIp2\Database\Reader;


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
if (!function_exists('getUserIPv4')) {
    function getUserIPv4(): string
    {
        // Get the IP from Laravel's request helper
        $ip = request()->ip();

        // Handle localhost cases by using a default IPv4
        if (in_array($ip, ['127.0.0.1', '::1'])) {
            return '102.89.32.1'; // Default to a Nigerian IP for local testing
        }

        // If it's an IPv6 address, try to resolve to IPv4
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            $resolved = gethostbyname($ip);
            if ($resolved !== $ip) {
                return $resolved; // Return resolved IPv4
            }
        }

        // If it's already a valid IPv4, return as is
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            return $ip;
        }

        // Fallback to default IPv4 if all else fails
        return '102.89.32.1';
    }
}



if (!function_exists('getUserCountryCode')) {
    function getUserCountryCode($ip = null): ?string
    {
        $ip = $ip ?? request()->ip();

        if (app()->environment('local') && in_array($ip, ['127.0.0.1', '::1'])) {
            $ip = '102.89.32.1'; // Test Nigeria IP
        }

        try {

            $reader = new Reader(storage_path('app/geoip/GeoLite2-Country.mmdb'));
            $record = $reader->country($ip);
            return $record->country->isoCode; // e.g. "NG"
        } catch (\Exception $e) {
            dd($e->getMessage());
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


if (!function_exists('getAllCountries')) {
    function getAllCountries(): array
    {
        return [
            "Afghanistan","Albania","Algeria","Andorra","Angola","Argentina","Armenia",
            "Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados",
            "Belgium","Belize","Benin","Bhutan","Bolivia","Bosnia and Herzegovina","Botswana",
            "Brazil","Brunei","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Canada",
            "Cape Verde","Central African Republic","Chad","Chile","China","Colombia","Comoros",
            "Congo","Costa Rica","Croatia","Cuba","Cyprus","Czech Republic","Denmark","Djibouti",
            "Dominica","Dominican Republic","Ecuador","Egypt","El Salvador","Equatorial Guinea",
            "Eritrea","Estonia","Eswatini","Ethiopia","Fiji","Finland","France","Gabon","Gambia",
            "Georgia","Germany","Ghana","Greece","Grenada","Guatemala","Guinea","Guinea-Bissau",
            "Guyana","Haiti","Honduras","Hungary","Iceland","India","Indonesia","Iran","Iraq",
            "Ireland","Israel","Italy","Jamaica","Japan","Jordan","Kazakhstan","Kenya","Kiribati",
            "Kuwait","Kyrgyzstan","Laos","Latvia","Lebanon","Lesotho","Liberia","Libya",
            "Liechtenstein","Lithuania","Luxembourg","Madagascar","Malawi","Malaysia","Maldives",
            "Mali","Malta","Marshall Islands","Mauritania","Mauritius","Mexico","Micronesia",
            "Moldova","Monaco","Mongolia","Montenegro","Morocco","Mozambique","Myanmar","Namibia",
            "Nauru","Nepal","Netherlands","New Zealand","Nicaragua","Niger","Nigeria","North Korea",
            "North Macedonia","Norway","Oman","Pakistan","Palau","Panama","Papua New Guinea",
            "Paraguay","Peru","Philippines","Poland","Portugal","Qatar","Romania","Russia",
            "Rwanda","Saint Kitts and Nevis","Saint Lucia","Saint Vincent","Samoa","San Marino",
            "Sao Tome","Saudi Arabia","Senegal","Serbia","Seychelles","Sierra Leone","Singapore",
            "Slovakia","Slovenia","Solomon Islands","Somalia","South Africa","South Korea",
            "South Sudan","Spain","Sri Lanka","Sudan","Suriname","Sweden","Switzerland","Syria",
            "Taiwan","Tajikistan","Tanzania","Thailand","Togo","Tonga","Trinidad and Tobago",
            "Tunisia","Turkey","Turkmenistan","Tuvalu","Uganda","Ukraine","United Arab Emirates",
            "United Kingdom","United States","Uruguay","Uzbekistan","Vanuatu","Vatican City",
            "Venezuela","Vietnam","Yemen","Zambia","Zimbabwe"
        ];
    }
}
