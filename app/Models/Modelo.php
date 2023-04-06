<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    use HasFactory;

    protected $table = 'modelos';

    protected $fillable = ['marca_id', 'nome', 'imagem', 'numero_portas', 'lugares', 'air_bag', 'abs'];

    public function rules()
    {
        return [
            'marca_id' => 'exists:marcas,id',
            'nome' => 'required|unique:modelos,nome,' . $this->id . '|min:3',
            'imagem' => 'required|file|mimes:png,jpeg,jpg',
            'numero_portas' => 'required|integer|digits_between:1,5',
            'lugares' => 'required|integer|digits_between:1,20',
            'air_bag' => 'required|boolean',
            'abs' => 'required|boolean'
        ];
    }

    public function feedback()
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'nome.unique' => 'O nome do modelo já está cadastrado',
            'imagem.mimes' => 'A imagem deve ser do tipo PNG, JPEG ou JPG',
            'numero_portas.digits_between' => 'O número de portas deve ser entre 1 e 5',
            'lugares.digits_between' => 'O número de lugares deve ser entre 1 e 20',
            'boolean' => 'O campo :attribute deve ser verdadeiro ou falso'
        ];
    }

    public function marca()
    {
        return $this->belongsTo('App\Models\Marca', 'marca_id', 'id');
    }
}
