@extends("layouts.app")
{{-- {{ dd($cartProducts) }} --}}
@section('content')
    <section class="cart-section my-5 py-5">
        <div class="container">
            <table class="table" id="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Price/unit</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $total = 0
                    ?>
                    @foreach ($cartProducts as $cartProduct)
                        <tr>
                            <td scope="row">{{ $cartProduct->name }}</td>
                            <td id="price-{{ $cartProduct->product_id }}">{{ $cartProduct->price }}</td>
                            <td>
                                <input type="number" name="quantity" value="{{ $cartProduct->quantity }}" min="1" onchange="update(this, {{ $cartProduct->product_id }})">
                            </td>
                            <td id="subtotal-{{ $cartProduct->product_id }}">{{ ($cartProduct->price * $cartProduct->quantity) }}</td>
                            <td>
                                <a href="#" class="text-danger del-btn" onclick="cartDelete({{ $cartProduct->product_id }})">
                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                        <?php
                            $total += ($cartProduct->price * $cartProduct->quantity)
                        ?>
                        @endforeach

                        <tr>
                            <td scope="row"></td>
                            <td></td>
                            <td></td>
                            <th style="line-height: 30px">Total</th>
                            <td style="font-size: 20px">PKR {{ $total }}</td>
                        </tr>
                </tbody>
            </table>
            <div class="d-flex justify-content-end">
                <a href="{{ route("stripe.get") }}" class="btn btn-lg btn-primary mt-5" style="margin-right: 120px">Checkout</a>
            </div>
        </div>
    </section>


@endsection
