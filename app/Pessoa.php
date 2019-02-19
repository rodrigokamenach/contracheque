<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    protected $table = "vetorh.r034fun";

    protected $fillable = [
        'numcad', 'nomfun', 'numcpf', 'numemp', 'sitafa', 'tipcol'
    ];
}
