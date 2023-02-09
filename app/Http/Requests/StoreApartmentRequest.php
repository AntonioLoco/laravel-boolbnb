<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreApartmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|max:255|unique:apartments',
            'description' => 'nullable',
            'rooms_number' => 'required|numeric',
            'beds_number' => 'required|numeric',
            'bathrooms_number' => 'required|numeric',
            'square_meters' => 'required|numeric',
            'cover_image' => 'max:255|image',
            'visible' => 'boolean',
            'category_id' => 'exists:category,id',
            'services' => 'exists:service,id',
            'latitude' => 'numeric',
            'longitude' => 'numeric',
            'street_address' => 'max:255|required',
            'house_number' => 'numeric',
            'postal_code' => 'max:7|required'
        ];
    }
}
