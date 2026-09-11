<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class DisciplinaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

     protected function prepareForValidation() {

        $this->merge(
            collect($this->all())->map(function ($value) {
                return is_string($value) ? Str::upper($value) : $value;
            })->toArray()
        );
    }

    public function messages(): array {
        return [
            "required" => "O preenchimento deste campo é obrigatório!",
            "max" => "Este campo possui tamanho máximo de [:max] caracteres!",
            "min" => "Este campo possui tamanho mínimo de [:min] caracteres!",
            "nome.unique" => "Já existe uma disciplina cadastrada com este nome!",
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->route('disciplina');

        return [
            'nome' => "required|max:100|min:8|unique:disciplinas,nome,{$id}",
            'carga_horaria' => "required",
            'curso_id' => "required|exists:cursos,id",
        ];
    }
}
