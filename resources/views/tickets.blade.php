@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <ul class="nav nav-tabs">
                <li class="nav-item active"><a class="nav-link active show" data-toggle="tab" href="#new">Nuevo ticket</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tickets">Tickets</a></li>
            </ul>

            <div class="tab-content">

                @include('flash::message')

                <div id="new" class="tab-pane fade in show active">
                    <div class="card">
                        <div class="card-header">Tickets</div>
                        <form method="post" action="{{ route('tickets.save') }}">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-4 col-sm-12">
                                        <input placeholder="Fecha" type="date" class="form-control" name="date" value="{{ date('Y-m-d') }}" required/>
                                    </div>
                                    <div class="form-group col-md-8 col-sm-12">
                                        <input type="text" placeholder="TIenda" class="form-control" name="market" list="markets" autocomplete="off" required />
                                        @if (!empty($markets))
                                            <datalist id="markets">
                                            @foreach ($markets as $market)
                                            <option>{{ $market->name }}</option>
                                            @endforeach
                                            </datalist>
                                        @endif
                                    </div>
                                </div>
                                <p><button type="submit" class="btn btn-primary btn-block">Crear nuevo ticket</button></p>
                            </div>
                        </form>
                    </div>
                </div>
                <div id="tickets" class="tab-pane fade">
                    <div class="card">
                    @if (!empty($tickets) && count($tickets) > 0)
                        <div class="card-header">Tickets</div>
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col" width="50"></th>
                                <th scope="col" width="130">Fecha</th>
                                <th scope="col">Tienda</th>
                                <th scope="col" width="70">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($tickets as $ticket)
                                <tr>
                                <th scope="row"><a href="{{ route('tickets.remove', ['id' => $ticket->idTicket]) }}">Borrar</a></th>
                                <th scope="row"><a href="{{ route('tickets.view', ['id' => $ticket->idTicket]) }}">{{ $ticket->date }}</a></th>
                                <td>{{ $ticket->name }}</td>
                                <td>{{ number_format($ticket->total, 2) }}€ </td>
                                </tr>
                            @endforeach
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
