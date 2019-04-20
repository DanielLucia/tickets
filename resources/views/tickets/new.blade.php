@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="row">
                <div class="col-md-4 col-sm-12">
                    <div class="card-header"><strong>{{ $ticket->date }}</strong> {{ $ticket->name }}</div>
                        <form method="post" action="{{ route('tickets.save.product') }}">
                            @csrf
                            <div class="card-body">
                                <input type="hidden" value="{{ $ticket->idTicket }}" name="ticket" />

                                <div class="form-group">
                                    <input type="text" placeholder="Cantidad" class="form-control" name="quantity" value="1" required />
                                </div>

                                <div class="form-group">
                                    <input type="text" placeholder="Producto" class="form-control" name="product" list="products" autocomplete="off" autofocus required/>

                                    @if (!empty($products))
                                        <datalist id="products">
                                        @foreach ($products as $product)
                                        <option>{{ $product->product }}</option>
                                        @endforeach
                                        </datalist>
                                    @endif

                                </div>

                                <div class="form-group">
                                    <input type="text" placeholder="Precio" class="form-control" name="price" required autocomplete="off"/>
                                </div>

                                <div class="form-group" style="display: none;">
                                    <label for="price">Fecha de caducidad</label>
                                    <input type="date" class="form-control" name="expiry" value="{{ date('Y-m-d') }}"/>
                                </div>

                                <p><button type="submit" class="btn btn-primary btn-block">Guardar producto</button></p>
                                <p><a href="{{ route('tickets') }}" class="btn btn-secondary btn-block">Cerrar ticket</a></p>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-8 col-sm-12">
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

                        <tr>
                        <td></td>
                        <td></td>
                        <td>Total</td>
                        <th scope="row">{{ number_format($ticket->total, 2) }}€</th>
                        </tr>

                        </tbody>
                        </table>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
