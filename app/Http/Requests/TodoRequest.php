<?php

namespace App\Http\Requests;

use App\Todo;
use Illuminate\Foundation\Http\FormRequest;

class TodoRequest extends FormRequest
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
            'id' => 'nullable|numeric',
//            'todo'=>'required|unique:todos,todo' . $this->user_id,
            'todo' => [
                'required',
                function ($attribute, $value, $fail) {
//                    $data = Todo::where('todo', $this->get('todo'))->where('')->get();
                    if (Todo::where(function ($query) {
                        $query->where('todo', $this->get('todo'));
                    })->where('user_id', session('id'))->get()->isNotEmpty()) {
                        $fail(' Already Taken!');
                    }

                },

            ],

        ];
    }
}
