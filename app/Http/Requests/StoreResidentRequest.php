<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreResidentRequest extends FormRequest
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
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|unique:residents,email',
            'status' => 'required|string|max:50',
            'profile_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'birthday' => 'required|date',
            'address' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'gender' => 'required|string|in:male,female,other',
            'school_level' => 'nullable|string|max:100',
            'date_joined' => 'required|date',
            'date_detached' => 'nullable|date|after_or_equal:date_joined',
            'urgent_contact' => 'required|string|max:15',
            'school' => 'nullable|string|max:255',
            'health_condition' => 'nullable|string|max:255',
            'disease_type' => 'nullable|string|max:255',
            'room_id' => 'required|exists:rooms,id',
        ];
    }
}
