<?php

namespace App\Http\Requests;

// use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProduitRequest extends FormRequest
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
            'nom_produit' => 'sometimes|string|min:1',
            'description_produit' => 'sometimes|string',
            'stock_produit' => 'sometimes|integer|min:0',
            'prix_produit' => 'sometimes|numeric|min:0.1',
            'categorie_id' => 'sometimes|integer|exists:categories,id_categorie',
        ];
    }
}
