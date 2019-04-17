@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><strong>{{ $ticket->date }}</strong> {{ $ticket->name }} ({{ number_format($ticket->total, 2) }}€)</div>
                <form method="post" action="{{ route('tickets.save.product') }}">
                @csrf
                <div class="card-body">
                    <input type="hidden" value="{{ $ticket->id }}" name="ticket" />
                    <div class="form-group">
                        <label for="price">Cantidad</label>
                        <input type="text" class="form-control" name="quantity" value="1" required />
                    </div>

                    <div class="form-group">
                        <label for="price">Producto</label>
                        <input type="text" class="form-control" name="product" list="products" autocomplete="off" autofocus required/>
                        <datalist id="products">
                        @foreach ($products as $product)
                        <option>{{ $product->product }}</option>
                        @endforeach
                        </datalist>
                    </div>

                    <div class="form-group">
                        <label for="price">Precio</label>
                        <input type="text" class="form-control" name="price" required/>
                    </div>

                    <div class="form-group">
                        <label for="price">Fecha de caducidad</label>
                        <input type="date" class="form-control" name="expiry" value="{{ date('Y-m-d') }}"/>
                    </div>

                    <p><button type="submit" class="btn btn-primary btn-block">Guardar producto</button></p>
                    <p><a href="{{ route('tickets') }}" class="btn btn-secondary btn-block">Cerrar ticket</a></p>
                </div>
                </form>
                @if (!empty($contentTicket))

                    <div class="card-header">Contentido</div>

                    <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Producto</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($contentTicket as $product)
                            <tr>
                        <th scope="row">{{ $product->quantity }}</th>
                        <td>{{ $product->product }}</td>
                        <td>{{ number_format($product->price, 2) }}€</td>
                        <td>{{ number_format($product->quantity * $product->price, 2) }}€</td>
                        </tr>
                    @endforeach
                    </tbody>
                    </table>
                @endif


            </div>
        </div>
    </div>
</div>
@endsection
