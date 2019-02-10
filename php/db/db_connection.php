<?php

require $_SERVER['DOCUMENT_ROOT']."/libs/rb.php";

R::setup( 'mysql:host=localhost;dbname=blog',
        'root', 'root' ); 
//проверка коннекта
//mail("csgo2507@mail.ru", "My Subject", "Line 1\nLine 2\nLine 3");
//$isConnected = R::testConnection();
//echo $isConnected;


session_start();
date_default_timezone_set('Europe/Moscow');



?>