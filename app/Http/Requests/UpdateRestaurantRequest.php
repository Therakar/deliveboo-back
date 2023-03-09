<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRestaurantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:50',
            'city' => 'required|string|max:50',
            'street_address' => 'required|string|max:100',
            'postal_code' => 'required|numeric|digits:5',
            'vat_number' => ['required', Rule::unique('restaurants')->ignore($this->restaurant), 'numeric', 'digits:11'],
            'image' => 'nullable|image|max:2048',
            'no_image' => 'nullable',
            'kitchens' => 'required|exists:kitchens,id'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Attenzione: il nome è richiesto.',
            'name.string' => 'Attenzione: il nome deve essere una sequenza di caratteri alfabetici, numerici e/o speciali.',
            'name.max' => 'Attenzione: il nome non può superare i 50 caratteri, spazi inclusi.',
            'city.required' => 'Attenzione: la città è richiesta.',
            'city.string' => 'Attenzione: la città deve essere una sequenza di caratteri alfabetici, numerici e/o speciali.',
            'city.max' => 'Attenzione: la città non può superare i 50 caratteri, spazi inclusi.',
            'street_address.required' => 'Attenzione: l\'indirizzo è richiesto.',
            'street_address.string' => 'Attenzione: l\'indirizzo deve essere una sequenza di caratteri alfabetici, numerici e/o speciali.',
            'street_address.max' => 'Attenzione: l\'indirizzo non può superare i 100 caratteri, spazi inclusi.',
            'postal_code.required' => 'Attenzione: il codice postale è richiesto.',
            'postal_code.numeric' => 'Attenzione: il codice postale deve essere una sequenza di 5 cifre.',
            'postal_code.digits' => 'Attenzione: il codice postale deve contenere esattamente 5 cifre.',
            'vat_number.required' => 'Attenzione: il numero di partita IVA è richiesto.',
            'vat_number.unique' => 'Attenzione: questo numero di partita IVA è già stato registrato.',
            'vat_number.numeric' => 'Attenzione: il numero di partita IVA deve essere una sequenza di 11 cifre.',
            'vat_number.digits' => 'Attenzione: il numero di partita IVA deve contenere esattamente 11 cifre.',
            'image.image' => 'Attenzione: il file deve essere un\'immagine (jpg, jpeg, png, bmp, gif, svg, o webp).',
            'image.uploaded' => 'Attenzione: la dimensione dell\'immagine non può superare i 2 MB.',
            'kitchens.required' => 'Attenzione: è richiesta almeno una tipologia di cucina.'
        ];
    }
}
