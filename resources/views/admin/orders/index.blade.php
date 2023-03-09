@extends('layouts.admin')

@section('page-title')
    Ordini 
@endsection

@section('content')
    <div class="container py-4">
        <h2 class="fw-semibold text-center mb-4">I tuoi ordini</h2>
        <div class="w-100">
            @include('partials.message')
        </div>

        @if(count($orders) < 1)
            <h2 class="text-center text-white ms-bg-title rounded py-5 mb-3">Il tuo ristorante non ha ordini!</h2> 
        @else
            <table class="ms-table table table-striped">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col" class="text-center">Totale ordine</th>
                        <th scope="col" class="text-center">Data e ora creazione</th>
                        <th scope="col" class="text-center">Data e ora consegna</th>
                        <th scope="col" class="text-center">Tempo di consegna</th>
                        <th scope="col" class="text-center">Dettagli ordine</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr class="align-middle">
                            <td class="text-center">{{ $order->id }}</td>
                            <td class="text-center">{{ number_format($order->total_price, 2, ',') . ' €'}}</td>
                            <td class="text-center text-success fw-semibold">{{ $order->created_at->format($dateFormat) }}</td>
                            <td class="text-center text-danger fw-semibold">{{ \Carbon\Carbon::parse($order->delivery_date)->format($dateFormat) }}</td>
                            {{-- colonna consegna in cui vengono creati badge diversi a seconda dei tempi di consegna --}}
                            <td class="text-center">
                                <span class="badge fs-6 @if($order->created_at->diffInMinutes($order->delivery_date) < 40) text-bg-success @elseif($order->created_at->diffInMinutes($order->delivery_date) < 50) text-bg-warning @else text-bg-danger @endif">{{ $order->created_at->diffInMinutes($order->delivery_date) . ' minuti' }}</span>
                            </td>
                            {{-- /colonna consegna in cui vengono creati badge diversi a seconda dei tempi di consegna --}}
                            <td class="text-center"><a href="{{ route('admin.orders.show', $order) }}" class="btn btn-outline-info ms-white-hover my-1"><i class="fa-solid fa-eye"></i></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
    
@endsection