<?php
// nucleo de la aplicación
session_start();
// Constantes de Conexion
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','blog_bd');

//constantes de phpMailer
define('PHPMAILER_HOST','p3plcpnl0173.prod.phx3.secureserver.net');
define('PHPMAILER_USER','public@ocrend.com');
define('PHPMAILER_PASS','Prinick2016');
define('PHPMAILER_PORT',465);

//
	define('HTML_DIR', 'html/');
	define('APP_TITLE','Blog');
	define('APP_COPY','CopyRight &copy;'.date('Y',time()).'Blog.');
	define('APP_URL','http://localhost:8080/Practica/Blog/');

	require ('vendor/autoload.php');
	require ('core/models/classConexion.php');
	require ('core/bin/functions/Encrypt.php');
	require ('core/bin/functions/Users.php');
	require ('core/bin/functions/EmailTemplate.php');
	require ('core/bin/functions/lostpassTemplate.php');
	$_users =  Users();
 ?>
