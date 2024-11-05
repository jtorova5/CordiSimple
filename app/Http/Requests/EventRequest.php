<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Cambia a true para autorizar la solicitud
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'max_capacity' => 'required|integer|min:1', // Cambiado a 'max_capacity'
            'updatedAt' => 'nullable|date',
            // 'admin_id' => 'required|exists:admins,id', // Cambiado a 'admin_id'
            // 'soldId' => 'nullable|exists:sales,id',
        ];
    }
    

    /**
     * Get custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The event name is required.',
            'date.required' => 'The event date is required.',
            'date.date' => 'Please provide a valid date.',
            'location.required' => 'The location is required.',
            'maxcapacity.required' => 'The maximum capacity is required.',
            'maxcapacity.integer' => 'The maximum capacity must be a valid number.',
            // 'adminId.required' => 'The admin ID is required.',
            // 'adminId.exists' => 'The admin ID must exist in the admins table.',
            // 'soldId.exists' => 'The sold ID must exist in the sales table if provided.',
        ];
    }
}
