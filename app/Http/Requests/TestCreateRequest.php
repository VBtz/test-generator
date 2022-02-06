<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestCreateRequest extends FormRequest {

    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'name' => 'required|unique:tests|max:50'
        ];
    }

    public function messages() {
        return [
            'name.required' => 'Название тестирования не может быть пустым',
            'name.unique' => 'Тестирование с таким именем уже существует',
            'name.max' => 'Тестирование не может быть больше max: символов'
        ];
    }
}
