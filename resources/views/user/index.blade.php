@extends('adminlte::page')

@section('title', 'SIGER - Sistema Gerenciador de Reservas de Equipamentos')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
   
<style>
  .uper {
    margin-top: 40px;
  }
</style>


  <table class="table table-striped">
 
    
    
    

   
    <thead>
        <tr>
        
          <td><b>Nome:</b></td>
          <td><b>Matricula:</b></td>
          <td><b>Telefone:</b></td>
          <td><b>E-mail:</b></td>         
          
          
        </tr>
    </thead>
    <tbody>
        @foreach($user as $users)
        <tr>
            
	          <td>{{$users->name}}</td>
            <td>{{$users->matricula}}</td>
            <td>{{$users->telefone}}</td>
            <td>{{$users->modelo}}</td>
            <td>{{$users->email}}</td>
            
           
		
            
           
               
                
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>

<div>


@stop
