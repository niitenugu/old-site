<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user = User::whereUid($this->user)->first(['uid', 'id', 'email']);
        
        switch ($this->method()) {
            case 'POST':
            {
                return [
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    'phone' => ['nullable', 'max:14', 'min:8'],
                    'role' => ['required', 'string', 'max:50'],
                    'password' => ['required', 'string', 'min:8', 'confirmed'],
                    'photo'=>'nullable|mimes:jpeg,jpg,png|max:800', //Max 800KB
                ];
            }
            case 'PUT':
            {
                return [
                    'name' => ['required', 'string', 'max:255'],
                    'email' => 'required|string|max:255|email|unique:users,email,'.$user->id,
                    'phone' => ['nullable', 'max:14', 'min:8'],
                    'role' => ['required', 'string', 'max:50'],
                    'is_active' => ['required'],
                    'photo'=>'nullable|mimes:jpeg,jpg,png|max:800', //Max 800KB
                ];
            }            
            default:
                break;
        }
    }

    public function messages()
    {
        return [
            'status.required' => 'User status is required',
        ];
    }
}
