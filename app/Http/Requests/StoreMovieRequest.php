<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMovieRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'duration' => [
                'required',
                'integer',
                'min:1',
            ],

            'genre' => [
                'required',
                'string',
                'max:100',
            ],

            'language' => [
                'required',
                'string',
                'max:100',
            ],

            'rating' => [
                'nullable',
                'string',
                'max:20',
            ],

            'release_date' => [
                'nullable',
                'date',
            ],

            'poster' => [
                'nullable',
                'string',
                'max:500',
            ],

            'status' => [
                'required',
                Rule::in([
                    'coming_soon',
                    'now_showing',
                    'ended',
                ]),
            ],
        ];
    }
}