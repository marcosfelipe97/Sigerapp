<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\EquipamentosController;
use App\Models\Devolucao;
use App\Models\Reservas;
use App\Models\Equipamentos;
use App\Models\User;
use App\Repositories\Contracts\EquipamentosRepositoryInterface;
use App\Repositories\Contracts\ReservasRepositoryInterface;
use App\Repositories\Contracts\DevolucaoRepositoryInterface;
use PDF;

class DevolucaoController extends Controller
{
    /**
     * Display a listing of the resource. n
     *
     * @return \Illuminate\Http\Response
     */
   
   
    public function __construct(DevolucaoRepositoryInterface $repo,ReservasRepositoryInterface $repore, EquipamentosRepositoryInterface $repoeq )
    {
            $this->repo=$repo;
            $this->repore=$repore;
            $this->repoeq=$repoeq;
    }
   
     public function index()
    {
       //Este método serve para exibição da tela de devolução de equipamento, no caso está exibindo em ordem decrescente, e só exibe os contéudos se caso existir reservas
       
        $devolucao = $this->repo->getAll();
        return view('devolucao.index', compact('devolucao'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Este médoto serve para exibir a tela que efetua a ação do registro de devolução nesse caso só irá apresentar uma lista apenas com equipamentos que estiver com o status Indisponível
        $devolucao= $this->repo->getTodos();
        $equipamentos =$this->repoeq->getIdentifyEquipamentos();
        return view('devolucao.create')->withEquipamentos($equipamentos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
        //Este método serve para guardar o registro de devolução, onde é passado por um array de validação para certificar que as informações apresentadas estão de acordo com as regras impostas no sistema
        $request->validate( [
            'fkreservas'           => 'required',         
            'obs'                  => 'required|max:190',
            'datadev'              => 'required|date|date_format:Y-m-d|after_or_equal:'.\Carbon\Carbon::now()->format('Y-m-d'),
            
        ],
        
        [
           //Este array serve para exibir as informações incorretas para que o usuário possa corrigir
           
           
            'obs.required'=> 'O campo observações deve ser preenchido obrigatóriamente',
            'datadev.after_or_equal' =>'Data inválida',
            'fkreservas.required'=> 'Selecione o equipamento a ser devolvido',
            

        ]
      
    );                  
        //Esta parte do código houve uma instacia da classe Devolução onde está utilizando o método create para gravar as informações fornecidas pelo usuário
            $devolucao = $this->repo->create([
            'fkreservas'           => $request->get('fkreservas'),
            'obs'                  => $request->get('obs'),
            'datadev'              => $request->get('datadev'),
            'horadev'              => $request->get('horadev'),
            'user_id'              => auth()->user()->id,
           
          ]);
          
          //Esta parte do código serve para instanciar a classe Equipamentos, onde será usado o método find, para buscar o id do equipamento selecionado para devolução e assim liberar o status para disponível e salva a informação no sistema 
          $equipamentos = $this->repoeq->getById($devolucao->reservas->fkequipamentos);
          $equipamentos->status='Disponível';
          $equipamentos->save();       
         // $devolucao->save();
           alert()->success('Equipamento devolvido com sucesso');
           return redirect('/devolucao');
       
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
        //
    }

    public function generatePDF()

    {
        
        $devolucao=$this->repo->getAll();
        $pdf = PDF::loadView('devolucao/devolucaoPDF',['devolucao'=> $devolucao])->setPaper('a4', 'landscape');
        return $pdf->download('devolucao.pdf');

    }
   
}

