<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;
    protected $fillable = ["nome", "imagem"];

    public function ruler(){
        return [
            'nome' => 'required|unique:marcas,nome,'.$this->id.'|min:3',
            'imagem' => 'required|file|mimes:png,dock,xlsx,pdf,ppt,jpeg,mp3'
        ];


        /*
         3 parametros na regra unique
         1) tabela
         2) o nome da coluna que sera pesquisada na tabela (caso nao apresente esse dado ele pega o nome do input e busca a coluna com aquele nome)
         3) id do registro que será desconsiderado na pesquisa
        */
    }

    public function feedback(){
        return [
            'required' => 'O campo :attribute é obrigatório',
            'nome.unique' => 'O nome da marca já existe',
            'nome.min' => 'O nome deve ter no mínimo 3 caracteres',
            'mimes' => "O arquivo não e suportado ou nao atende os tipo desponiveis"
        ];
    }
}
