<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUIyJ" crossorigin="anonymous">
        

        
        
        
    <body>



<img src="s.png" align="center" width="50" height="50"> 
<font size="15"><b>SIG</b>ER- Sistema Gerenciador de Reservas</font>
<hr>

 <center><h1>Equipamentos cadastrados</h1></center>

<table width="auto" border="1px" align='center'>
    <thead>
        <tr>
          
          <td width="101" height="40" align="center"><b>Nome do equipamento:</b></td>
          <td width="101" height="40" align="center"><b>Etiqueta:</b></td>
          <td width="101" height="40" align="center"><b>Marca:</b></td>
          <td width="101" height="40" align="center"><b>Modelo:</b></td>         
          <td width="101" height="40" align="center"><b>Numero de série:</b></td>    
          <td width="101" height="40" align="center"><b>Data de aquisição:</b></td>
          <td width="101" height="40" align="center"><b>Status:</b></td>
         
	   
          
        </tr>
    </thead>
        <tbody>
            @foreach($equipamentos as $equipamentos)
            <tr>
            
	            <td width="101" height="40" align="center">{{$equipamentos->eqdescricao}}</td>
                <td width="101" height="40" align="center">{{$equipamentos->etiqueta}}</td>
                <td width="101" height="40" align="center">{{$equipamentos->marca}}</td>
                <td width="101" height="40" align="center">{{$equipamentos->modelo}}</td>
                <td width="101" height="40" align="center">{{$equipamentos->codidentificacao}}</td>
                <td width="101" height="40" align="center">{{ date( 'd/m/Y' , strtotime($equipamentos->dt_aquisicao))}}</td>
                <td width="101" height="40" align="center">{{$equipamentos->status}} </td>

            </tr>
            @endforeach
    </tbody>

    </table>
            
      
       
       
    </body>


    </html>