<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SendCode;
use App\User;

class RegistroController extends Controller
{
    protected $pessoaController;

    public function __construct(PessoaController $pessoaController) {
        $this->pessoaController = $pessoaController;
    }

    public function registro(Request $request) {
        //print_r($request->input());
        
        $validationReq = $request->validate([
            'cpf_reg'   =>  'required',
            'senha_reg' =>  'required',
            'confirma'  =>  'required|same:senha_reg'
        ],
        [
            'cpf_reg.required'  => 'CPF é obrigatorio',
            'senha_reg.required'=> 'Digite a senha',
            'confirma.required' => 'Digite a confirmação',
            'confirma.same'     => 'A confirmação deve ser igual a senha'
        ]);

        $dadospessoa = $this->pessoaController->getPessoa($request->cpf_reg);
        
        if ($dadospessoa) {
            foreach ($dadospessoa as $key => $value) {
                //echo $key;
                $numcad = $value->numcad;
                $nomfun = $value->nomfun;
                $numfon = $value->dddtel.$value->numtel;
            }

            $verificaCpf = User::where('cpf', $request->cpf_reg)->count();
            //var_dump($verificaCpf);
            if ($verificaCpf) {
                return response()->json(['error' => 'Usuário já cadastrado']);                
            } else {              

                $usuario = new User;

                $usuario->fill([
                    'nome'      =>  $nomfun,
                    'matricula' =>  $numcad,
                    'cpf'       =>  $request->cpf_reg,
                    'password'  =>  bcrypt($request->senha_reg),
                    'fone'      =>  $numfon,
                ]);                
                //if ($usuario->save()) {
                try {
                    $usuario->save();
                } catch (\Throwable $th) {                    
                    return response()->json(['error' => 'Erro ao gravar no Banco de Dados']);
                    //Log::info($th->getMessage());
                }

                $code = SendCode::sendCode($numfon);
                //$code = 1;
                if($code) {
                    $ativacao = User::where('cpf', $request->cpf_reg)
                            ->update(['code' => $code]);                    
                } else {
                    return response()->json(['error'   => 'Erro ao enviar código de ativação']);    
                }
                                
                return response()->json(['sucesso'   => 1, 'cpf_ativa' => $request->cpf_reg]);
                //} else {
                    //return response()->json(['error'   => $usuario->errors()->all()]);
                //}
            }                        
        } else {
            return response()->json(['error' => 'CPF não encontrado!']);
        }
        
    }


    public function ativa(Request $request) {
        $validationAtiva = $request->validate([
            'cpf_ativa' =>  'required',
            'codigo'    =>  'required',            
        ],
        [
            'cpf_ativa.required'=> 'CPF é obrigatorio',
            'codigo.required'   => 'Digite o código',            
        ]);
        
        $verificaCodigo = User::where([
            ['cpf',  $request->cpf_ativa],
            ['code', $request->codigo], 
        ])->update(
            ['ativo' => 1],
            ['code'  => ' ']
        );
        //var_dump($verificaCodigo);

        return response()->json(['sucesso'   => 2]);
        //return Redirect::route('login');
    }

}
