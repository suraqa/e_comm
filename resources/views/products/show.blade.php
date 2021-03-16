@extends("layouts.app")

@section('content')

    <section class="product-show my-5 py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-5">
                    <div class="card">
                        <img class="card-img-top" src="{{ asset("images/pexels-photo-1092644.jpeg") }}" alt="">
                        <div class="card-body">
                            <h4 class="card-title">{{ $product->name }}</h4>
                            <p class="card-text">{{ $product->description }}</p>
                            <div class="text-center">
                                <a href="{{ route("product.edit", $product) }}" class="btn btn-primary">Edit</a>
                                <form action="{{ route("product.destroy", $product) }}" method="post" class="d-inline-block" onsubmit="{{ Session::put("success", "Product deleted..") }}">
                                    @csrf
                                    @method("DELETE")
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
