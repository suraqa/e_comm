@extends("layouts.app")

@section('content')

    {{ dd(Session::get(auth()->id())) }}
    <section class="cart-section">
        <div class="container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Price/unit</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td scope="row">asdasd</td>
                        <td>12</td>
                        <td>1</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

@endsection
