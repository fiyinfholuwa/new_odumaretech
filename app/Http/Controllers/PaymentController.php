<?php

namespace App\Http\Controllers;

use App\Models\AppliedCourse;
use App\Models\CohortCourse;
use App\Models\Course;
use App\Models\DollarRate;
use App\Models\Payment;
use App\Models\ReferralBonusHistory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;



class PaymentController extends Controller
{
    private $paypal_base_url = "https://api.sandbox.paypal.com";

    

    public static function   getConvertedAfricanCurrencies(): array
{
    return Cache::remember('african_currency_rates', 3600, function () {
        $apiKey = 'cur_live_oroOPVDi7o5XANtqGKtJPvVtBwYQulHgvyYVSjCk';
        $baseUrl = 'https://api.currencyapi.com/v3/latest';
        $amount = 10; // USD

        $currencies = [
            'NGN', 'GHS', 'KES', 'ZAR', 'TZS',
            'UGX', 'RWF', 'XAF', 'XOF', 'MWK',
        ];

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

    public function makePayment(Request $request)
{
    $request->validate([
        'amount' => 'required|numeric',
        'currency' => 'nullable|string',
    ]);

    $referenceId = "OdumareTech" . rand(100000, 999999);

    
    $amount=  $request->amount;
    $currency= $request->currency;
    $amount = $request->payment_type === "installment"
        ? intval(0.4 * $amount)
        : intval($amount);

    
    $check_if_attempt_made = Payment::where('user_email', $request->user_email)
        ->where('course_id', $request->course_id)
        ->first();

    $paymentData = [
        'referenceId' => $referenceId,
        'amount' => $amount,
        'cohort_id' => $request->cohort_id,
        'user_email' => $request->user_email,
        'currency' => $currency,
        'status' => "pending",
        'admission_status' => "pending",
        'course_id' => $request->course_id,
        'payment_type' => $request->payment_type,
    ];

    // ✅ Handle Bank Transfer
    if ($request->payment === 'bank_transfer') {
        $bank_info = [
            'amount_sent' => $request->amount_sent,
            'bank_name' => $request->bank_name,
            'account_name' => $request->account_name,
        ];

        Payment::create(array_merge($paymentData, [
            'payment' => "bank transfer",
            'bank_info' => json_encode($bank_info),
        ]));

        return back()->with([
            'message' => 'Your bank transfer request has been received.',
            'alert-type' => 'success'
        ]);
    }

    // ✅ Handle Paystack
    // if ($request->payment === 'paystack') {
    //     $paystackCurrencies = ['NGN', 'GHS', 'ZAR'];

    //     if (in_array($userCurrency, $paystackCurrencies)) {
    //         $formData = [
    //             'email' => $request->user_email,
    //             'amount' => $convertedAmount * 100,
    //             'currency' => $userCurrency,
    //             'metadata' => ['referenceId' => $referenceId],
    //             'callback_url' => route('pay.callback.paystack'),
    //         ];

    //         $pay = json_decode($this->initializePaymentPaystack($formData));

    //         if ($pay && $pay->status) {
    //             $data = array_merge($paymentData, ['payment' => 'paystack']);

    //             if (!$check_if_attempt_made) {
    //                 Payment::create($data);
    //             } else {
    //                 Payment::where('course_id', $request->course_id)
    //                     ->where('user_email', $request->user_email)
    //                     ->update($data);
    //             }

    //             return redirect($pay->data->authorization_url);
    //         }

    //         return back()->with([
    //             'message' => 'Paystack error. Try again later.',
    //             'alert-type' => 'error'
    //         ]);
    //     }
    // }


    if ($request->payment === 'flutterwave') {
        
        if (!$check_if_attempt_made) {
            Payment::create(array_merge($paymentData, ['payment' => 'flutterwave']));
        } else {
            Payment::where('course_id', $request->course_id)
                ->where('user_email', $request->user_email)
                ->update(array_merge($paymentData, ['payment' => 'flutterwave']));
        }
    
        return redirect($this->create_payment_flutterwave(
            $amount,
            $currency,
            route('flutterwave.success'),
            route('flutterwave.failed'),
            $referenceId,
            Auth::user()->email
        ));
    }
    

    // ✅ Handle PayPal
    // if ($request->payment === 'paypal') {
    //     if (!$check_if_attempt_made) {
    //         Payment::create(array_merge($paymentData, ['payment' => 'paypal']));
    //     } else {
    //         Payment::where('course_id', $request->course_id)
    //             ->where('user_email', $request->user_email)
    //             ->update(array_merge($paymentData, ['payment' => 'paypal']));
    //     }

    //     return redirect($this->create_payment_paypal(
    //         $request->amount,
    //         "NGN",
    //         route('paypal.success'),
    //         route('paypal.failed'),
    //         $referenceId,
    //         Auth::user()->email
    //     ));
    // }

    // ✅ Handle Stripe
    // if ($request->payment_type === 'stripe') {
    //     $checkoutUrl = $this->generateCheckoutUrlStripe($usdAmount * 100, 'usd', $request->user_email, $referenceId);

    //     if ($checkoutUrl) {
    //         if (!$check_if_attempt_made) {
    //             Payment::create(array_merge($paymentData, ['payment' => 'stripe']));
    //         } else {
    //             Payment::where('course_id', $request->course_id)
    //                 ->where('user_email', $request->user_email)
    //                 ->update(array_merge($paymentData, ['payment' => 'stripe']));
    //         }

    //         return redirect($checkoutUrl);
    //     }

    //     return back()->with([
    //         'message' => 'Stripe error. Try again later.',
    //         'alert-type' => 'error'
    //     ]);
    // }
}



public function create_payment_flutterwave(
    float $amount,
    string $currency,
    string $callbackSuccess,
    string $callbackFailed,
    string $tx_ref,
    string $customer_email
): string {
    $flutterwaveSecretKey = 'FLWSECK_TEST-8b272f9980fbdb0c8432798843b07dfe-X';

    $response = Http::withToken($flutterwaveSecretKey)
        ->post('https://api.flutterwave.com/v3/payments', [
            'tx_ref' => $tx_ref,
            'amount' => $amount,
            'currency' => $currency,
            'redirect_url' => $callbackSuccess,
            'payment_options' => 'card,banktransfer,ussd',
            'customer' => [
                'email' => $customer_email,
            ],
            'customizations' => [
                'title' => 'Course Payment',
                'description' => 'Payment for course enrollment',
            ],
        ]);

    if ($response->successful() && isset($response['data']['link'])) {
        return $response['data']['link']; // Redirect user to this payment URL
    }

    // On failure, redirect to failure URL
    return $callbackFailed . '?message=Unable to initiate payment';
}


    public function create_payment_paypal($amount, $currency, $returnUrl, $cancelUrl, $user_reference, $email)
    {
        $paymentData = json_encode([
            "intent" => "sale",
            "payer" => [
                "payment_method" => "paypal",
                "payer_info" => [
                    "email" => $email // Add email to payer info
                ]
            ],
            "transactions" => [[
                "amount" => [
                    "total" => $amount,
                    "currency" => $currency
                ],
                "description" => $user_reference
            ]],
            "redirect_urls" => [
                "return_url" => $returnUrl,
                "cancel_url" => $cancelUrl
            ]
        ]);
        $url = $this->paypal_base_url . "/v1/payments/payment";
        $payment = $this->send_to_api_paypal($url,"POST", $paymentData);

        dd($payment);
        if (is_null($payment) || !isset($payment->links)) {
            return GeneralController::redirectWithMessage(true, "", "Please Try Again Later", "back");
        }

        foreach ($payment->links as $link) {
            if ($link->rel === 'approval_url') {
                return $link->href; // Return the approval URL
            }
        }

        return null; // Return null if no approval URL found
    }

    public function verify_paypal($paymentId, $payerId)
    {
        $url = $this->paypal_base_url."/v1/payments/payment/".$paymentId."/execute";
        $paymentResult = $this->send_to_api_paypal($url,"POST", json_encode(["payer_id" => $payerId]));

        if (isset($paymentResult->state) && $paymentResult->state === 'approved') {
            // Payment approved logic here
            return $paymentResult;
        }

        return null; // Return null if payment is not approved
    }

    private function send_to_api_paypal($url,$method, $data = null)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, strtoupper($method));

        if ($data !== null) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $headers = [
            "Content-Type: application/json",
            "Authorization: Bearer " . $this->paypal_access_token()
        ];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response);
    }

    private function paypal_access_token()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "$this->paypal_base_url/v1/oauth2/token");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_USERPWD, "AcNr71oN4IBUQhkPZY-G7328zjbs2LKkG22zytA7iVaMom6sdlR1B8ET7D9P4ajNcrHlRYDK0d7rYmki:EDPMMX4MLKvgz-eNvOi75r9uUd1CQutsJ4dRSa1cXHSDEyaBsd-fRpsB1wQSOIr09Np0VFrPHcaqf0tW");
        curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");

        $headers = [
            "Accept: application/json",
            "Accept-Language: en_US"
        ];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        curl_close($ch);

        $responseData = json_decode($response);
        return $responseData->access_token ?? null; // Return null if access token not found
    }



    public  function paypal_failed()
    {
        return GeneralController::redirectWithMessage(false, "", "You have cancelled paypal payment initation, please try again", "back");
    }

    public  function paypal_success(Request $request)
    {
        $paymentId = $request->query('paymentId');
        $payerId = $request->query('PayerID');
        $paymentResult = $this->verify_paypal($paymentId, $payerId);

        if ($paymentResult && isset($paymentResult->state) && $paymentResult->state === 'approved') {

            $description = isset($paymentResult->transactions[0]->description) ? $paymentResult->transactions[0]->description : 'No description available';
             Payment::where('referenceId', '=', $description)->update(['status' =>'paid']);
             $payment_info = Payment::where('referenceId', '=', $description)->first();
             $coins  = $payment_info->credit_num;
             $user = User::findOrFail(Auth::user()->id);
             $user->coin_balance = $user->coin_balance + $coins;
             $user->save();
            return GeneralController::redirectWithMessage(true, "Payment Successful", "You have cancelled paypal payment initation, please try again", "user.dashboard");
        }

        return GeneralController::redirectWithMessage(false, "", "Payment Couldn't be confirmed", "back");
    }


    public function paymentCallbackStripeFailed()
    {
        $notification = array(
            'message' => 'Payment not successful, please try again',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }


    public function get_user_id($email)
    {
        $user = User::where('email', $email)->select('id')->first();
        return $user ? $user->id : null;
    }

    public function payment_resolution($id)
    {
        Payment::where('id', $id)->update(['status' => "paid", 'admission_status' => 'accepted']);
        $get_payment_details = Payment::where('id', '=', $id)->first();
        $user_id = $this->get_user_id($get_payment_details->user_email);
        $applied_course = new AppliedCourse;
        $applied_course->user_id = $user_id;
        $applied_course->course_id = $get_payment_details->course_id;
        $applied_course->status = "pending";
        $applied_course->payment_type = $get_payment_details->payment_type;
        $applied_course->admission_status = "accepted";
        $applied_course->payment_id = $get_payment_details->id;
        $applied_course->cohort_id = $get_payment_details->cohort_id;
        $applied_course->save();
        $notification = array(
            'message' => 'Payment Resolved',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }


    public function generateCheckoutUrlStripe($amount, $currency = 'usd', $email, $externalReference)
    {
        $checkoutData = [
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => $currency,
                        'unit_amount' => $amount,
                        'product_data' => [
                            'name' => 'Payment',
                        ],
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('pay.callback.stripe.success'),
            'cancel_url' => route('pay.callback.stripe.failed'),
            'customer_email' => $email,
            'client_reference_id' => $externalReference,
        ];
        $checkoutSession = $this->createCheckoutSessionStripe($checkoutData);
        if (isset($checkoutSession['id'])) {
            Session::flash('session_id', $checkoutSession['id']);
            return $checkoutSession['url'];
        } else {
            echo "Failed to create Checkout Session: " . json_encode($checkoutSession);
            return null;
        }
    }


    public function generateCheckoutUrlStripeComplete($amount, $currency = 'usd', $email, $externalReference, $payment_type)
    {
        $checkoutData = [
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => $currency,
                        'unit_amount' => $amount,
                        'product_data' => [
                            'name' => 'Payment',
                        ],
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'metadata' => [
                'referenceId' => $externalReference,
                'payment_type' => $payment_type
            ],
            'success_url' => route('pay.callback.stripe.success.complete'),
            'cancel_url' => route('pay.callback.stripe.failed'),
            'customer_email' => $email,
            'client_reference_id' => $externalReference,
        ];
        $checkoutSession = $this->createCheckoutSessionStripe($checkoutData);
        if (isset($checkoutSession['id'])) {
            Session::flash('session_id', $checkoutSession['id']);
            return $checkoutSession['url'];
        } else {
            echo "Failed to create Checkout Session: " . json_encode($checkoutSession);
            return null;
        }
    }


    private function verifyStripePayment($sessionId)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.stripe.com/v1/checkout/sessions/$sessionId");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERPWD, env("STRIPE_SECRET_KEY"));
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            // Handle error
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        return json_decode($result, true);
    }

    public function paymentcallbackstripesuccess()
    {
        $session_id = Session::get('session_id');
        $details = $this->verifyStripePayment($session_id);
        $payment_status = $details['payment_status'];
        $referenceId = $details['client_reference_id'];
        if ($payment_status == "paid") {
            Payment::where('referenceId', $referenceId)->update(['status' => "paid", 'admission_status' => 'accepted']);
            $get_payment_details = Payment::where('referenceId', '=', $referenceId)->first();
            $applied_course = new AppliedCourse;
            $applied_course->user_id = Auth::user()->id;
            $applied_course->course_id = $get_payment_details->course_id;
            $applied_course->status = "pending";
            $applied_course->payment_type = $get_payment_details->payment_type;
            $applied_course->admission_status = "accepted";
            $applied_course->cohort_id = $get_payment_details->cohort_id;
            $applied_course->payment_id = $get_payment_details->id;
            $applied_course->save();
            $notification = array(
                'message' => 'Payment successful',
                'alert-type' => 'success'
            );
            return redirect()->route('user.dashboard')->with($notification);
        } else {
            $notification = array(
                'message' => 'Payment not successful',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }

    }

    private function createCheckoutSessionStripe($data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.stripe.com/v1/checkout/sessions");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_USERPWD,  env("STRIPE_SECRET_KEY"));
        $headers = array();
        $headers[] = "Content-Type: application/x-www-form-urlencoded";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        return json_decode($result, true);
    }


    public function initializePaymentPaystack($formData)
    {
        $url = "https://api.paystack.co/transaction/initialize";
        $field_string = http_build_query($formData);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $field_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//            "Authorization: Bearer " . env("PAYSTACK_SECRET_KEY"),
            "Authorization: Bearer sk_test_b93597defb9f4a87cda21964a9fcc4a99261760f",
            "Cache-control: no-cache"
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    public function verifyPaymentPaystack($reference)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/$reference",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer " . env("PAYSTACK_SECRET_KEY"),
                "Cache-control: no-cache"
            )
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }


    public function flutterwaveSuccess(Request $request)
    {
        $status = $request->query('status');
        $transaction_id = $request->query('transaction_id');
    
        if ($status === 'successful' && $transaction_id) {
            $response = $this->verify_flutterwave($transaction_id);
    
            if ($response && isset($response['status']) && $response['status'] === 'success') {
                $data = $response['data'];
    
                $referenceId = $data['meta']['referenceId'] ?? null;
    
                if (!$referenceId) {
                    // fallback to tx_ref if referenceId is missing
                    $referenceId = $data['tx_ref'] ?? null;
                }
    
                if ($referenceId) {
                    Payment::where('referenceId', $referenceId)->update([
                        'status' => "paid",
                        'admission_status' => 'accepted'
                    ]);
    
                    $get_payment_details = Payment::where('referenceId', $referenceId)->first();
                    
                    if($get_payment_details->payment_type ==='full'){
                        self::give_bonus($get_payment_details->course_id);
                    }
                    
                    $applied_course = new AppliedCourse;
                    $applied_course->user_id = Auth::id();
                    $applied_course->course_id = $get_payment_details->course_id;
                    $applied_course->status = "pending";
                    $applied_course->payment_type = $get_payment_details->payment_type;
                    $applied_course->admission_status = "accepted";
                    $applied_course->cohort_id = $get_payment_details->cohort_id;
                    $applied_course->payment_id = $get_payment_details->id;
                    $applied_course->save();
    
                    return redirect()->route('user.dashboard')->with([
                        'message' => 'Payment successful',
                        'alert-type' => 'success'
                    ]);
                }
            }
        }
    
        return back()->with([
            'message' => 'Payment not successful or could not be verified',
            'alert-type' => 'error'
        ]);
    }
    


    public static function give_bonus($course_id)
    {
        $course_info = Course::find($course_id);
        if (!$course_info) {
            return false;
        }
    
        $amount = $course_info->price * 0.02;
        $user = Auth::user();
    
        $referrer = User::where('referral_code', $user->referred_by)->first();
    
        if ($referrer) {
            // Increment referrer bonus balance
            $referrer->increment('referral_bonus', $amount);

            $formattedAmount = number_format($amount, 2);

            $message = "You earned \${$formattedAmount} because {$user->name} purchased the course {$course_info->title}.";
    
            ReferralBonusHistory::create([
                'referrer_id'      => $referrer->id,
                'referred_user_id' => $user->id,
                'course_id'        => $course_id,
                'bonus_amount'     => $amount,
                'message'          => $message,
            ]);
    
            return true;
        }
    
        return false;
    }
    
 

    public function paymentCallbackPaystack()
    {
        $response = json_decode($this->verifyPaymentPaystack(request('reference')));

        $data = $response->data;
        $reference = $data->reference;
        $referenceId = $data->metadata->referenceId;
        if ($response) {
            Payment::where('referenceId', $referenceId)->update(['status' => "paid", 'admission_status' => 'accepted']);
            $get_payment_details = Payment::where('referenceId', '=', $referenceId)->first();
            $applied_course = new AppliedCourse;
            $applied_course->user_id = Auth::user()->id;
            $applied_course->course_id = $get_payment_details->course_id;
            $applied_course->status = "pending";
            $applied_course->payment_type = $get_payment_details->payment_type;
            $applied_course->admission_status = "accepted";
            $applied_course->cohort_id = $get_payment_details->cohort_id;
            $applied_course->payment_id = $get_payment_details->id;
            $applied_course->save();
            $notification = array(
                'message' => 'Payment successful',
                'alert-type' => 'success'
            );
            return redirect()->route('user.dashboard')->with($notification);
        } else {
            $notification = array(
                'message' => 'Payment not successful',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }

    }

    public function transactions()
    {
        $payments = Payment::all();
        return view('admin.payment', compact('payments'));
    }

    public function transactions_user()
    {
        $payments = Payment::where('user_email', '=', Auth::user()->email)->where('status', '=', 'paid')->get();
        return view('user.payment', compact('payments'));
    }

    public function user_complete(Request $request, $id)
    {
        $payment_details = Payment::findOrFail($id);
        $course_detail = Course::where('id', '=', $request->course_id)->first();
        $get_user_detail = AppliedCourse::where('user_id', '=', Auth::user()->id)->where('course_id', '=', $request->course_id)->first();
        $get_actual_cost = CohortCourse::where('course_id', '=', $request->course_id)->where('cohort_id', '=', $get_user_detail->cohort_id)->first();
        if (!$get_actual_cost) {
            $notification = array(
                'message' => 'Please reach out to admin for assistance',
                'alert-type' => 'error'
            );

            return back()->with($notification);
        }
        $actual_cost = $get_actual_cost->price;
        $discount_cost = $course_detail->discount;
        $amount = $actual_cost - ($actual_cost * $discount_cost * 0.01);

        $paid_info  = getUserLocalCurrencyConversion($amount, $request->currency);
        $paid_amount = $paid_info['converted_amount'];
        if ($request->has('second')) {
            $amount = 0.3 * $paid_amount;
            $payment_update = "second installment";
        } elseif ($request->has('third')) {
            $amount = 0.3 * $paid_amount;
            $payment_update = "full";
        } elseif ($request->has('second_third')) {
            $amount = 0.6 * $paid_amount;
            $payment_update = "full";
        }
        $payment_type = $payment_details->payment_type;
        if ($payment_type == "first installment" && $request->has('third')) {
            $notification = array(
                'message' => 'You need to pay the second installment first',
                'alert-type' => 'error'
            );

            return back()->with($notification);
        }

        if ($payment_type == "second installment" && $request->has('second')) {
            $notification = array(
                'message' => 'you have already pay for the second installment',
                'alert-type' => 'error'
            );

            return back()->with($notification);
        }

        if ($payment_type == "second installment" && $request->has('second_third')) {
            $notification = array(
                'message' => 'You only need pay the third installment, dont over pay',
                'alert-type' => 'error'
            );

            return back()->with($notification);
        }

        $new_reference = "OdumareTech" . rand(100000, 999999);
        $payment_details->update(['referenceId' => $new_reference,'bank_info'=>$payment_update ]);
        return redirect($this->create_payment_flutterwave(
            $amount,
            $request->currency,
            route('flutterwave.complete.success'),
            route('flutterwave.failed'),
            $new_reference,
            Auth::user()->email
        ));

    }


    public function user_complete_callback()
    {
        $response = json_decode($this->verifyPayment(request('reference')));

        $data = $response->data;
        $reference = $data->reference;
        $referenceId = $data->metadata->referenceId;
        $payment_update = $data->metadata->payment_type;
        if ($response) {
            Payment::where('referenceId', $referenceId)->update(['status' => "paid", "payment_type" => $payment_update, "admission_status" => "accepted"]);
            $get_payment_details = Payment::where('referenceId', '=', $referenceId)->first();
            $get_user_detail = AppliedCourse::where('user_id', '=', Auth::user()->id)->where('course_id', '=', $get_payment_details->course_id)->first();
            $get_actual_cost = CohortCourse::where('course_id', '=', $get_user_detail->course_id)->where('cohort_id', '=', $get_user_detail->cohort_id)->first();
            $actual_cost = $get_actual_cost->price;
            $course_detail = Course::where('id', '=', $get_user_detail->course_id)->first();
            $discount_cost = $course_detail->discount;
            $paid_amount = $actual_cost - ($actual_cost * $discount_cost * 0.01);
            if ($payment_update == "second installment") {
                Payment::where('referenceId', '=', $referenceId)->update(['amount' => 0.7 * $paid_amount]);
            } else {
                Payment::where('referenceId', '=', $referenceId)->update(['amount' => $paid_amount]);
            }
            AppliedCourse::where('payment_id', '=', $get_payment_details->id)->update(['payment_type' => $payment_update, 'admission_status' => 'accepted']);

            $notification = array(
                'message' => 'Payment successful',
                'alert-type' => 'success'
            );

            return redirect()->route('transaction.user.all')->with($notification);
        } else {
            return back()->withError('something went wrong');
        }

    }
    public function flutterwaveCompleteSuccess(Request  $request)
    {

        $status = $request->query('status');
        $transaction_id = $request->query('transaction_id');
    
        if ($status === 'successful' && $transaction_id) {
            $response = $this->verify_flutterwave($transaction_id);
    
            if ($response && isset($response['status']) && $response['status'] === 'success') {
                $data = $response['data'];
    
                $referenceId = $data['meta']['referenceId'] ?? null;

    
                if (!$referenceId) {
                    // fallback to tx_ref if referenceId is missing
                    $referenceId = $data['tx_ref'] ?? null;
                }
    

                Payment::where('referenceId', $referenceId)->update(['status' => "paid", "admission_status" => "accepted"]);
            $get_payment_details = Payment::where('referenceId', '=', $referenceId)->first();
            $get_user_detail = AppliedCourse::where('user_id', '=', Auth::user()->id)->where('course_id', '=', $get_payment_details->course_id)->first();
            $get_actual_cost = CohortCourse::where('course_id', '=', $get_user_detail->course_id)->where('cohort_id', '=', $get_user_detail->cohort_id)->first();
            $actual_cost = $get_actual_cost->price;
            $course_detail = Course::where('id', '=', $get_user_detail->course_id)->first();
            $discount_cost = $course_detail->discount;
            $paid_amount = getUserLocalCurrencyConversion($actual_cost - ($actual_cost * $discount_cost * 0.01), $get_payment_details->currrency)['converted_amount'];
            if ($get_payment_details->bank_info == "second installment") {
                Payment::where('referenceId', '=', $referenceId)->update(['amount' => 0.7 * $paid_amount, 'payment_type' => 'second installment']);
            } else {
                Payment::where('referenceId', '=', $referenceId)->update(['amount' => $paid_amount]);
            }
            AppliedCourse::where('payment_id', '=', $get_payment_details->id)->update(['payment_type' => $get_payment_details->bank_info, 'admission_status' => 'accepted']);
            $notification = array(
                'message' => 'Payment successful',
                'alert-type' => 'success'
            );
            return redirect()->route('transaction.user.all')->with($notification);
        } else {
            $notification = array(
                'message' => 'Payment not  successful',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
    }else{
        $notification = array(
            'message' => 'Payment not  successful',
            'alert-type' => 'error'
        );
        return back()->with($notification);
    }
        
    }


    public function user_complete_callback_stripe_complete()
    {
        $session_id = Session::get('session_id');
        $details = $this->verifyStripePayment($session_id);
        $payment_status = $details['payment_status'];
        $referenceId = $details['metadata']['referenceId'];
        $payment_type = $details['metadata']['payment_type'];
        if ($payment_status == "paid") {
            Payment::where('referenceId', $referenceId)->update(['status' => "paid", "payment_type" => $payment_type, "admission_status" => "accepted"]);
            $get_payment_details = Payment::where('referenceId', '=', $referenceId)->first();
            $get_user_detail = AppliedCourse::where('user_id', '=', Auth::user()->id)->where('course_id', '=', $get_payment_details->course_id)->first();
            $get_actual_cost = CohortCourse::where('course_id', '=', $get_user_detail->course_id)->where('cohort_id', '=', $get_user_detail->cohort_id)->first();
            $actual_cost = $get_actual_cost->price;
            $course_detail = Course::where('id', '=', $get_user_detail->course_id)->first();
            $discount_cost = $course_detail->discount;
            $paid_amount = $actual_cost - ($actual_cost * $discount_cost * 0.01);
            if ($payment_type == "second installment") {
                Payment::where('referenceId', '=', $referenceId)->update(['amount' => 0.7 * $paid_amount]);
            } else {
                Payment::where('referenceId', '=', $referenceId)->update(['amount' => $paid_amount]);
            }
            AppliedCourse::where('payment_id', '=', $get_payment_details->id)->update(['payment_type' => $payment_type, 'admission_status' => 'accepted']);
            $notification = array(
                'message' => 'Payment successful',
                'alert-type' => 'success'
            );
            return redirect()->route('transaction.user.all')->with($notification);
        } else {
            $notification = array(
                'message' => 'Payment not  successful',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }

    }


    public function admin_fix_payment(Request $request, $id){
        $payment = Payment::findOrfail($id);
        $payment->amount = $request->amount;
        $payment->payment_type = $request->payment_type;
        $payment->save();
        $notification = array(
            'message' => 'Payment Issues Successfully Fixed',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }


    private function verify_flutterwave($transaction_id)
{
    $secret_key = 'FLWSECK_TEST-8b272f9980fbdb0c8432798843b07dfe-X';

    $url = "https://api.flutterwave.com/v3/transactions/{$transaction_id}/verify";

    $client = new \GuzzleHttp\Client();
    $response = $client->get($url, [
        'headers' => [
            'Authorization' => "Bearer $secret_key",
        ],
    ]);

    return json_decode($response->getBody(), true);
}

}
