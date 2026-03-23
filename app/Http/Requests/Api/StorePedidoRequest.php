<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StorePedidoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'descricao' => ['required', 'string', 'max:255'],
            'nome_cliente' => ['required', 'string', 'max:255'],

            'itens' => ['required', 'array', 'min:1'],

            'itens.*.produto' => ['required', 'string', 'max:255'],
            'itens.*.preco' => ['required', 'numeric', 'min:0'],
            'itens.*.quantidade' => ['required', 'integer', 'min:1'],
        ];
    }

    public function messages(): array
    {
        return [
            'descricao.required' => 'Descrição é obrigatória',
            'nome_cliente.required' => 'Nome do cliente é obrigatório',
            'itens.required' => 'Itens do pedido são obrigatórios',
            'itens.array' => 'Itens deve ser um array',
            'itens.min' => 'Pedido precisa ter ao menos 1 item',

            'itens.*.produto.required' => 'Produto é obrigatório',
            'itens.*.preco.required' => 'Preço é obrigatório',
            'itens.*.quantidade.required' => 'Quantidade é obrigatória',
        ];
    }
}