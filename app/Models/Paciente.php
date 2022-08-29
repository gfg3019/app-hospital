<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Paciente extends Model
{
    use HasFactory;

    protected $modelPaciente;
    protected $table = 'pacientes';
    protected $fillable = [
        'endereco_id',
        'nome',
        'sexo',
        'email',
        'telefone',
        'data_nascimento',
    ];

    public function endereco()
    {
        return $this->belongsTo(Endereco::class, 'endereco_id');
    }

    public function consulta()
    {
        return $this->hasMany(Consulta::class, 'consulta_id');
    }
}
