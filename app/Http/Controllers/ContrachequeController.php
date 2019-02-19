<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracheque;

class ContrachequeController extends Controller
{
    
    public function index() {
        return view('auth.contracheque');        
    }

    public function buscaContracheque(Request $request) {
        //var_dump($request);
        $validation = $request->validate([
            'mes'       =>  'required|date_format:"m/Y"',
            'cpf'       =>  'required',
            'matricula' =>  'required'           
        ],
        [
            'mes.required'=> 'Selecione o Mês',
            'cpf.required'   => 'CPF em branco',            
            'matricula.required'   => 'Matricula em branco',
        ]);
                
        //echo $request->cpf;
        $consultaContracheque = Contracheque::where([
            ['cpf', $request->cpf],
            ['matricula', $request->matricula],            
        ])
        ->whereRaw("mes_ano =  to_date('$request->mes', 'mm/yyyy')")
        ->get();

        return response()->json([
            'dados' => view('auth.layoutContracheque')->with('retorno',$consultaContracheque)->render()
        ]);
        
        //return response()->json(['dados' => $html->render()]);
    
        //return view('auth.layoutContracheque')->with('retorno', $consultaContracheque);
        //var_dump($ConsultaContracheque);        
        //return response()->json(['retorno' => $consultaContracheque]);
        //return Redirect::route('login');
    }

}
