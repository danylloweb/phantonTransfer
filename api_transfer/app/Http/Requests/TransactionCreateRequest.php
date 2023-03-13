<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionCreateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'value'    => 'bail|required|numeric|min:1',
            'payer_id' => 'required|numeric|exists:users,id',
            'payee_id' => 'required|numeric|exists:users,id',
        ];
    }

    /**
     * @return array|string[]
     */
    public function messages()
    {
        return [
            'value.required'    => 'O valor é obrigatório',
            'value.numeric'     => 'Valor no formato inválido',
            'value.min'         => 'Valor abaixo do permitido',
            'payer_id.required' => 'Pagador é obrigatório',
            'payer_id.numeric'  => 'Pagador formato inválido',
            'payer_id.exists'   => 'Esse Pagador não existe ou com ID inválido',
            'payee_id.required' => 'Recebedor é obrigatório',
            'payee_id.numeric'  => 'Recebedor formato inválido',
            'payee_id.exists'   => 'Esse Recebedor não existe ou com ID inválido',
        ];
    }
}
