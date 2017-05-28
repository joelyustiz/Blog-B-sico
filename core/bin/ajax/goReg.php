<?php
$db = new Conexion();
$user = $db->real_escape_string($_POST['user']);
$pass = Encrypt($_POST['pass']);
$email = $db->real_escape_string($_POST['email']);
$sql = $db->query("SELECT user FROM users WHERE user = '$user' OR email = '$email' LIMIT 1;");

if ($db->rows($sql) == 0) {
  $keyreg= md5(time());
$link = APP_URL .'?view=activar&key='.$keyreg;

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output
$mail->Charset = "UTF-8";
$mail->Encoding="quoted_printable";
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = PHPMAILER_HOST;  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = PHPMAILER_USER;                 // SMTP username
$mail->Password = PHPMAILER_PASS;                           // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = PHPMAILER_PORT;                                    // TCP port to connect to

$mail->setFrom(PHPMAILER_USER, APP_TITLE);  //quien manda el correo
$mail->addAddress($email, $user);     // a quien le llega

$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Activacion de tu cuenta';
$mail->Body    = EmailTemplate($user,$link);
$mail->AltBody = 'Hola' . $user . 'Para activar tu cuenta aaccde al siguiente enlace' .$link;

if(!$mail->send()) {
    $HTML =  '<div class="alert alert-dismissible alert-danger">
    <button type="button" class="close" data-dismiss="alert">x</button>
    <strong>ERROR:</strong>'. $mail->ErrorInfo.' </div>';
} else {
  $db->query("INSERT INTO users (user,email,pass,keyreg) VALUES('$user','$email','$pass','$keyreg');");
  $sql_2 = $db->query("SELECT MAX(id) AS id FROM users;");
  $_SESSION['app_id'] = $db->recorrer($sql_2)[0];
  $db->liberar($sql_2);
  $HTML =  1;
}
}else {
  $usuario = $db->recorrer($sql)[0];
  if (strtolower($user) == strtolower($usuario)) {
    $HTML =  '<div class="alert alert-dismissible alert-danger">
    <button type="button" class="close" data-dismiss="alert">x</button>
    <strong>ERROR:</strong> El usuario ingresado ya existe
  </div>';
  }else {
    $HTML =  '<div class="alert alert-dismissible alert-danger">
    <button type="button" class="close" data-dismiss="alert">x</button>
    <strong>ERROR:</strong> El email ingresado ya existe
  </div>';
  }
}
$db->liberar($sql);
$db->close();
echo $HTML;
 ?>
