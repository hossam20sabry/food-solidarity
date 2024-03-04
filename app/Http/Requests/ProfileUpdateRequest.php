<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $guard = $this->route('guard');
        $user = Auth::guard($guard)->user();
        
        return [
            'name' => ['required', 'string', 'max:255', 'not_regex:/<\s*script|<\s*\/script\s*>|<\s*html|<\s*\/html\s*>/i'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(get_class($user))->ignore($user->id), 'not_regex:/<\s*script|<\s*\/script\s*>|<\s*html|<\s*\/html\s*>/i'],
        ];
    }
}
