<div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalTitle">Payment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="error hide">
                    <div class="alert alert-danger"></div>
                </div>
                <form role="form" action="{{ route("product.payment") }}" method="post" class="stripe-payment"
                      data-cc-on-file="false" data-stripe-publishable-key="{{ config("filepool.settings.stripe_key") }}"
                      id="stripe-payment">
                    <input type="hidden" name="product" value="" id="payment_product">
                    @csrf

                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="card_name_addon">
                                    <i data-feather="user"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" id="card_name" placeholder="Name on Card" aria-describedby="card_name_addon">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="card_number_addon">
                                    <i data-feather="credit-card"></i>
                                </span>
                            </div>
                            <input type="text" autocomplete="off" class="form-control card-num" id="card_number" maxlength="20" placeholder="Card Number"
                                   aria-describedby="card_number_addon">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-xs-12 col-md-4 form-group cvc required">
                            <label for="card_cvc">CVC</label>
                            <input type="text" autocomplete="off" class="form-control card-cvc" id="card_cvc" size="4" placeholder="CVC">
                        </div>
                        <div class="col-xs-12 col-md-4 form-group expiration required">
                            <label for="card_expire_m">Expiration Month</label>
                            <input type="text" class="form-control card-expiry-month" id="card_expire_m" size="2" placeholder="MM">
                        </div>
                        <div class="col-xs-12 col-md-4 form-group expiration required">
                            <label for="card_expire_y">Expiration Year</label>
                            <input type="text" class="form-control card-expiry-year" id="card_expire_y" size="4" placeholder="YYYY">
                        </div>
                    </div>
                    <div class="row p-3">
                        <button class="btn btn-block fpool-button buy-product" id="buyProductButton" type="submit">Pay</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@section('scripts')
    <script type="text/javascript" src="{{asset('assets/js/stripe.js')}}"></script>
    <script type="text/javascript">
        $(function () {
            var $form = $(".stripe-payment");
            $('form.stripe-payment').bind('submit', function (e) {
                let payment_button_loading = '<div class="spinner-border text-primary" role="status">\n' +
                    '                            <span class="sr-only">Loading...</span>\n' +
                    '                        </div>';
                $('#buyProductButton').html(payment_button_loading);

                var $form = $(".stripe-payment"),
                    inputVal = ['input[type=email]', 'input[type=password]',
                        'input[type=text]', 'input[type=file]',
                        'textarea'
                    ].join(', '),
                    $inputs = $form.find('.required').find(inputVal),
                    $errorStatus = $form.find('div.error'),
                    valid = true;
                $errorStatus.addClass('hide');

                $('.has-error').removeClass('has-error');
                $inputs.each(function (i, el) {
                    var $input = $(el);
                    if ($input.val() === '') {
                        $input.parent().addClass('has-error');
                        $errorStatus.removeClass('hide');
                        e.preventDefault();
                    }
                });

                if (!$form.data('cc-on-file')) {
                    e.preventDefault();
                    Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                    Stripe.createToken({
                        number: $('.card-num').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(),
                        exp_year: $('.card-expiry-year').val()
                    }, stripeRes);
                }
            });

            function stripeRes(status, response) {
                if (response.error) {
                    $('.error').removeClass('hide')
                        .find('.alert')
                        .text(response.error.message);
                    $('#buyProductButton').html($('#buyProductButton').attr('data-default-text'));
                } else {
                    var token = response['id'];
                    $form.find('input[type=text]').empty();
                    $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                    $form.get(0).submit();
                }
            }

        });

    </script>
@append
