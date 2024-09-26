<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservas;
use App\Models\Equipamentos;
use App\Repositories\Contracts\EquipamentosRepositoryInterface;
use App\Repositories\Contracts\ReservasRepositoryInterface;
use PDF;


/**
 * Class ReservasController
 * @package App\Http\Controllers
 */
class ReservasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    

    public function __construct(ReservasRepositoryInterface $repore, EquipamentosRepositoryInterface $repo)
    {
            $this->repore=$repore;
            $this->repo=$repo;
    }
  

   
   
     public function index()
    {

      
        
        /*Este método serve para exibição da tela de pricipal de reservas,
         onde será exibido por nome em ordem decrescente

         */

        $reservas =  $this->repore->getAll();
        return view('reservas.index', compact('reservas'));

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       /* Este método serve para exibir a view das Reservas
          e verifica se o status dos equipamentos para reservas
        
        */
        $equipamentos=$this->repo->getStatus();
        $reservas=$this->repore->getTodos();
        return view('reservas.create')->withEquipamentos($equipamentos);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        /* Este método serve para guardar as reservas, onde passará por um
            array de verificação para certificar se estão corretas as informações
        */
        
        $request->validate([
            'fkequipamentos'          => 'required',
            'dtagendamento'           => 'required|date|date_format:Y-m-d|after_or_equal:'.\Carbon\Carbon::now()->format('Y-m-d'),
            'turno'                   => 'required',
            
        ],
    

        [
         /*
                Este array serve para alertar as informações incorretas para 
                o usuário e  orientar o que pode ser feito para que a reserva seja 
                efetuada com sucesso
         */


            'fkequipamentos.required'=>'Selecione um equipamento para reservar o equipamento',
            'dtagendamento.required'=>'Selecione uma data para reservas o equipamento',
            'turno.required'=>'Selecione o turno desejado para reserva',
            'dtagendamento.after_or_equal' =>'Data inválida'
        ]
       
    
    
    
    );

         /* 
               Esta parte do código serve para instanciar a classe reservas
               e usar o metodo create que irá preparar as informações para 
               serem guardadas 
        */
        $reservas = $this->repore->create([
            'fkequipamentos'           => $request->get('fkequipamentos'),
            'user_id'                  => auth()->user()->id,
            'dtagendamento'            => $request->get('dtagendamento'),
            'turno'                    => $request->get('turno'),
           
        ]);
        
          /* 
               Esta parte do código serve para instanciar a classe equipamento
               e usar o método find para efetuar a localização do id do equipamento
               selecionado para gravar o status do mesmo  
        */
        
        $equipamento = $this->repo->getById($request->get('fkequipamentos'));
        
       
     
        

        $equipamento->status = 'Indisponível';
        $equipamento->save();
        alert()->success('Reserva  realizada com sucesso');
        return redirect('/reservas');
        dd($request->all());
        
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
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  
     public function destroy($id)
    {
        
        /*
            Este método serve para excluir a reserva selecionada e 
            efetuar a exclusão da reserva
        */
        
        $reservas =$this->repore->getById($id);

        if($reservas){
            $equipamento = $this->repo->getById($reservas->fkequipamentos);

            $equipamento->status = 'Disponível';
            $equipamento->save();

        }
        $reservas=$this->repore->delete($id);
        alert()->success('Reserva  cancelada com sucesso');
        return redirect('/reservas');
    }
   
    public function generatePDF()

    {
        
        $reservas=$this->repore->getAll();
        $pdf = PDF::loadView('reservas/reservaPDF',['reservas'=> $reservas])->setPaper('a4', 'landscape');
        return $pdf->download('reservas.pdf');

    }



}