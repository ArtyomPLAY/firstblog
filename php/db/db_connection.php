<?php

require $_SERVER['DOCUMENT_ROOT']."/libs/rb.php";

R::setup( 'mysql:host=localhost;dbname=blog',
        'root', 'root' ); 
//проверка коннекта
//$isConnected = R::testConnection();
//echo $isConnected;


session_start();

?>