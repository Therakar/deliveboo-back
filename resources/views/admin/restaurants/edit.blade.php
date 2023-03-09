@extends('layouts.admin')

@section('page-title')
    Modifica ristorante
@endsection

@section('content')
    <div class="container py-4">
        <h2 class="fw-semibold text-center mb-4">Modifica "{{ $restaurant->name }}"</h2>
        <div class="w-100">
            @include('partials.message')
        </div>
        {{-- form di modifica ristorante --}}
        <form action="{{ route('admin.restaurants.update', $restaurant) }}" id="myForm" method="POST" enctype="multipart/form-data" class="mb-5">
        @csrf
        @method('PUT')
            {{-- campo nome --}}
            <div class="mb-3">
               <label for="name" class="form-label fw-semibold mb-2">Nome*</label>
               <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Inserisci il nome del ristorante" value="{{ old('name', $restaurant->name) }}" maxlength="100" required>
               @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="d-sm-flex mb-3">
                {{-- campo città --}}
                <div class="col-sm-6 pe-sm-4 mb-3 mb-sm-0">
                    <label for="city" class="form-label fw-semibold mb-2">Città*</label>
                    <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" placeholder="Inserisci la città del ristorante" value="{{old('city', $restaurant->city)}}" maxlength="50" required>
                    @error('city')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                {{-- campo indirizzo --}}
                <div class="col-sm-6">
                    <label for="street_address" class="form-label fw-semibold mb-2">Indirizzo*</label>
                    <input type="text" class="form-control @error('street_address') is-invalid @enderror" id="street_address" name="street_address" placeholder="Inserisci l'indirizzo del ristorante" value="{{old('street_address', $restaurant->street_address)}}" maxlength="100" required>
                    @error('street_address')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="d-sm-flex mb-3">
                {{-- campo codice postale --}}
                <div class="col-sm-6 pe-sm-4 mb-3 mb-sm-0">
                    <label for="postal_code" class="form-label fw-semibold mb-2">Codice Postale*</label>
                    <input type="text" class="form-control @error('postal_code') is-invalid @enderror" id="postal_code" name="postal_code" placeholder="Inserisci il Codice Postale" value="{{old('postal_code', $restaurant->postal_code)}}" minlength="5" maxlength="5" required>
                    @error('postal_code')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                {{-- campo partita iva --}}
                <div class="col-sm-6">
                    <label for="vat_number" class="form-label fw-semibold mb-2">Partita IVA*</label>
                    <input type="text" class="form-control @error('vat_number') is-invalid @enderror" id="vat_number" name="vat_number" placeholder="Inserisci la partita IVA" value="{{ old('vat_number', $restaurant->vat_number) }}" minlength="11" maxlength="11" required>
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
                    // Funzione loadFile per caricare e visualizzare l'immagine di anteprima quando l'utente inserisce un nuovo file immagine da caricare
                    const loadFile = function(event) {
                        const reader = new FileReader();
                        reader.onload = function() {
                            const label = document.querySelector('label[for="image"]');
                            const img = document.createElement('img');
                            img.classList.add('mb-3');
                            img.src = reader.result;
                            img.width = 150;
                            previewContainer.innerHTML = ''; // Rimuovi eventuali preview precedenti
                            previewContainer.appendChild(img);
                        };
                        reader.readAsDataURL(event.target.files[0]);
                    };
                
                    // Funzione per generare un elemento immagine
                    function createImageElement(src, width) {
                        const img = document.createElement('img');
                        img.src = src;
                        img.width = width;
                        img.classList.add('mb-2');
                        return img;
                    }

                    // Controllo se è presente un'immagine di anteprima predefinita del ristorante, se è presente mostra la preview immagine al caricamento della pagina
                    const restaurantImage = "{{ $restaurant->image }}";
                    if (restaurantImage) {
                        if (restaurantImage.startsWith('http') && restaurantImage != 'https://www.ilborghista.it/immaginiutente/attivita_foto/300_m_32915-ath0q9p5q6b3m7b3b8p7x9k3x4v9q4k5b5w3l1z1d6k5q1g6p3k7.jpg?a=9192') {
                            const img = createImageElement(restaurantImage, 150);
                            previewContainer.innerHTML = ''; // Rimuovi eventuali preview precedenti
                            previewContainer.appendChild(img);
                        } else if (restaurantImage != 'https://www.ilborghista.it/immaginiutente/attivita_foto/300_m_32915-ath0q9p5q6b3m7b3b8p7x9k3x4v9q4k5b5w3l1z1d6k5q1g6p3k7.jpg?a=9192') {
                            const img = createImageElement(`{{ asset('storage/${restaurantImage}') }}`, 150);
                            previewContainer.innerHTML = ''; // Rimuovi eventuali preview precedenti
                            previewContainer.appendChild(img);
                        }
                    }
                </script>
                {{-- /preview immagine  --}}
                {{-- checkbox no_image --}}
                @if ($restaurant->image != 'https://www.ilborghista.it/immaginiutente/attivita_foto/300_m_32915-ath0q9p5q6b3m7b3b8p7x9k3x4v9q4k5b5w3l1z1d6k5q1g6p3k7.jpg?a=9192')
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" name="no_image" type="checkbox" role="switch" id="no_image">
                        <label class="form-check-label" for="no_image">Rimuovi immagine (verrà applicata un'immagine placeholder)</label>
                    </div>
                @endif
                {{-- /checkbox no_image --}}
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" value="{{ old('image', $restaurant->image) }}" onchange="loadFile(event)">
                @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                {{-- script checkbox no_image --}}
                <script>
                    const inputCheckbox = document.getElementById('no_image');
                    const inputFile = document.getElementById('image');
                    if (inputCheckbox.checked) {
                        inputFile.disabled = true;
                    }
                    inputCheckbox.addEventListener('change', function() {
                        if (inputCheckbox.checked) {
                            inputFile.disabled = true;
                        } else {
                            inputFile.disabled = false;
                        }
                    });
                </script>
                {{-- /script checkbox no_image --}}
            </div>
            {{-- campo cucine --}}
            <div class="kitchens-container mb-3">
                <h6 class="fw-semibold mb-2">Cucina/e*</h6>
                @foreach ($kitchens as $kitchen)
                    <div class="form-check form-check-inline">
                        @if( $errors->any() )
                            {{-- in caso di validazione fallita: --}}
                            <input class="form-check-input" type="checkbox" id="{{$kitchen->id}}" name="kitchens[]" value="{{$kitchen->id}}" {{ in_array($kitchen->id, old('kitchens', []) ) ? 'checked' : ''}}>
                        @else
                            {{-- per avere già flaggate le eventuali "kitchens" già associate: --}}
                            <input class="form-check-input " type="checkbox" id="{{ $kitchen->id }}" name="kitchens[]" value="{{ $kitchen->id }}" {{ $restaurant->kitchens->contains($kitchen->id) ? 'checked' : '' }}>
                        @endif
                            <label class="form-check-label" for="{{$kitchen->id}}">{{$kitchen->name}}</label>
                    </div>
                @endforeach
                @error('kitchens')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-success fw-semibold me-1"><i class="fa-solid fa-check me-1"></i> Conferma</button>
                <a href="{{ route('admin.restaurants.show', Auth::user()->restaurant)}}" class="btn btn-primary fw-semibold"><i class="fa-solid fa-delete-left me-1"></i> Annulla</a>
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
    </div>
@endsection