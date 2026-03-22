<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Tymon\JWTAuth\Facades\JWTAuth;

class StoreCommandeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // authentifier le user JWTAuth::parseToken()->authenticate()
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
            'adresse_livraison' => 'required|string|min:10',
            // 'produit_id' => 'required|integer|exists:produits,id_produit',
            'quantite' => 'required|integer|min:1'
        ];
    }
}
