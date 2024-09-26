<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUIyJ" crossorigin="anonymous">
        

        
        
        
    <body>



<img src="s.png" align="center" width="50" height="50"> 
<font size="15"><b>SIG</b>ER- Sistema Gerenciador de Reservas</font>
<hr>

 <center><h1>Reservas solicitadas</h1></center>

	<table width="auto" border="1px" align='center'>
    <thead>
        <tr>
          
          <td width="101" height="40" align="justify"><b>Solicitante:</b></td>
          <td width="101" height="40" align="justify"><b>Turno de agendamento:</b></td>
          <td width="101" height="40" align="justify"><b>Data de agendamento:</b></td>         
          <td width="101" height="40" align="justify"><b>Equipamento/ Marca/ Modelo:</b></td>    
         
         
	   
          
        </tr>
    </thead>
        <tbody>
            @foreach($reservas as $reservas)
            <tr>
            
	      <td width="101" height="40"  align="justify">{{$reservas->user->name}}</td>
           <td width="101" height="40" align="justify">{{$reservas->turno}}</td>
           <td width="101" height="40" align="justify">{{ date( 'd/m/Y' , strtotime($reservas->dtagendamento))}}</td>
           <td width="101" height="40" align="center">{{$reservas->equipamentos->eqdescricao}} / {{$reservas->equipamentos->marca}}  / {{$reservas->equipamentos->modelo}} </td>

            </tr>
            @endforeach
    </tbody>

    </table>
            
      
       
       
    </body>


    </html>