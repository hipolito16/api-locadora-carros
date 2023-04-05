<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carro extends Model
{
    use HasFactory;

    protected $table = 'carros';

    protected $fillable = ['modelo_id', 'placa', 'disponivel', 'km'];

    public function rules()
    {
        return [
            'modelo_id' => 'exists:modelos,id',
            'placa' => 'required|unique:carros,placa,' . $this->id . '|min:7|max:7',
            'disponivel' => 'required|boolean',
            'km' => 'required|integer|digits_between:1,999999'
        ];
    }

    public function feedback()
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'placa.unique' => 'A placa já existe',
            'placa.min' => 'A placa deve ter no mínimo 7 caracteres',
            'placa.max' => 'A placa deve ter no máximo 7 caracteres',
            'modelo_id.exists' => 'O modelo não existe'
        ];
    }

    public function modelo()
    {
        return $this->belongsTo('App\Models\Modelo', 'modelo_id', 'id');
    }
}
