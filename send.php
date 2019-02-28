<?php

  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Headers: X-Requested-With');
  header('Access-Control-Allow-Methods: POST, GET, OPTIONS');

  $postdata = file_get_contents("php://input");
  $request = json_decode($postdata);
  $email = $request->email;
  $pass = $request->password;

  $name= $request->name;
  $phone=$request->phone;
  $email= $request->email;
  $subject=$request->subject;
  $text=$request->msg;
  $interest = $request->interest;
  $property = $request->property;

  $send_to = "ventas@inmueblesgalatea.com";
  $from = $email;
  $body='
  <html>
  <head>
    <title>Ingrese titulo</title>
  </head>
  <body>
    
    <div style="padding: 1.5em 0.5em; border-radius: 0.45em; max-width: 100%; margin: 0 auto; " >
      <div style="background-color: #F7F7F7; text-align: center; max-width: 80%; margin:0 auto; ">
        <span style="display: inline-block; padding: 1.5em 0;">
          <img src="http://www.inmueblesgalatea.com/recursosExtra/logoGalatea-negro.png" 
            alt="Inmuebles galatea"
             style="display: inline-block; max-width: 120px; "/>
        </span>
      </div>
      
      <table cellpadding="15" 
        cellspacing="0"
        style="font-size: 1.2em; max-width: 600px; margin: 0 auto;">
        
        <tr style="border-bottom: solid 1px #000; padding-top: 1px; padding-bottom: 0.5em;" >
          <td>
            <th>Forma de Contacto:</th>
          </td> 
          <td> '.$interest.' </td>
        </tr>
        <tr>
          <td>
            <th>Liga De propiedad (Fomas de contacto = comprar/rentar): </th>
          </td>
          <td> 
            <a href="http://inmueblesgalatea.com/'.$property.' ">
              Liga
            </a>
          </td>
        </tr>
        
        <tr>
          <td>
            <th>Nombre</th>
          </td> 
          <td> '.$name.' </td>
        </tr>
        <tr>
          <td>
            <th>Correo</th>
            <td>'. $email .'</td>
        </tr>
        <tr>
          <td>
            <th>Teléfono</th>
          </td>
          <td> '.$phone.' </td>
        </tr>
        <tr>
          <td>
            <th>Mensaje</th>
          </td>
          <td>'.$text.'</td>
        </tr>
      </table>
    </div>
    
  </body>
  </html>
  ';
  $head  = 'MIME-Version: 1.0' . "\r\n";
  $head .= 'Content-type: text/html; charset=utf-8' . "\r\n";
  $head .= 'Reply-To: jesushfloresn@gmail.com' . "\r\n";
  $head .= 'From: ' . $from . "\r\n";
  $head .= 'Bcc: jesus@digiall.mx' . "\r\n";

  if(mail($send_to,$subject,$body ,$head)){
    echo json_encode(true);
  }
  else{
    echo json_encode(false);
  }

?>
