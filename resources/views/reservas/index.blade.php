@extends('adminlte::page')

@section('title', 'SIGER - Sistema Gerenciador de Reservas de Equipamentos')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
   
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="uper">

  <table class="table table-striped">
  <a href="{{ route('reservas.create')}}" class="btn btn-primary">Nova Reserva</a> <br><br>
   
  <div class="container">
        {!! $reservas->render() !!}
    </div>
    
   
    <thead>
        <tr>
          
          <td align="justify"><b>Solicitante:</b></td>
          <td align="center"><b>Turno de agendamento:</b></td>
          <td align="center"><b>Data de agendamento:</b></td>    
          <td align="center"><b>Equipamento/ Marca/ Modelo:</b></td>
          
         
	       
	   
          <td colspan="2"><b>Ações</b></td>
        </tr>
    </thead>
    <tbody>

        @foreach($reservas as $reservas)
        <tr>
      
            
                  
	          <td align="justify">{{$reservas->user->name}}</td>
            <td align="center">{{$reservas->turno}}</td>
            <td align="center">{{ date( 'd/m/Y' , strtotime($reservas->dtagendamento))}}</td>
            <td align="center">{{$reservas->equipamentos->eqdescricao}} / {{$reservas->equipamentos->marca}}  / {{$reservas->equipamentos->modelo}} </td>
                             
            <td>
                <form action="{{ route('reservas.destroy', $reservas->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" onclick="return confirm('Tem certeza que deseja cancelar a reserva?')" type="submit">Cancelar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
</div>
<div align="right">
  <a href="re-pdf" class="btn btn-primary">Exportar lista para pdf</a> 
</div>

@stop