@extends("layouts.app")

@section('content')
<?php
    $total = 0;
    $cartIds = array()
?>
@foreach ($cartProducts as $cartProduct)
    <?php
        $total += ($cartProduct->price * $cartProduct->quantity);
        array_push($cartIds, $cartProduct->id);
        // $cartIds .= ($cartProduct->id.",")
    ?>
@endforeach

<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // $.ajaxSetup({
    //     headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     }
    // });
    // $.ajax({
    //     url: "{{ route('order.add') }}",
    //     data: {
    //         "cart_ids": "{{ implode(",", $cartIds) }}"
    //     },
    //     type: 'post',
    //     success: response => {
    //         console.log(response);
    //     }
    // });
</script>
<section class="my-5 py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default credit-card-box">
                    <div class="panel-heading">
                        <div class="row">
                            <h3>Payment Details</h3>
                        </div>
                    </div>
                    <div class="panel-body">
                        @if (Session::has('success'))
                        <div class="alert alert-success text-center">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <p>{{ Session::get('success') }}</p>
                        </div>
                        <script>
                            setTimeout(() => {
                                window.location.assign("{{ route('product.index') }}")
                            }, 3000);

                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            $.ajax({
                                url: "{{ route('order.add') }}",
                                data: {
                                    "cart_ids": "{{ implode(",", $cartIds) }}"
                                },
                                type: 'post',
                                success: response => {
                                    console.log(response);
                                }
                            });

                            // $.ajax({
                            //     url: "{{ route('order.add') }}",
                            //     data: {
                            //         "user_id": {{ auth()->id() }}
                            //     },
                            //     type: 'post',
                            //     success: response => {
                            //         console.log(response);
                            //     }
                            // });

                            // $.ajax({
                            //     url: "/delete-item",
                            //     data: {
                            //         "product_id": id
                            //     },
                            //     type: 'delete',
                            //     success: response => {
                            //         console.log(response)
                            //     }
                            // });

                        </script>
                        @endif
                        <br>
                        <form role="form" action="{{ route('stripe.post', ["total" => $total]) }}" method="post"
                            class="require-validation" data-cc-on-file="false" id="payment-form">
                            @csrf
                            <div class='form-row row'>
                                <div class='col-xs-12 col-md-6 form-group required'>
                                    <label class='control-label'>Name on Card</label>
                                    <input class='form-control' size='4' type='text'>
                                </div>
                                <div class='col-xs-12 col-md-6 form-group required'>
                                    <label class='control-label'>Card Number</label>
                                    <input autocomplete='off' class='form-control card-number' size='20' type='text'>
                                </div>
                            </div>
                            <div class='form-row row'>
                                <div class='col-xs-12 col-md-4 form-group cvc required'>
                                    <label class='control-label'>CVC</label>
                                    <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311'
                                        size='4' type='text'>
                                </div>
                                <div class='col-xs-12 col-md-4 form-group expiration required'>
                                    <label class='control-label'>Expiration Month</label>
                                    <input class='form-control card-expiry-month' placeholder='MM' size='2' type='text'>
                                </div>
                                <div class='col-xs-12 col-md-4 form-group expiration required'>
                                    <label class='control-label'>Expiration Year</label>
                                    <input class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                        type='text'>
                                </div>
                            </div>
                            <div class="form-row row">
                                <div class="col-xs-12">
                                    <button class="btn btn-primary btn-lg btn-block mt-5" type="submit"
                                        style="margin-bottom: 120px !important">Pay Now</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-md-offset-3">
                <h3>Order details</h3>
                <table class="table" id="table">
                    <thead>
                        <tr>
                            <th>Quantity</th>
                            <th>Name</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($cartProducts as $cartProduct)
                        <tr>
                            <td>
                                {{ $cartProduct->quantity }}
                            </td>
                            <td scope="row">{{ $cartProduct->name }}</td>
                            <td id="subtotal-{{ $cartProduct->product_id }}">
                                {{ ($cartProduct->price * $cartProduct->quantity) }}</td>
                        </tr>
                        @endforeach

                        <tr>
                            <td scope="row"></td>
                            <td></td>
                            <td style="font-size: 20px">
                                PKR {{ $total }}
                            </td>

                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</section>
<script src="https://js.stripe.com/v2/"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        var $form = $(".require-validation");
        $('form.require-validation').bind('submit', function(e) {
            var $form = $(".require-validation"),
            inputSelector = ['input[type=email]', 'input[type=password]', 'input[type=text]', 'input[type=file]', 'textarea'].join(', '),
            $inputs = $form.find('.required').find(inputSelector),
            $errorMessage = $form.find('div.error'),
            valid = true;
            $errorMessage.addClass('hide');
            $('.has-error').removeClass('has-error');
            $inputs.each(function(i, el) {
                var $input = $(el);
                if ($input.val() === '') {
                    $input.parent().addClass('has-error');
                    $errorMessage.removeClass('hide');
                    e.preventDefault();
                }
            });
            if (!$form.data('cc-on-file')) {
            e.preventDefault();
            Stripe.setPublishableKey("pk_test_51IRhvAKkz2PvTdyx6ypGaiwp7HRVdIQU8MuqBlnOfsRUzt45pnPG8Kom6MITMtANUX7PEJAHB3FvFByBBVWdx4Cb00pBOpFm66");
            Stripe.createToken({
                number: $('.card-number').val(),
                cvc: $('.card-cvc').val(),
                exp_month: $('.card-expiry-month').val(),
                exp_year: $('.card-expiry-year').val()
            }, stripeResponseHandler);
            }
        });

        function stripeResponseHandler(status, response) {
            console.log(response.msg);
            if (response.error) {
                $('.error')
                    .removeClass('hide')
                    .find('.alert')
                    .text(response.error.message);
            } else {
                /* token contains id, last4, and card type */
                var token = response['id'];
                $form.find('input[type=text]').empty();
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                $form.get(0).submit();
            }
        }
    });
</script>
@endsection
