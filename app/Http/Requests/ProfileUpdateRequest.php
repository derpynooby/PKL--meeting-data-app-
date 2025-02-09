<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     * This method defines validation rules for updating user profile data
     * 
     * Rules:
     * - name: Must be provided, string type, max 255 chars
     * - email: Must be provided, string type, converted to lowercase, valid email format, max 255 chars, unique in users table (except current user)
     * - role_id: Must be provided and exist in roles table
     * - job_as: Must be provided and be either 'ASN' or 'Non ASN'
     * - profile_image: Optional, must be image file (jpeg,png,jpg,gif,svg), max 2MB
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'role_id' => ['required', 'exists:roles,id'],
            'job_as' => ['required','in:ASN,Non ASN'],
            'profile_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            
        ];
    }
}
