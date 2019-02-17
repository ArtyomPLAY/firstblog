<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/php/db/db_connection.php";

//TODO сообщения об ошибках входа отображаются на новой странице

$data = $_POST;
$errors = array();
$path = 'php/auth/';

if(!isset($_SESSION['logged_user'])){


    if(isset($data['login'])){
        $user = R::findOne('users','login = ?',array($data['login']));
        if(!$user){
            $user = R::findOne('users','email = ?',array($data['login']));

        }    
        if($user){
            //существует

            if(password_verify($data['password'], $user->password)){
                //пароль введен правильно, авторизация
                echo '<div style="color:green;">Log in successful.</div><hr>';
                $_SESSION['logged_user'] = $user;
                //header("Refresh: 0");
                header("Refresh: 0");
            }   
            else{
                echo 'Password is wrong';
            }
        }
        //логин не существует
        else{
            echo 'Email or login is wrong';
        }
    }
}
?>