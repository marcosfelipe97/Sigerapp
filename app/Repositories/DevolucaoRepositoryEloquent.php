<?php


namespace App\Repositories;
use App\Models\Equipamentos;
use App\Models\Reservas;
use App\Models\Devolucao;
use App\Repositories\Contracts\DevolucaoRepositoryInterface;
use Illuminate\Http\Request;

class DevolucaoRepositoryEloquent implements DevolucaoRepositoryInterface

{
    public  function __construct(Devolucao $devolucao)

    {
        $this->devolucao=$devolucao;

    }

    
    
    
    public function  getAll()
      {
        return $this->devolucao->orderBy('datadev', 'DESC')->has('reservas.equipamentos')->paginate(10);
      }
      public function  getTodos()
      {
      $this->devolucao->all();     
         }  

     public function getById($id)
     {
        return  $this->devolucao->find($id);

     }
    
     public function create(array $attributes)
     {

        return $this->devolucao->create($attributes);
     }
     public function delete($id)
     {
        $this->getById($id)->delete();
        return true;

     }

  

        
   
}

