<?php
  $db = new Conexion();
  $email = $db->real_escape_string($_POST['email']);
  $sql = $db->query("SELECT id,user FROM users WHERE email = '$email' LIMIT 1;");
  if ($db->rows($sql)>0) {
      $data = $db->recorrer($sql);
      $id = $data[0];
      $user = $data[1];
      $keypass = md5(time());
      $new_pass = strtoupper(substr(sha1(time()),0,8));
      $link = APP_URL . '?view=lostpass&key='. $keypass;


      $mail = new PHPMailer;
  $mail->CharSet = "UTF-8";
  $mail->Encoding = "quoted-printable";
  $mail->isSMTP();                                      // Set mailer to use SMTP
  $mail->Host = PHPMAILER_HOST;  // Specify main and backup SMTP servers
  $mail->SMTPAuth = true;                               // Enable SMTP authentication
  $mail->Username = PHPMAILER_USER;                 // SMTP username
  $mail->Password = PHPMAILER_PASS;                           // SMTP password
  $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
  $mail->SMTPOptions = array(
      'ssl' => array(
          'verify_peer' => false,
          'verify_peer_name' => false,
          'allow_self_signed' => true
      )
  );
  $mail->Port = PHPMAILER_PORT;                                    // TCP port to connect to

  $mail->setFrom(PHPMAILER_USER, APP_TITLE); //Quien manda el correo?

  $mail->addAddress($email, $user);     // A quien le llega

  $mail->isHTML(true);    // Set email format to HTML

  $mail->Subject = 'Recuperar contraseña perdida';
  $mail->Body    = LostpassTemplate($user,$link);
      $mail->AltBody = 'Hola' . $user . 'Para recuperar tu contraseña debes ir a este enlace.' .$link;
      if(!$mail->send()) {
          $HTML =  '<div class="alert alert-dismissible alert-danger">
          <button type="button" class="close" data-dismiss="alert">x</button>
          <strong>ERROR:</strong>'. $mail->ErrorInfo.' </div>';
      }else {
        $db->query("UPDATE users SET keypass ='$keypass', new_pass ='$new_pass' WHERE id='$id'");
        $HTML = 1;
      }
  }else {
    $HTML = '<div class="alert alert-dismissible alert-danger">
    <button type="button" class="close" data-dismiss="alert">x</button>
    <h4>ERROR:</h4><p> El email colocado no existe en sistema.</p></div>';
  }
  $db->liberar($sql);
  $db->close();
  echo $HTML;
 ?>
