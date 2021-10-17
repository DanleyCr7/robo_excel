<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
    protected $table = 'turmas'; 

    protected $fillable = [            
        'CIDADE',	
        'BAIRRO',	
        'COMPLEMENTO',	
        'NUMERO',	
        'ENDERECO',	
        'NOME_DA_MAE',	
        'NOME_DO_PAI',	
        'ESTADO_IDENT',	
        'DATA_EXPEDICAO',	
        'ORGAO_EXP',	
        'NUM_DE_IDENTIDADE',	
        'CPF',	
        'EMAIL',	
        'TELEFONES',	
        'NATURALIDADE',	
        'TURNO',	
        'PERIODO',	
        'CURSO',	
        'NASCIMENTO',	
        'TURMA',	
        'SITUACAO_PERIODO',	
        'NOME',	
        'MATRICULA'
    ];
}
