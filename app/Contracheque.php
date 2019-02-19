<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contracheque extends Model
{    
    protected $table = "vetorh.gf_vw_contra_cheque";    
    protected $fillable = [
        'cod_empresa',
        'empresa', 
        'cpf',
        'telefone',
        'MATRICULA',
        'nome_funcionario',
        'mes_ano',
        'codccu',
        'nomccu',
        'local',
        'cargo',
        'salario_base',
        'tipo',
        'codeve',
        'deseve',
        'refeve',
        'valeve',
        'proventos',
        'descontos',
        'liquido',
        'base_irrf',
        'base_fgts',
        'base_inss'
    ];    
    protected $dates = ['mes_ano'];
    protected $casts = ['mes_ano' => 'date:m/Y'];
    //protected $dateFormat = 'm Y';
}
