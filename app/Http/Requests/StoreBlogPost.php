<?php

namespace App\Http\Requests;

use App\Films;
use Auth;
use Illuminate\Foundation\Http\FormRequest;
use App\Providers\AppServiceProvider;
class StoreBlogPost extends FormRequest
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
            'name' => 'required',
            'information' => 'required',
            'image'=>'image',
            ];
    }
}
