<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    // Permite "apagar" um itemdo do BD, mas sem realmente apagar.
    // Ele vai marcar o item como apagado, fazendo com que o Model não o encontre mais.
    // É necessário utilizar a função "softDeletes()" no migration, para preparar a tabela.
    use SoftDeletes;

    protected $fillable = [
        'name'
    ];
}
