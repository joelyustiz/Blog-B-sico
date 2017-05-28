<?php

function LostpassTemplate($user,$link) {
  $HTML = '
  <html>
  <body style="background: #FFFFFF;font-family: Verdana; font-size: 14px;color:#1c1b1b;">
  <div style="">
      <h2>Hola '.$user.'</h2>
      <p style="font-size:17px;">Solicitud de cambio de contraseña.</p>
  	<p>El día '. date('d/m/Y', time()).' se ha generado una solicitud de recupeción de contraseña. <br /> Si no has solicitado esto, has caso omiso a este mensaje, en cambio si deseas modificar tu contraseña debes hacer clic en el enlace de abajo.</p>
  	<p style="padding:15px;background-color:#ECF8FF;">
  			Para modificar tu contraseña has <a style="font-weight:bold;color: #2BA6CB;" href="'.$link.'" target="_blank">clic aquí &raquo;</a>
  	</p>
      <p style="font-size: 9px;">&copy; '. date('Y',time()) .' '.APP_TITLE.'. Todos los derechos reservados.</p>
  </div>
  </body>
  </html>
  ';

    return $HTML;
}

?>
