@extends('layouts.app')

@section('content')

    <section class="products-section my-5 py-5">
        <div class="container">
            <div class="heading mb-5">
                <h1>Products</h1>
                <div class="underline"></div>
            </div>
            @if (Session::get("success"))
                <div class="row justify-content-center">
                    <div class="col-6">
                        <div class="alert alert-success" role="alert" id="alert">
                            <strong>{{ Session::get("success") }}</strong>
                        </div>
                    </div>
                </div>

                <script>
                    const alertElement = document.getElementById("alert");
                    setTimeout(() => {
                        alertElement.classList.add("d-none");
                    }, 3000);
                </script>
                {{ Session::forget("success") }}
            @endif
            <div class="row">
                    @foreach ($products as $item)
                        <div class="col-xl-3 col-md-4 col-xs-6 col-sm-6">
                            <div class="card my-2">
                                <img class="card-img-top" src="{{ asset('images/pexels-photo-1092644.jpeg') }}" alt="">
                                <div class="card-body">
                                    <h4 class="card-title"><a href="{{ route("product.show", $item) }}" class="product-link">{{ $item->name }}</a></h4>
                                    <p class="card-text">
                                        @if (strlen($item->description) >= 175 )
                                            {{ substr($item->description, 0, 170)."....." }}
                                        @else
                                            {{ $item->description }}
                                        @endif</p>
                                    <h5 class="text-center">PKR {{ $item->price }}</h5>
                                    <a href="{{ route("cart.add", $item) }}" class="add-to-cart-btn btn btn-outline-primary" onclick="{{ Session::put("success", "Added to cart!!") }}">Add to Cart</a>
                                    <a href="#" title="Add to Wishlist" class="wishlist-btn"><i class="fa fa-heart" aria-hidden="true"></i></a>

                                </div>
                            </div>
                        </div>

                    @endforeach

            </div>
            <div class="text-center my-5">
                <a href="{{ route("product.index") }}" class="btn btn-lg btn-primary view-more-btn">VIEW MORE</a>

            </div>
        </div>

    </section>
@endsection
