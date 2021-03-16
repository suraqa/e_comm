@extends("layouts.app")

@section('content')

    <section class="product-create my-5 py-5">
        <div class="container">
            <div class="row justify-content-center">
                <form class="col-6" action="{{ route("product.store") }}" method="post" onsubmit="{{ Session::put("success", "Product added!") }}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" name="price" id="price" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" rows="10" class="form-control"></textarea>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-outline-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

@endsection
