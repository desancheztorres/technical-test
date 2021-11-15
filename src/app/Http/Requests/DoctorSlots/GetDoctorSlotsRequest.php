<?php

namespace App\Http\Requests\DoctorSlots;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Src\Shared\Domain\Enums\SortTypes;

class GetDoctorSlotsRequest extends FormRequest
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
        return [
            'sort_type' => ['required', Rule::in(array_keys(SortTypes::SORT_TYPES))],
            'date_from' => 'required|date',
            'date_to' => 'required|date',
        ];
    }
}
