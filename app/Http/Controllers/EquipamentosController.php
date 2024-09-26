<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipamentos;
use App\Repositories\Contracts\EquipamentosRepositoryInterface;
use PDF;

class EquipamentosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     * 
     */

    public function __construct(EquipamentosRepositoryInterface $repo)
    {
            $this->repo=$repo;
    }

    public function index()
    {  //Este método serve para exibição da tela de pricipal dos equipamentos cadastrados, onde será exibido por nome em ordem alfabética e decrescente
        $equipamentos = $this->repo->getAll();
        return view('equipamentos.index', compact('equipamentos'));

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { //Este método serve para exibir a view de cadastro de equipamentos
        
       
       return view('equipamentos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       /*
        Este método é usado para guardar o equipamento que o usuário irá cadastrar,
        onde será passada por um array de validação, para verificar se os dados que o usuário fornecer estão corretos


       */
       
       
        $request->validate([
             'eqdescricao'          => 'required|string|max:20|unique:equipamentos',
             'marca'                => 'required|:max:20',
             'modelo'               => 'required|:max:20',
             'codidentificacao'     => 'required|unique:equipamentos|max:30',
             'dt_aquisicao'         => 'required|date|date_format:Y-m-d|before_or_equal:'.\Carbon\Carbon::now()->format('Y-m-d'),
             'etiqueta'             => 'required|numeric',
            
        ],
        
        [
                /*
                Este array serve para alertar as informações incorretas para 
                o usuário e  orientar o que pode ser feito para que o cadastro seja 
                efetuado com sucesso
                */


            'eqdescricao.required' => 'O Tipo de equipamento deve ser preenchido obrigatóriamente',
            'marca.required'=>'O campo marca deve ser preenchido obrigatóriamente',
            'modelo.required'=>'O campo modelo deve ser preenchido obrigatóriamente',
            'codidentificacao.required'=>'O campo de número de série deve ser preenchido obrigatóriamente',
            'codidentificacao.unique'=>'O campo número de série é único',
            'codidentificacao.max'=>'Número de série deve ter o máximo de 20 dígitos',
            'eqdescricao.max'=>'É tipo de equipamento deve ter o máximo 20 digitos',
            'eqdescricao.unique'=>'Não é permitido cadastrar nomes de equipamentos iguais',
            'modelo.max'=>'O modelo do equipamento deve ter máximo 20 dígitos',
            'etiqueta.required'=> "Insira o número de equiqueta para cadastrar o equipamento",
            'etiqueta.numeric'=>'Somente é permitida a inserção de números inteiros no campo etiqueta',
            'dt_aquisicao.before_or_equal'=>  'Data inválida, só é possivel cadastrar com datas inferiores a hoje',
            ]
    
         
              
              );

                /*
               Esta parte do código serve para instanciar a classe equiapamento 
               e usar o metodo create que irá preparar as informações para 
               serem guardadas 

                */



                $equipamentos =$this->repo->create([
                  'eqdescricao'        => $request->get('eqdescricao'),
                  'marca'              => $request->get('marca'),
                  'modelo'             => $request->get('modelo'),
                  'codidentificacao'   => $request->get('codidentificacao'),
                  'dt_aquisicao'       => $request->get('dt_aquisicao'),
                  'etiqueta'           => $request->get('etiqueta'),
                  
                 
                ]);
            
                    /*
                    Esta parte do código grava as informaçoes capturadas para o método create
                    e envia o alerta informando que  foi salvo com sucesso e também redireciona 
                    para a página de equipamentos
                    */
                    $equipamentos->save();
                            alert()->success('Equipamento adicionado com sucesso');
                             return redirect('/equipamentos');

    }

    



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
     /*
        Este metodo busca o id do equipamento a ser editado
        

     */
        $equipamentos = $this->repo->getById($id);

        return view('equipamentos.edit', compact('equipamentos'));
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    
    
   
        public function update(Request $request, $id)
        /*
            Este método faz a atualização das novas informações do equipamento selecionado,
            onde passa por um array de validação para certificar que as informações 
            estão corretas no sistema


    */

    {
        $request->validate([
            'eqdescricao'           => 'required|string|max:30',
            'marca'                 => 'required|max:30',
            'modelo'                => 'required|max:30',
            'status'                => 'required',
            'codidentificacao'      => 'required|max:30',
            'dt_aquisicao'          => 'required|date',
           
            
                 
        ],
        [
            /*
                Este método serve para exibir as informações caso não estão em
                conformidade com o formulário
            */

            'eqdescricao.required' => 'O Tipo de equipamento deve ser preenchido obrigatóriamente',
            'marca.required'=>'O campo marca deve ser preenchido obrigatóriamente',
            'modelo.required'=>'O campo modelo deve ser preenchido obrigatóriamente',
            'codidentificacao.required'=>'O campo de número de série deve ser preenchido obrigatóriamente',
            'codidentificacao.unique'=>'O campo número de série é único',
            'eqdescricao.max'=>'É permitido no máximo 30 digitos',
            'modelo.max'=>'É permitido no máximo 30 dígitos',
                   
        ]
        
             
             );
                /* 
                Esta parte do código é a preparação as novas informações para serem guardadas,
                onde é feita uma busca pelo id do equipamento selecionado e gravadas novas as informações
                */
             
                $equipamentos = $this->repo->getById($id);
                $equipamentos->eqdescricao        = $request->get('eqdescricao');
                $equipamentos->marca              = $request->get('marca');
                $equipamentos->modelo             = $request->get('modelo');
                $equipamentos->status             = $request->get('status');
                $equipamentos->codidentificacao   = $request->get ('codidentificacao');
                $equipamentos->dt_aquisicao       = $request->get ('dt_aquisicao');
                $equipamentos->etiqueta           =$request->get('etiqueta');
                
                
                $equipamentos->save();
                alert()->success('Equipamento atualizado com sucesso');
                return redirect('/equipamentos');
              
              
          
            }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     /*
     Este método verifica se o equiapamento está disponível para a remoção, 
     caso contrário o mesmo não será excluído
     */
        

        
        //$equipamentos = Equipamentos::::whereStatus('Disponível')->find($id);
       
        $equipamentos=$this->repo->getWithStatus($id);
      
        if(!$equipamentos){
            alert()->error('Equipamento não pode ser removido, pois está em utilização');
            return redirect('/equipamentos');
        }

        $equipamentos=$this->repo->delete($id);

        alert()->success('Equipamento excluido com sucesso');

        return redirect('/equipamentos');
    }

    public function generatePDF()

    {
        
        $equipamentos=$this->repo->getAll();
        $pdf = PDF::loadView('equipamentos/equipamentosPDF',['equipamentos'=> $equipamentos])->setPaper('a4', 'landscape');
        return $pdf->download('equipamentos.pdf');

    }
   
}
