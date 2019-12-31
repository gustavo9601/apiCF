<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Http\Exceptions\HttpResponseException;

class PostRequest extends FormRequest
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

        //Funcion que define las reglas de validacion para cada item de la peticion
        return [
            "title" => "required|min:5",
            "content" => "required",
            "author_id" => "required"
        ];

    }


    //Sobreescribimos la funcion que define el comportamiento cuando es correcto o invalido los argumentos
    protected function failedValidation(Validator $validator)
    {

        //Lanza una exception como json y le pasamos los errores validados
        throw new HttpResponseException(response()->json([
            'status' => 'error',
            'errors' => $validator->errors()
        ]), 422);

    }


    //Funcion que sobrescribe los mensajes de respuesta
    public function messages()
    {
        return [
            'title.required' => 'Titulo requerido',
            'title.min' => 'Titulo debe ser mayor  a 5 letras',
            'content.required' => "Esta vacio el contenido y es necesario"
        ];

    }


    //Funcion para sanitizar o filtrar los campos
    public function filters()
    {
        return [
            'title' => 'trim|lowercase',
            'content' => 'trim|capitalize|escape'
        ];
    }

}
