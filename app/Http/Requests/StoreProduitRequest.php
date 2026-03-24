<?php

namespace App\Http\Requests;

// use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProduitRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nom_produit' => 'required|string|min:1',
            'description_produit' => 'required|string',
            'stock_produit' => 'required|integer|min:0',
            'prix_produit' => 'required|numeric|min:0.1',
            'categorie_id' => 'required|integer|exists:categories,id_categorie',
        ];
    }
}
