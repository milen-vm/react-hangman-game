<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GalleryDownloadRequest extends FormRequest
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
            'site' => ['required', 'in:vipr,imx'],
            'galleryUrl' => ['required_without:isHtml'],
            'baseName' => ['required'],
            'html' => ['required_if:isHtml,on'],
        ];
    }
}
