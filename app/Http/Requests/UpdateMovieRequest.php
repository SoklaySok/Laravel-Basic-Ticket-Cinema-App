<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMovieRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => [
                'sometimes',
                'string',
                'max:255',
            ],

            'description' => [
                'sometimes',
                'nullable',
                'string',
            ],

            'duration' => [
                'sometimes',
                'integer',
                'min:1',
            ],

            'genre' => [
                'sometimes',
                'string',
                'max:100',
            ],

            'language' => [
                'sometimes',
                'string',
                'max:100',
            ],

            'rating' => [
                'sometimes',
                'nullable',
                'string',
                'max:20',
            ],

            'release_date' => [
                'sometimes',
                'nullable',
                'date',
            ],

            'poster' => [
                'sometimes',
                'nullable',
                'string',
                'max:500',
            ],

            'status' => [
                'sometimes',
                Rule::in([
                    'coming_soon',
                    'now_showing',
                    'ended',
                ]),
            ],
        ];
    }
}