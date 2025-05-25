<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Bepaal of de gebruiker geautoriseerd is.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Valideer profielgegevens.
     */
    public function rules(): array
    {
        return [
            'name'     => ['required', 'string', 'max:255'],
            'username' => ['nullable', 'string', 'max:50', Rule::unique(User::class)->ignore($this->user()->id)],
            'email'    => ['required', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'birthday' => ['nullable', 'date'],
            'bio'      => ['nullable', 'string', 'max:1000'],
            'profile_photo' => ['nullable', 'image', 'max:4096'],
        ];
    }
}