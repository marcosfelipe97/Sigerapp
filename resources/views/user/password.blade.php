@extends('adminlte::page')


@section('title', 'SIGER - Sistema Gerenciador de Reservas de Equipamentos')
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

<form method="post" action="{{url('user/updatepassword')}}">
    {{csrf_field()}}
            <div class="form-group">
                <label for="name">Nome:</label>
                <input type="text" name="name" class="form-control"  value="{{auth()->user()->name}}" />
            </div>

            <div class="form-group">
                <label for="matricula">Matricula:</label>
                <input type="text" name="matricula" class="form-control" value="{{auth()->user()->matricula}}"/>
            </div>

           
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" name="email" class="form-control" value="{{auth()->user()->email}}" />
            </div>
            <div class="form-group">
                <label for="telefone">Telefone:</label>
                <input type="text" name="telefone" class="form-control" value="{{auth()->user()->telefone}}" />
            </div>

            <div class="form-group">
                <label for="mypassword">Senha Atual:</label>
                <input type="password" name="mypassword" class="form-control">
            </div>
            <div class="form-group">
                <label for="password">Nova Senha:</label>
                <input type="password" name="password" class="form-control">
            </div>
                
            <div class="form-group">
                <label for="mypassword">Confirme a nova senha:</label>
                <input type="password" name="password_confirmation" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Alterar a senha</button>
</form>
@stop