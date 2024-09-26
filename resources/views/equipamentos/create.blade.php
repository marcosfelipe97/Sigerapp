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
  <form method="post" action="{{ route('equipamentos.store') }}">
          <div class="form-group">
              @csrf
              <label for="eqdescricao">Nome do Equipamento:</label>
              <input type="text" class="form-control" name="eqdescricao" value=" {{old('eqdescricao')}}" autofocus />
            </div>
            <div class="form-group">
            <label for="etiqueta">Etiqueta:</label>
              <input type="text" class="form-control" name="etiqueta" value="{{old('etiqueta')}}" autofocus />
            </div>
          
          
	  <div class="form-group">
 		<label for="marca">Marca do equipamento:</label>
        	<input type="text" class="form-control" name="marca" autofocus value="{{old('marca')}}"/>
	  </div>

     <div class="form-group">
 		<label for="modelo">Modelo do equipamento:</label>
        	<input type="text" class="form-control" name="modelo" autofocus value="{{old('modelo')}}"/>
	  </div>

     

	 <div class="form-group">
 		<label for="codidentificacao">Número de série do equipamento:</label>
        	<input type="text" class="form-control" name="codidentificacao" autofocus value="{{old('codidentificacao')}}"/>
	  </div>
		 <div class="form-group">
			<label for="dt_aquisicao">Data de aquisição do equipamento:</label>
			{!!
				Form::date('dt_aquisicao',\Carbon\Carbon::now(),['class' => 'form-control']);

                        !!}		
	
          <div class="form-group">
 	       
        	
	    </div>
          <button type="submit" class="btn btn-primary">Incluir</button>
          <a href="{{ route('equipamentos.index')}}" class="btn btn-primary">Voltar</a>
      </form>
  </div>
</div>

@stop
