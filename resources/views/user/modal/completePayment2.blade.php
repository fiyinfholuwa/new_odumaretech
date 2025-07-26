
    <!-- Modal -->
    <div id="pay_{{$pay->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{route('user.complete.payment', $pay->id)}}" method="post">@csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 id="exampleModalLabel" class="modal-title text-danger">Payment Complete</h5>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to complete your payment? This action will take you to a payment gateway
                            where you can pay the remaining installment.</p>

                        <div class="mt-3">
                            <label>Choose Payment Gateway</label>
                            <select name="payment" required class="form-control paymentSelect" data-payid="{{$pay->id}}">
                                <option value="">Select Payment option</option>
                                <option value="paystack">Naira Payment (#)</option>
                                <option value="stripe">International Payment</option>
                                <option value="bank_transfer">International Bank Transfer</option>
                            </select>

                        </div>
                        <div class="bankTransferFields" id="bankTransferFields_{{$pay->id}}" style="display: none;">
                            <p style="font-weight: bolder;">Bank Transfer Details:</p>
                            <!-- Bank transfer details -->
                            <p>
                                Account holder: ODUMARETECH LTD <br/>
                                Account number: 57675753 <br/>
                                Sort code: 041450 <br/>
                                BIC: SUPAGB21XXX <br/>
                                Institution: SumUp Payments Limited
                            </p>

                            @php
                                $dollar_details = \App\Models\DollarRate::first();
                                $payment = ($pay->amount * 100)/ 40;
                                $second_installment = (0.3 * $payment) / $dollar_details->price;
                                $third_installment = (0.3 * $payment) / $dollar_details->price;
                                $second_third_installment = (0.6 * $payment) / $dollar_details->price;
                            @endphp
                            <span class="card" style="background: #4d7cfe; padding: 20px;">
                                                    <h6 style="color: whitesmoke">Second Installment(30%): &#163;{{number_format($second_installment, 2)}}</h6>
                                                    <h6 style="color: whitesmoke">Third Installment (30%): &#163;{{number_format($third_installment, 2)}}</h6>
                                                    <h6 style="color: whitesmoke">Second && Third(60%): &#163;{{number_format($second_third_installment, 2)}} </h6>
                                                </span>

                            <div class="mt-1">
                                <label>Amount Sent</label>
                                <input class="form-control" name="amount_sent" type="text" id="amountSent"
                                       placeholder="Amount Sent">
                            </div>

                            <div class="mt-1">
                                <label>Bank Name</label>
                                <input class="form-control" name="bank_name" type="text" id="bankName"
                                       placeholder="Bank Name">
                            </div>
                            <div class="mt-1">
                                <label>Account Name</label>
                                <input class="form-control" name="account_name" type="text" id="accountName"
                                       placeholder="Account Name">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input name="course_id" type="hidden" value="{{$pay->course_id}}">
                        <button class="btn btn-primary" type="button" data-dismiss="modal">Close</button>
                        <button class="btn btn-info btn-sm" name="second" type="submit">2nd Payment</button>
                        <button class="btn btn-dark btn-sm" name="third" type="submit">3rd Payment</button>
                        <button class="btn btn-success btn-sm" name="second_third" type="submit">2nd & 3rd Payment</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

<!-- JavaScript -->
<script>
    // Function to handle change event of payment method select
    function handlePaymentMethodChange() {
        var payId = this.getAttribute('data-payid');
        var paymentMethod = this.value;
        var bankTransferFields = document.getElementById("bankTransferFields_" + payId);

        if (paymentMethod === "bank_transfer") {
            bankTransferFields.style.display = "block";
        } else {
            bankTransferFields.style.display = "none";
        }
    }

    // Add event listener to all payment selects
    document.querySelectorAll(".paymentSelect").forEach(function (select) {
        select.addEventListener("change", handlePaymentMethodChange);
    });
</script>
