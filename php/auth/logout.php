<?php

require $_SERVER['DOCUMENT_ROOT']. "/php/db/db_connection.php";

unset($_SESSION['logged_user']);

header('Location: /');

?>