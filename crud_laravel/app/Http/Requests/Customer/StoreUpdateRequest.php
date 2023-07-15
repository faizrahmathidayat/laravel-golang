<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateRequest extends FormRequest
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
        $add_rule_unique_on_update = isset($this->id) ? ','.$this->id.',cst_id' : '';
        $rules = array(
            'cst_name' => 'required',
            'cst_dob' => 'required',
            'cst_phone_num' => 'required|numeric|unique:customers,cst_phone_num'.$add_rule_unique_on_update,
            'cst_email' => 'required|email|unique:customers,cst_email'.$add_rule_unique_on_update,
            'nationality_id' => 'required',
            'fl_relation'    => 'required|array',
            'fl_relation.*'  => 'required|string',
            'fl_dob'    => 'required|array',
            'fl_dob.*'  => 'required',
            'fl_name'    => 'required|array',
            'fl_name.*'  => 'required|string',
        );
        return $rules;
    }

    public function messages()
    {
        $message =  array(
            'required' => ':attribute tidak boleh kosong.',
            'required.*' => ':attribute tidak boleh kosong.',
            'numeric' => ':attribute harus berupa angka.',
            'unique' => ':attribute sudah digunakan.',
            'email' => ':attribute tidak sesuai.',
            'array' => ':attribute harus berupa array.'
        );

        return $message;
    }

    public function attributes()
    {
        $attribute = array(
            'cst_name' => 'Nama',
            'cst_dob' => 'Tanggal Lahir',
            'cst_phone_num' => 'Telepon',
            'cst_email' => 'Email',
            'nationality_id' => 'Kewarganegaraan',
            'fl_relation.*' => 'Hubungan',
            'fl_dob.*' => 'Tanggal Lahir',
            'fl_name.*' => 'Nama',
        );

        return $attribute;
    }
}
