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

<div class="card uper">
  <div class="card-header">

  </div>
  
    
    <form method="post" action="{{ route('novousuario.store') }}">
          <div class="form-group">
              @csrf
              <label for="name">Nome:</label>
              <input type="text" class="form-control" name="name"/>
          </div>
          <div class="form-group">
              <label for="email">E-mail :</label>
              <input type="email" class="form-control" name="email"/>
          </div>
          
          <div class="form-group">
              <label for="matricula">Matricula :</label>
              <input type="text" class="form-control" name="matricula"/>
          </div>

          <div class="form-group">
              <label for="telefone">Telefone :</label>
              <input type="text" class="form-control" name="telefone"/>
          </div>
          <div class="form-group">
              <label for="password">Senha:</label>
              <input type="password" class="form-control" name="password"/>
          </div>
          <div class="form-group">
                <label for="password_confirmation">Confirme a senha:</label>
                <input type="password" name="password_confirmation" class="form-control">
            </div>
          <button type="submit" class="btn btn-primary">Cadastrar</button>
      </form>
  </div>
       

@stop
