<?php

require $_SERVER['DOCUMENT_ROOT']."/libs/rb.php";
require $_SERVER['DOCUMENT_ROOT']."/php/functions.php";

R::setup( 'mysql:host=localhost;dbname=blog',
        'root', 'root' ); 
//проверка коннекта
//mail("csgo2507@mail.ru", "My Subject", "Line 1\nLine 2\nLine 3");
//$isConnected = R::testConnection();
//echo $isConnected;
ini_set('session.gc_maxlifetime', 604800);
ini_set('session.cookie_lifetime', 604800);

session_start();
date_default_timezone_set('Europe/Moscow'); 

?>