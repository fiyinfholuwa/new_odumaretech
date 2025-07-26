<!-- Modal -->
<div id="pay_{{ $pay->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('user.complete.payment', $pay->id) }}" method="post">@csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="exampleModalLabel" class="modal-title text-primary">Complete Your Payment</h5>
                </div>

                <div class="modal-body">
                    @php
                        // Get 40% paid amount
                        $fortyPercentAmount = floatval($pay->amount);

                        // Calculate full 100% base amount
                        $fullAmount = ($fortyPercentAmount * 100) / 40;


                $conversion = getUserLocalCurrencyConversion($fullAmount,$pay->currency);

                $symbol= $conversion['currency_symbol'];
                        // 2nd and 3rd installment (30% each of full local amount)
                        $second_installment = round(0.3 * $fullAmount, 2);
                        $third_installment = round(0.3 * $fullAmount, 2);
                        $second_third_installment = round($second_installment + $third_installment, 2);
                    @endphp

                    <div class="alert alert-info">
                        <p><strong>Amount to pay (100%):</strong> {{ $symbol }}{{ number_format($fullAmount, 2) }}</p>
                        <p><strong>2nd Payment (30%):</strong> {{ $symbol }}{{ number_format($second_installment, 2) }}</p>
                        <p><strong>3rd Payment (30%):</strong> {{ $symbol }}{{ number_format($third_installment, 2) }}</p>
                        <p><strong>2nd & 3rd Total (60%):</strong> {{ $symbol }}{{ number_format($second_third_installment, 2) }}</p>
                    </div>
                </div>

                <div class="modal-footer">
                    <input type="hidden" name="course_id" value="{{ $pay->course_id }}">
                    <input type="hidden" name="payment" value="flutterwave">
                    <input type="hidden" name="currency" value="{{ $pay->currency }}">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-info btn-sm" name="second" type="submit">2nd Payment</button>
                    <button class="btn btn-dark btn-sm" name="third" type="submit">3rd Payment</button>
                    <button class="btn btn-success btn-sm" name="second_third" type="submit">2nd & 3rd Payment</button>
                </div>
            </div>
        </form>
    </div>
</div>
