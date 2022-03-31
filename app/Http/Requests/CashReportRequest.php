<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CashReportRequest extends FormRequest
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
            'gl_code_id' => 'required',
            'file' => 'mimes:pdf',
            'employee_id' => 'nullable',
            'invoice_date' => 'required',
            'dollar' => 'nullable',
            'description' => 'required',
            'sar' => 'required',
            'type' => 'required',
            'job_no' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'employee_id.required' => 'Please select employee.',
            'invoice_date.required' => 'The date is required.',
        ];
    }

}
