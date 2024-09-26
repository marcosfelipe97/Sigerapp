<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; 
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades;

use Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=User::all();
        return view('user.index', compact('user'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        //Este método serve para exibir a view  para cadastrar o usuário
       
        return view('novousuario.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          /* Este método serve para guardar as cadastro de usuário, onde passará por um
            array de verificação para certificar se estão corretas as informações
        */
       
        $request->validate([
            'name'      =>'required',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|confirmed|min:6|max:18',
            'matricula' =>'required|numeric|min:10|unique:users',
            'telefone'  =>'required|numeric|min:10|unique:users',
            
        ],[
             /*
                Este array serve para alertar as informações incorretas para 
                o usuário e  orientar o que pode ser feito para que o cadastro seja 
                efetuado com sucesso
             */

            'name.required' => 'O preenchimento do campo nome é obrigatório',
            'email.required'=>'É necessário preencher um e-mail válido para efetuar o cadastro',
            'email.unique'=>'Este e-mail já está cadastrado, oriente o colaborador a recuperar a senha',
            'password.required'=>'Insira uma senha, para conclusão do cadastro',
            'password.confirmed'=>'Senha digitada não confere com o campo senha',
            'password.min' =>'Minimo permitido são 6 dígitos',
            'password.max' => 'Maximo permitido é de 18 dígitos',
            'telefone.required'=>'O preenchimento do número de telefone é obrigatório',
            'telefone.unique'=>'Este telefone já está cadastrado',
            'telefone.min'=>'O número de telefone deve ter no mínimo 10 digitos',
            //'telefone.max'=>'O número de telefone deve ter no máximo 12 digitos',
            'telefone.numeric'=>'Número de telefone inválido',
            'matricula.required'=>'É obrigatório inserir o número de matricula',
            'matricula.numeric'=>'Número de matricula inválido'
           



          ]);
           
          
        /* 
               Esta parte do código serve para instanciar a classe user
               e usar o metodo create que irá preparar as informações para 
               serem guardadas 
        */


          $user=User::create([
            'name' => $request->get('name'),
            'telefone' => $request->get('telefone'),
            'matricula' => $request->get('matricula'),
            'email'=> $request->get('email'),
            'password' => Hash::make($request->password) //Esta parte do código serve para criptografar a senha de acesso

          ]);
          $user->save();
          alert()->success('Usuário cadastrado com sucesso');
          return redirect('/home');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

     return redirect('/user');

    }

     //recuperação de sennha (logado)
    
    
     public function password(){

        //Esta parte do código serve para exibir a tela de alteração dos dados cadastrais
        return View('user.password');
         }

    public function updatePassword(Request $request){

         /* Este método serve para preparar as alterações dos dados cadastrais do usuário,
          onde passará por um array de verificação para certificar 
          se estão corretas as informações
        */

        $rules = [
            'mypassword' => 'required',
            'password'   => 'required|confirmed|min:6|max:18',
            'telefone'   =>'required|numeric|min:10',
            'name'       =>'required',
            'email'      => 'required|email',
            'matricula'  => 'required|numeric'
            
            
        ];
        
        $messages = [

              /*
               Este array está as mensagens que serão exibidas caso algo estiver errado
              */


            'mypassword.required' =>'O campo senha atual é obrigatório',
            'password.required' =>'Campo senha nova é obrigatório',
            'password.confirmed'=> 'Senhas não coincidem',
            'password.min' =>'Minimo permitido são 6 dígitos',
            'password.max' => 'Maximo permitido é de 18 dígitos',
            'telefone.required'=>'O preenchimento do número de telefone é obrigatório',
            'telefone.unique'=>'Este telefone já está cadastrado',
            'telefone.min'=>'O número de telefone deve ter no mínimo 10 digitos',
            'telefone.max'=>'O número de telefone deve ter no máximo 12 digitos',
            'telefone.numeric'=>'Número de telefone inválido',
            'matricula.required'=>'É obrigatório inserir o número de matricula',
            'name.required' => 'O preenchimento do campo nome é obrigatório',
            'email.unique'=>'Este e-mail já está cadastrado',
            'email.required'=>'É obrigatório o preenchimento com um e-mail válido',
            'matricula.numeric'=>'Número de matricula inválido'
           
        ];
        
        
 // Realiza a validação das informações e altera as informações do usuario que está logao na sessão
       $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()){
            return redirect('user/password')->withErrors($validator);
        } 
        else{
            if (Hash::check($request->mypassword, Auth::user()->password)){
                $user = new User();
                $user->where('email', '=', Auth::user()->email)
                     ->update(
                         [
                            'password' => bcrypt($request->password), // criptografa a senha
                            'name'=>$request->get('name'),
                            'telefone'=>$request->get('telefone'),
                            'email' =>$request->get('email'),
                            'matricula' =>$request->get('matricula')
                        ]
                     );
                     alert()->success('Informações da conta foram alteradas com sucesso');
                 return redirect('home');
            }
            else
            {
                alert()->error('Credenciais Incorretas');
                return redirect('user/password');
            }
        }
    }
}
