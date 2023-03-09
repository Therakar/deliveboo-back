@extends('layouts.admin')

@section('page-title')
    Crea ristorante
@endsection

@section('content')
    <div class="container py-4">
        <h2 class="fw-semibold text-center mb-4">Crea il tuo ristorante</h2>
        <div class="w-100">
            @include('partials.message')
        </div>
        {{-- form di creazione ristorante --}}
        <form action="{{route('admin.restaurants.store')}}" id="myForm" method="POST" enctype="multipart/form-data" class="mb-5">
        @csrf
            {{-- campo nome --}}
            <div class="mb-3">
               <label for="name" class="form-label fw-semibold mb-2">Nome*</label>
               <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Inserisci il nome del ristorante" value="{{old('name')}}" maxlength="100" required>
               @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="d-sm-flex mb-3">
                {{-- campo città --}}
                <div class="col-sm-6 pe-sm-4 mb-3 mb-sm-0">
                    <label for="city" class="form-label fw-semibold mb-2">Città*</label>
                    <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" placeholder="Inserisci la città del ristorante" value="{{old('city')}}" maxlength="50" required>
                    @error('city')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                {{-- campo indirizzo --}}
                <div class="col-sm-6">
                    <label for="street_address" class="form-label fw-semibold mb-2">Indirizzo*</label>
                    <input type="text" class="form-control @error('street_address') is-invalid @enderror" id="street_address" name="street_address" placeholder="Inserisci l'indirizzo del ristorante" value="{{old('street_address')}}" maxlength="100" required>
                    @error('street_address')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="d-sm-flex mb-3">
                {{-- campo codice postale --}}
                <div class="col-sm-6 pe-sm-4 mb-3 mb-sm-0">
                    <label for="postal_code" class="form-label fw-semibold mb-2">Codice Postale*</label>
                    <input type="text" class="form-control @error('postal_code') is-invalid @enderror" id="postal_code" name="postal_code" placeholder="Inserisci il Codice Postale" value="{{old('postal_code')}}" minlength="5" maxlength="5" required>
                    @error('postal_code')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                {{-- campo partita iva --}}
                <div class="col-sm-6">
                    <label for="vat_number" class="form-label fw-semibold mb-2">Partita IVA*</label>
                    <input type="text" class="form-control @error('vat_number') is-invalid @enderror" id="vat_number" name="vat_number" placeholder="Inserisci la partita IVA" value="{{old('vat_number')}}" minlength="11" maxlength="11" required>
                    @error('vat_number')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            {{-- campo immagine --}}
            <div class="mb-3">
                <label for="image" class="form-label fw-semibold">Copertina ristorante</label> 
                <div class="preview-container"></div>
                {{-- preview immagine --}}
                <script>
                    const previewContainer = document.querySelector('.preview-container');
                    // Funzione loadFile per caricare e visualizzare l'immagine di anteprima quando l'utente inserisce un file immagine da caricare
                    const loadFile = function(event) {
                        const reader = new FileReader();
                        reader.onload = function() {
                            const label = document.querySelector('label[for="image"]');
                            const img = document.createElement('img');
                            img.classList.add('mb-3');
                            img.src = reader.result;
                            img.width = 150;
                            previewContainer.appendChild(img);
                        };
                        reader.readAsDataURL(event.target.files[0]);
                    };
                </script>
                {{-- /preview immagine  --}}
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" value="{{old('image')}}" onchange="loadFile(event)">
                @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            {{-- campo cucine --}}
            <div class="kitchens-container mb-3">
                <h6 class="fw-semibold mb-2">Cucina/e*</h6>
                @foreach ($kitchens as $kitchen)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input @error('kitchens') is-invalid @enderror" type="checkbox" id="{{$kitchen->id}}" name="kitchens[]" value="{{$kitchen->id}}" {{ in_array($kitchen->id, old('kitchens', []) ) ? 'checked' : ''}}>
                        <label class="form-check-label" for="{{$kitchen->id}}">{{$kitchen->name}}</label>
                    </div>
                @endforeach
                @error('kitchens')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-success fw-semibold me-1"><i class="fa-solid fa-check me-1"></i> Conferma</button>
            </div>
        </form>
        <script>
            document.getElementById('myForm').addEventListener('submit', function(e) {
                let checkboxes = document.getElementsByName('kitchens[]');
                let checked = false;
                for (let i = 0; i < checkboxes.length; i++) {
                    if (checkboxes[i].checked) {
                    checked = true;
                    break;
                    }
                }
                if (!checked) {
                    e.preventDefault();
                    let errorMessage = document.querySelector('.alert-danger');
                    if (!errorMessage) {
                        errorMessage = document.createElement('div');
                        errorMessage.classList.add('alert', 'alert-danger', 'mt-2');
                        errorMessage.innerHTML = 'Seleziona almeno una casella per procedere';
                        document.querySelector('.kitchens-container').appendChild(errorMessage);
                    }
                } else {
                    let errorMessage = document.querySelector('.alert-danger');
                    if (errorMessage) {
                        errorMessage.remove();
                    }
                }
            });
        </script>
        
        {{-- /form di creazione ristorante --}}
    </div>
@endsection