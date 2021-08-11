<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CalculatorRequest extends FormRequest
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
            'object_price'  => ['required', 'integer', 'min:500000', 'max:5000000'],
            'started_sum'   => ['required', 'integer', 'min:100000', 'max:5000000'],
            'period_monthes'=> ['required', 'integer', 'min:12', 'max:36']
        ];
    }
}
