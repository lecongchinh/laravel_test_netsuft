<?php

namespace App\Http\Requests\Staffs;

use Illuminate\Foundation\Http\FormRequest;

class SearchDayWorkRequest extends FormRequest
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
            'from_day' => 'required_with:to_day,email|nullable|integer|lte:to_day',
            'to_day' => 'required_with:from_day,email|nullable|integer',
            'email' => 'required_with:from_day,to_day|nullable|email:rfc,dns' 
        ];
    }
}
