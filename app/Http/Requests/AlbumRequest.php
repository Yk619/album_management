<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlbumRequest extends FormRequest{
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
        $id = $this->request->get('album_id');
        $rule = [
            'title' => 'required|min:3|max:50|unique:albums,title,'.$id,
            'description' => 'required',
        ];
        if(!$id){
            $rule['image'] = 'required';
            $rule['image.*'] = 'image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }
        return $rule;
    }
}
