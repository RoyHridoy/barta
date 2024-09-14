<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class UpdateUserProfileRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'firstName' => ['required', 'string'],
            'lastName'  => ['required', 'string'],
            'username'  => ['nullable', 'string', Rule::unique( User::class )->ignore( $this->user()->id )],
            'email'     => ['required', 'email', Rule::unique( User::class )->ignore( $this->user()->id )],
            'password'  => ['required', 'current_password'],
            'bio'       => ['string', 'nullable'],
            'avatar'    => ['nullable', File::image()->max('500kb')],
        ];
    }
}
