<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
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
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|max:100',
            'prefecture_id' => 'required',
            'postcode'      => 'required|string|max:9',
            'city'          => 'nullable|string|max:100',
            'local'         => 'nullable|string|max:100',
            'street_address' => 'nullable|string|max:255',
            'business_hour'  => 'nullable|string|max:100',
            'regular_holiday' => 'nullable|string|max:100',
            'image'           => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120|dimensions:max_width=1280,max_height=720',
            'fax'             => 'nullable|string|max:100',
            'url'             => 'nullable|string|max:255',
            'license_number'  => 'nullable|string',
        ];
    }
}
