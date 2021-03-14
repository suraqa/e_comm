@extends('layouts.app')

@section('content')

    <section class="products-section my-5 py-5">

        <div class="container">
            <div class="heading mb-5">
                <h1>Products</h1>
                <div class="underline"></div>
            </div>
            <div class="row">
                @for ($i = 1; $i <= 8; $i++)
                    <div class="col-xl-3 col-md-4 col-xs-6 col-sm-6">
                        <div class="card my-2">
                            <img class="card-img-top" src="{{ asset('images/pexels-photo-1092644.jpeg') }}" alt="">
                            <div class="card-body">
                                <h4 class="card-title">Mobile {{ $i }}</h4>
                                <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam voluptatibus
                                    odit ratione sunt, suscipit vitae sit, totam quod, commodi quaerat at rerum nisi! Cupiditate
                                    repellat sed corrupti est maxime perferendis.</p>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
            <div class="text-center my-5">
                <a href="#" class="btn btn-lg btn-primary">VIEW MORE</a>

            </div>
        </div>

    </section>
@endsection
