<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\User;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    // private $usuarioModel = null;
    // function __construct() {
    //   $this->usuarioModel = new User();
    // }

    public function index()
    {
        return view('login.login');
    }

    public function validar(Request $request)
    {
        $user = DB::table('usuario')->where('email', $request->email)->first();
        // echo $user->encrypted_password;
        // echo '<br>';
        // echo $request->senha;
        // echo '<br>';
        // echo $hashed = Hash::make($request->senha); exit;

        if (!isset($user)){
            return redirect('/')->with('danger','Acesso inválido!');
        }if ($user->is_active == 0) {
            return redirect('/')->with('danger','Seu login está bloqueado!');
        } else {
            # code...
        }


        if( hash::check($request->senha, $user->encrypted_password) )
        {
            $userLogado = [
                "id" => $user->id,
                "nome" => $user->nome,
                "email" => $user->email,
                "role_id" => $user->role_id,
            ];

            session(['userLogado' => $userLogado]);

            return redirect('obras/painel');
        }
        else{
            return redirect('/')->with('danger','Acesso inválido!');
        }

    }

    public function sair()
    {
        session()->flush();
        return redirect('/login');
    }


    /*
        esqueceu a senha?
    */


    public function esqueci_senha(){
        return view('admin.login.login_esqueci_senha');
    }

    public function esqueci_senha_enviar_email(Request $request)
    {
        $user = DB::table('users')->where('email', $request->email)->first();

        if($user == null){
            return redirect('login/esqueci/senha')->with('msg','Seu email não encontrado!');;
        }
        else
        {
            echo $token =  str_random(60);

            DB::table('users') ->where('id', $user->id)
            ->update(
                ['reset_password_token' => $token,
                'reset_password_sent_at' => date("Y-m-d H-i-s"),
                'remember_created_at' => date("Y-m-d H-i-s"),
                'token_usado' => 0,
                ]
            );

            Mail::send('admin.login.corpo_email', ['email'=>$user->email, 'token'=>$token], function ($m) use ($user) {
                $m->from('sistema.secom@secom.se.gov.br', 'SGC SERGIPE');
                $m->to($user->email)->subject('Envio de redefinição de senha');
            });

        }

        return redirect('login/esqueci/senha')->with('msg','Enviamos um email com a configuração para redefinir sua senha!');
    }


    public function login_redefinir_senha_frm_token(Request $request)
    {
        //verifique se existe algum token
        $user = DB::table('users')->where('reset_password_token',  $request->token)->first();

        if($user == null){
            echo 'token inválido!';
            exit;
        }
        else{
            if($user->token_usado == 1){
                echo 'Este token já expirou! Por favor solicite outra redefinição de senha! ;)';
                exit;
            }
        }

        DB::table('users') ->where('id', $user->id)
        ->update(
            [
                'remember_created_at' => date("Y-m-d H-i-s"),
                'token_usado' => 1,
            ]
        );

        return view('admin.login.login_redefinir_senha_frm_token',['email' => $user->email]);
    }


    public function login_salvar_senha_token(Request $request, $token)
    {
        $user = DB::table('users')->where('reset_password_token',  $token)->first();

        if($request->senha1 <> $request->senha2){
            return redirect('login/esqueci/senha/redefinir_senha/'.$token)->with('msg','Senhas não iguais!');;
        }

        $senha1 = hash::make($request->senha1);
        DB::update('update users set encrypted_password = ? where id = ?', [$senha1,$user->id]);

        return redirect('login/')->with('sucess','Senha alterada com sucesso!');
    }


}
