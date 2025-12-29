<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tarefas';

    protected $fillable = [
        'titulo',
        'descricao',
        'completado',
    ];
}