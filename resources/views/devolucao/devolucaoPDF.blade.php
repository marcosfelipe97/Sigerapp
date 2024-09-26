<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUIyJ" crossorigin="anonymous">
        

        
        
        
    <body>



<img src="s.png" align="center" width="50" height="50"> 
<font size="15"><b>SIG</b>ER- Sistema Gerenciador de Reservas</font>
<hr>

 <center><h1>Equipamentos devolvidos</h1></center>

	<table width="auto" border="1px" align='center'>
    <thead>
        <tr>
          
          <td width="101" height="40" align="justify"><b>Recebido por:</b></td>
          <td width="101" height="40" align="justify"><b>Solicitado por:</b></td>
          <td width="101" height="40" align="justify"><b>Equipamentos/Marca/No. de série:</b></td>         
          <td width="101" height="40" align="justify"><b>Hora da devolução:</b></td>  
          <td width="101" height="40" align="justify"><b>Data da reserva:</b></td>  
          <td width="101" height="40" align="justify"><b>Data da devolucao:</b></td> 
          <td width="101" height="40" align="justify"><b>Observações:</b></td>
          

         
         
	   
          
        </tr>
    </thead>
        <tbody>
            @foreach($devolucao as $devolucoes)
            <tr>
            
            <td>{{$devolucoes->user->name}}</td>
            <td>{{$devolucoes->reservas->user->name}}</td>
            <td>{{$devolucoes->reservas->equipamentos->eqdescricao}} /{{$devolucoes->reservas->equipamentos->marca}} / {{$devolucoes->reservas->equipamentos->codidentificacao}}</td>
            <td>{{$devolucoes->horadev}}</td>
            <td>{{ date( 'd/m/Y' , strtotime($devolucoes->reservas->dtagendamento))}}</td>
            <td>{{ date( 'd/m/Y' , strtotime($devolucoes->datadev))}}</td>
            <td>{{$devolucoes->obs}}</td>

            
            
            
            </tr>
            @endforeach
    </tbody>

    </table>
            
      
       
       
    </body>


    </html>