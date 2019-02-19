<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\SendCode;

class LogonController extends Controller
{
   
    public function index() {
        return view('login.index');        
    }

    public function login(Request $request) {
        
        //print_r($request->input());
        //exit;
        $validation = $request->validate([
            'cpf'       => 'required',
            'password'  => 'required',
        ],
        [
            'cpf.required'      => 'CPF é obrigatorio',
            'password.required' => 'Digite a senha'    
        ]);
        
        //var_dump($validation);
        //exit;
        $credentials = ['cpf'=>$request->cpf, 'password'=>$request->password];

        if(Auth::attempt($credentials)) {
            if(Auth::attempt(['cpf'=>$request->cpf, 'password'=>$request->password, 'ativo' => 1])) {
                return redirect()->intended('home');
            } else {
                $numfon = User::where('cpf', $request->cpf)->first()->fone;

                return redirect()->back()->with(
                    ['msg' => 'Usuário está inativo!', 'cpf' => $request->cpf, 'numfon'  => $numfon]
                );                
            }            
        } else{
            return redirect()->back()->with('msg','Usuário ou senha inválidos!');            
        }
    }

    public function home() {
        return view('auth.home');
    }

    public function ativaLogin(Request $request) {
        //print_r($request->input());
        $code = SendCode::sendCode($request->foneAtiva);
    
        if($code) {
            $ativacao = User::where('cpf', $request->cpfAtiva)
                    ->update(['code' => $code]);                    
        } else {
            return response()->json(['error'   => 'Erro ao enviar código de ativação']);    
        }

        return response()->json(['sucesso'  => 1, 'cpf_ativa' => $request->cpfAtiva]);
    }


    public function relembrar(Request $request) {
        $validation = $request->validate([
            'cpfReset'  => 'required'            
        ],
        [
            'cpfReset.required' => 'CPF é obrigatorio'            
        ]);

        $numfon = User::where('cpf', $request->cpfReset)->first();

        if ($numfon) {
            //$senhaToken = SendCode::sendReset($numfon->fone);
            $senhaToken = 1;
            if($senhaToken) {
                $saveReset = User::where('cpf', $request->cpfReset)
                        ->update(['code' => $senhaToken]);
                if ($saveReset) {
                    return response()->json(['sucesso'   => 3, 'cpfReset' => $request->cpfReset]);
                } else {
                    return response()->json(['error'   => 'Erro ao atualizar senha de recuperação']);        
                }
                
            } else {
                return response()->json(['error'   => 'Erro ao enviar código de recuperação de senha']);    
            }
        } else {
            return response()->json(['error'   => 'CPF não cadastrado ou Telefone inválido']);    
        }
    }


    public function mudaSenha(Request $request) {
        $validationReq = $request->validate([
            'codRecupera'   =>  'required',
            'cpfRecupera'   =>  'required',
            'senhaRecu'     =>  'required',
            'confirmaRecu'  =>  'required|same:senhaRecu'
        ],
        [
            'codRecupera.required'  => 'O codigo é obrigatorio',
            'senhaRecu.required'    => 'Digite a nova senha',
            'confirmaRecu.required' => 'Digite a confirmação',
            'confirmaRecu.same'     => 'A confirmação deve ser igual a nova senha'
        ]); 
        
        try {
            $altSenha = User::where([
                ['cpf', $request->cpfRecupera],
                ['code', $request->codRecupera],
            ])->update(['password' => bcrypt($request->senhaRecu)]);
        } catch (\Throwable $th) {                    
            return response()->json(['error' => 'Erro ao gravar no Banco de Dados']);
            //Log::info($th->getMessage());
        }
        
        if (Auth::attempt(['cpf'=>$request->cpfRecupera, 'password'=>$request->senhaRecu, 'ativo' => 1])) {
            return response()->json(['sucesso' => 4]);
        } else {
            return response()->json(['error' => 'Erro no login automatico']);
        };


    }
    
}
