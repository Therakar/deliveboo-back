@extends('layouts.admin')

@section('page-title')
    Ristoranti
@endsection

@section('content')
    <h2>Lista dei ristoranti</h2>
    {{-- <a href="{{ route('admin.restaurants.create')}}" class="btn btn-primary">Crea ristorante</a> --}}
    {{-- <a href="{{ route('admin.restaurants.show', Auth::user()->restaurant)}}" class="btn btn-primary">Mostra ristorante</a> --}}
@endsection