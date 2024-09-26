<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Devolucao extends Model
{
   
    protected $fillable = [
        'id',
        'fkreservas',
        'fk_id',
        'user_id',
        'obs',
        'datadev',
        'horadev',
      ];
    protected $table ='devolucao';
   
   
    public function reservas()
    {
        return $this->hasOne(Reservas::class, 'id', 'fkreservas');
    }
    public function equipamentos()
    {
        return $this->hasOne(Equipamentos::class, 'id', 'fkequipamentos');
    }
    
    public function devolucao()
    {
        return $this->hasOne(Devolucao::class,'fkequipamentos', 'id');
    }
   
    public function user(){
        return $this->BelongsTo(User::class);
    }
    
}
