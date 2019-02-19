<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pessoa;

class PessoaController extends Controller
{
    public function getpessoa($cpf) {
        $pessoa = Pessoa::join('vetorh.r034cpl', function($join) {
            $join->on('vetorh.r034fun.numemp','=', 'vetorh.r034cpl.numemp');
            $join->on('vetorh.r034fun.tipcol','=', 'vetorh.r034cpl.tipcol');
            $join->on('vetorh.r034fun.numcad','=', 'vetorh.r034cpl.numcad');
        })                
        ->where([
            ['vetorh.r034fun.numcpf', $cpf],
            ['vetorh.r034fun.sitafa','<>', 7],
        ])        
        ->get(
            [
                'vetorh.r034fun.numcad',
                'vetorh.r034fun.nomfun', 
                'vetorh.r034cpl.numtel',
                'vetorh.r034cpl.dddtel'
            ]               
        );
        
        //echo $pessoa->isEmpty();
        if ($pessoa->isEmpty() <> 1) {
            return $pessoa;
        } else {
            return false;
        }
        
         
    }
}
