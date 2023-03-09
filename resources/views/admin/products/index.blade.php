@extends('layouts.admin')

@section('page-title')
    Prodotti 
@endsection

@section('content')
    <div class="container py-4">
        <h2 class="fw-semibold text-center mb-4">I tuoi prodotti</h2>
        <div class="w-100">
            @include('partials.message')
        </div>
        <a href="{{ route('admin.products.create')}}" class="btn btn-primary fw-semibold mb-3"><i class="fa-solid fa-plus me-1"></i> Crea prodotto</a>

        @if(count($products) < 1)
            <h2 class="text-center text-white ms-bg-title rounded py-5 mb-3">Crea i prodotti del tuo ristorante per visualizzare il tuo menù!</h2> 
        @else
            <table class="ms-table table table-striped table-responsive">
                <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Tipologia</th>
                        <th scope="col">Disponibilità</th>
                        <th scope="col">Prezzo</th>
                        <th scope="col">Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr class="align-middle">
                            <td>{{ $product->name }}</td>
                            <td>{{ ucfirst($product->typology) }}</td>
                            @if( $product->is_available == 1 ) 
                                <td class="text-success">Disponibile</td>
                            @else
                                <td class="text-danger">Non disponibile</td>
                            @endif
                            <td>{{ number_format($product->price, 2, ',') . ' €'}}</td>
                            <td>
                                <a href="{{ route('admin.products.show', $product) }}" class="btn btn-outline-info ms-white-hover my-1"><i class="fa-solid fa-eye"></i></a>
                                <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-outline-warning ms-white-hover my-1"><i class="fa-solid fa-pen-to-square"></i></a>
            
                                <!-- Button modale (modalDelete) -->
                                <button type="button" class="btn btn-outline-danger ms-white-hover my-1" data-bs-toggle="modal" data-bs-target="#modalDelete-{{ $product->id }}"><i class="fa-solid fa-trash"></i></button>
                            </td>
                        </tr>
                        <!-- Modale (modalDelete) -->
                        <div class="modal fade" id="modalDelete-{{ $product->id }}" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="modalDeleteLabel">Cancellazione Prodotto</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">Confermi di voler cancellare definitivamente il prodotto <strong>"{{ $product->name }}"</strong>?</div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary fw-semibold" data-bs-dismiss="modal">Annulla</button>
                                        <form action="{{ route('admin.products.destroy', $product)}}" method="POST" class="d-inline-block">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger fw-semibold">Sì, cancella!</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
    
@endsection