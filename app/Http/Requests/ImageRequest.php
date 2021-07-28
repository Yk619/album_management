<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImageRequest extends FormRequest{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(){
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(){
        $id = $this->request->get('image_id');
        return [
            'title' => 'required|min:3|max:50|unique:images,title,'.$id,
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg',
        ];
    }
}
