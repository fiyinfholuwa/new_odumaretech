<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Course;
use App\Models\AppliedCourse;
use App\Models\User;
use App\Models\CohortCourse;
use App\Models\DollarRate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class PaymentController extends Controller
{
    public function makePayment(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'currency' => 'nullable|string',
        ]);

        $referenceId = "OdumareTech" . rand(100000, 999999);

        $course = Course::findOrFail($request->course_id);
        $actual_cost = $course->price;
        $discount_cost = $course->discount;
        $paid_amount = $actual_cost - ($actual_cost * $discount_cost * 0.01);

        if ($request->payment_type === "first installment") {
            $amountInNaira = intval(0.4 * $paid_amount);
        } else {
            $amountInNaira = intval($paid_amount);
        }

        $userCurrency = strtoupper($request->currency ?? 'NGN');

        // Simulated conversion rates from NGN
        $rates = [
            'NGN' => 1,
            'GHS' => 2,
            'ZAR' => 0.0123,
            'USD' => 0.00066,
            'GBP' => 0.00051,
            'EUR' => 0.00059,
            'KES' => 0.089,
            'XAF' => 0.39,
            'XOF' => 0.39,
        ];

        if (!isset($rates[$userCurrency])) {
            return back()->with([
                'message' => 'Currency not supported.',
                'alert-type' => 'error',
            ]);
        }

        $convertedAmount = round($amountInNaira * $rates[$userCurrency]);

        $check_if_attempt_made = Payment::where('user_email', $request->user_email)
            ->where('course_id', $request->course_id)
            ->first();

        // ✅ Handle Bank Transfer
        if ($request->payment === 'bank_transfer') {
            $bank_info = [
                'amount_sent' => $request->amount_sent,
                'bank_name' => $request->bank_name,
                'account_name' => $request->account_name,
            ];

            Payment::create([
                'referenceId' => $referenceId,
                'payment' => "bank transfer",
                'amount' => $amountInNaira,
                'cohort_id' => $request->cohort_id,
                'user_email' => $request->user_email,
                'status' => "pending",
                'admission_status' => "pending",
                'course_id' => $request->course_id,
                'payment_type' => $request->payment_type,
                'bank_info' => json_encode($bank_info),
            ]);

            return back()->with([
                'message' => 'Your bank transfer request has been received.',
                'alert-type' => 'success'
            ]);
        }

        if ($request->payment ==='paystack'){
            // ✅ Handle Paystack (for supported currencies)
            $paystackCurrencies = ['NGN', 'GHS', 'ZAR'];
            if (in_array($userCurrency, $paystackCurrencies)) {
                $formData = [
                    'email' => $request->user_email,
                    'amount' => $convertedAmount * 100, // in kobo
                    'currency' => $userCurrency,
                    'metadata' => ['referenceId' => $referenceId],
                    'callback_url' => route('pay.callback.paystack'),
                ];

                $pay = json_decode($this->initializePaymentPaystack($formData));

                if ($pay && $pay->status) {
                    if (!$check_if_attempt_made) {
                        Payment::create([
                            'referenceId' => $referenceId,
                            'payment' => 'paystack',
                            'amount' => $amountInNaira,
                            'cohort_id' => $request->cohort_id,
                            'user_email' => $request->user_email,
                            'status' => "pending",
                            'admission_status' => "pending",
                            'course_id' => $request->course_id,
                            'payment_type' => $request->payment_type,
                        ]);
                    } else {
                        Payment::where('course_id', $request->course_id)
                            ->where('user_email', $request->user_email)
                            ->update([
                                'referenceId' => $referenceId,
                                'amount' => $amountInNaira,
                                'payment' => 'paystack'
                            ]);
                    }

                    return redirect($pay->data->authorization_url);
                }

                return back()->with([
                    'message' => 'Paystack error. Try again later.',
                    'alert-type' => 'error'
                ]);
            }

        }
        // ✅ Handle Stripe (for all other currencies via USD)
        $usdAmount = round($amountInNaira * $rates['USD']); // fallback conversion
        $checkoutUrl = $this->generateCheckoutUrlStripe($usdAmount * 100, 'usd', $request->user_email, $referenceId);

        if ($checkoutUrl) {
            if (!$check_if_attempt_made) {
                Payment::create([
                    'referenceId' => $referenceId,
                    'payment' => 'stripe',
                    'amount' => $amountInNaira,
                    'cohort_id' => $request->cohort_id,
                    'user_email' => $request->user_email,
                    'status' => "pending",
                    'admission_status' => "pending",
                    'course_id' => $request->course_id,
                    'payment_type' => $request->payment_type,
                ]);
            } else {
                Payment::where('course_id', $request->course_id)
                    ->where('user_email', $request->user_email)
                    ->update([
                        'referenceId' => $referenceId,
                        'amount' => $amountInNaira,
                        'payment' => 'stripe'
                    ]);
            }

            return redirect($checkoutUrl);
        }

        return back()->with([
            'message' => 'Stripe error. Try again later.',
            'alert-type' => 'error'
        ]);
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
        $paid_amount = $actual_cost - ($actual_cost * $discount_cost * 0.01);

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

        if ($request->payment =='bank_transfer') {
            $bank_info = array(
                'amount_sent' => $request->amount_sent,
                'bank_name' => $request->bank_name,
                'account_name' => $request->account_name
            );
            $payment =  Payment::findOrFail($id);
            $payment->payment = "bank transfer";
            $payment->amount = $amount;
            $payment->bank_info = json_encode($bank_info);
            $payment->save();
            $notification = array(
                'message' => 'Your request has been sent, we will get back to you shortly',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }

        $formData = [
            'email' => $payment_details->user_email,
            'amount' => $amount * 100,
            'currency' => "NGN",
            'metadata' => ['referenceId' => $payment_details->referenceId, 'payment_type' => $payment_update],
            'callback_url' => route('pay.callback.user.complete')
        ];

        if ($request->payment == "paystack") {
            $pay = json_decode($this->initializePaymentPaystack($formData));

            dd($pay);
            if ($pay) {
                if ($pay->status) {
                    return redirect($pay->data->authorization_url);
                } else {
                    $notification = array(
                        'message' => 'try again later',
                        'alert-type' => 'error'
                    );
                    return back()->with($notification);
                }
            } else {
                $notification = array(
                    'message' => 'something went wrong',
                    'alert-type' => 'error'
                );
                return back()->with($notification);
            }
        } elseif ($request->payment == "stripe") {
            $dollar_details = DollarRate::first();
            $dollar_rate = $amount / $dollar_details->price;
            $checkoutUrl = $this->generateCheckoutUrlStripeComplete(intval($dollar_rate * 100), 'usd', Auth::user()->email, $payment_details->referenceId, $payment_update);
            if ($checkoutUrl) {
                return redirect($checkoutUrl);
            } else {
                $notification = array(
                    'message' => 'Try again later',
                    'alert-type' => 'error'
                );
                return back()->with($notification);
            }
        }


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

}
