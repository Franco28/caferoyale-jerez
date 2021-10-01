<?php
define('DB_SERVER', '127.0.0.1');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'negocioweb');

define('CODIFICACION', 'utf8');
define('ZONA_HORARIA', 'America/Argentina/Buenos_Aires');


/* Conexión al servidor MySQL */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

/* Validación de la conexión */
if (mysqli_connect_errno()) {
	exit('Error: No se pudo conectar el servidor MySQL');
}

/* Definición del conjunto de caracteres */
if (!mysqli_set_charset($link, CODIFICACION)) {
	exit('Error: No se pudo establecer el conjunto de caracteres');
}

/* Definición de la zona horaria */
date_default_timezone_set(ZONA_HORARIA);

?>