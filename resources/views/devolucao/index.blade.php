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
<div class="uper">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}
    </div><br />
  @endif
  <table class="table table-striped">
  <a href="{{ route('devolucao.create')}}" class="btn btn-primary">Registrar devolução</a> <br><br>
    <thead>
        <tr>

          <td><b>Recebido por:</b></td>
          <td><b>Soliciado por:</b></td>
          <td><b>Equipamentos/Marca/No. de série</b></td>
          <td><b>Hora da devolução:</b></td>
          <td><b>Data da reserva:<b></td>
          <td><b>Data da devolução:</b></td>
          <td><b>Observações:</b>




        </tr>
    </thead>
    <tbody>

        @foreach($devolucao as $devolucoes)
        <tr>



	          <td>{{$devolucoes->user->name}}</td>
            <td>{{$devolucoes->reservas->user->name}}</td>
            <td>{{$devolucoes->reservas->equipamentos->eqdescricao}} /{{$devolucoes->reservas->equipamentos->marca}} / {{$devolucoes->reservas->equipamentos->codidentificacao}}</td>
            <td>{{$devolucoes->horadev}}</td>
            <td>{{$devolucoes->reservas->dtagendamento}}
            <td>{{$devolucoes->datadev}}</td>
            <td>{{$devolucoes->obs}}</td>





        </tr>
        @endforeach
    </tbody>
  </table>
<div>

@stop
