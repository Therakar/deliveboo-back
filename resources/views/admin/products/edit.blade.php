@extends('layouts.admin')

@section('page-title')
    Modifica prodotto 
@endsection

@section('content')
    <div class="container py-4">
        <h2 class="fw-semibold text-center mb-4">Modifica "{{ $product->name }}"</h2>
        <div class="w-100">
            @include('partials.message')
        </div>
        {{-- form di modifica prodotto --}}
        <form action="{{route('admin.products.update', $product)}}" method="POST" enctype="multipart/form-data" class="mb-5">
        @csrf
        @method('PUT')
            {{-- campo nome --}}
            <div class="mb-3">
                <label for="name" class="form-label fw-semibold mb-2 fw-semibold mb-2">Nome*</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Inserisci il nome di questo prodotto" value="{{old('name', $product->name)}}" maxlength="100" required>
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
             {{-- campo disponibilità --}}
             <div class="mb-3 w-25">
                <label for="is_available" class="form-label fw-semibold mb-2">Disponibilità*</label>
                <select name="is_available" id="is_available" class="form-select @error('is_available') is-invalid @enderror" required>
                    <option value="1" {{ old('is_available', $product->is_available) == 1 ? 'selected' : ''}}>Disponibile</option>
                    <option value="0" {{ old('is_available', $product->is_available) == 0 ? 'selected' : ''}}>Non disponibile</option>
                </select>
                @error('is_available')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            {{-- campo tipologia --}}
            <div class="mb-3 w-25">
                <label for="typology" class="form-label fw-semibold mb-2">Tipologia*</label>
                <select name="typology" id="typology" class="form-select @error('typology') is-invalid @enderror" required>
                    <option value="" disabled selected>Seleziona una tipologia</option>
                    @foreach($typologies as $typology)
                        <option value="{{ $typology->typology }}" {{ old('typology', $product->typology) == $typology->typology ? 'selected' : '' }}>{{ ucfirst($typology->typology) }}</option>
                    @endforeach
                </select>
                @error('typology')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            {{-- campo descrizione --}}
            <div class="mb-3">
                <label for="description" class="form-label fw-semibold mb-2">Descrizione prodotto*</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5" placeholder="Descrivi il tuo prodotto..." minlength="10" maxlength="500" required>{{old('description', $product->description)}}</textarea>
                @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            {{-- campo ingredienti --}}
            <div class="mb-3">
                <label for="ingredients" class="form-label fw-semibold mb-2 @error('ingredients') is-invalid @enderror">Elenco ingredienti*</label>
                <textarea class="form-control" id="ingredients" name="ingredients" rows="5" placeholder="Elenca gli ingredienti del tuo prodotto..." minlength="10" maxlength="500" required>{{old('ingredients', $product->ingredients)}}</textarea>
                @error('ingredients')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            {{-- campo prezzo --}}
            <div class="mb-3 w-25">
                <label for="price" class="form-label fw-semibold mb-2 @error('price') is-invalid @enderror">Prezzo*</label>
                <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $product->price) }}" min="0" step=".01" max="99.99" placeholder="00,00" required>
                @error('price')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            {{-- campo immagine --}}
            <div class="mb-3 w-50">
                <label for="image" class="form-label fw-semibold">Immagine prodotto</label> 
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
                    const productImage = "{{ $product->image }}";
                    if (productImage) {
                        if (productImage.startsWith('http') && productImage != 'https://images-ext-1.discordapp.net/external/WSCfXdJSu7xxp0MoqcrFbd169K36Fqa8oCjUW4TQfQs/https/hudsonvalley.org/wp-content/sabai/File/files/l_e205c25b233d904b3725455155344204.png?width=791&height=593') {
                            const img = createImageElement(productImage, 150);
                            previewContainer.innerHTML = ''; // Rimuovi eventuali preview precedenti
                            previewContainer.appendChild(img);
                        } else if (productImage != 'https://images-ext-1.discordapp.net/external/WSCfXdJSu7xxp0MoqcrFbd169K36Fqa8oCjUW4TQfQs/https/hudsonvalley.org/wp-content/sabai/File/files/l_e205c25b233d904b3725455155344204.png?width=791&height=593') {
                            const img = createImageElement(`{{ asset('storage/${productImage}') }}`, 150);
                            previewContainer.innerHTML = ''; // Rimuovi eventuali preview precedenti
                            previewContainer.appendChild(img);
                        }
                    }
                </script>
                {{-- /preview immagine  --}}
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" value="{{old('image', $product->image)}}" onchange="loadFile(event)">
                @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-success fw-semibold me-2"><i class="fa-solid fa-check me-1"></i> Conferma</button>
                <a href="{{ route('admin.products.index')}}" class="btn btn-primary fw-semibold"><i class="fa-solid fa-delete-left me-1"></i> Annulla</a>
            </div>
        </form>
        {{-- /form di modifica prodotto --}}
    </div>
@endsection