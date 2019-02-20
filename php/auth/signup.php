<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/php/db/db_connection.php";

//TODO сообщения об ошибках регистрации отображаются на новой странице

$data = $_POST;
$errors = array();
//$path = 'php/auth/';

if (isset($data['do_signup'])) {

        //если логин занят
    if(R::count('users',"login = ?", array($data['login']))>0){
        echo '<div style="color:red;">', 'This login is already in use, try again.', '</div><hr>';
    }
        //если емаил занят
    else if(R::count('users',"email = ?", array($data['email']))>0){
        echo '<div style="color:red;">', 'This email is already in use, try again.', '</div><hr>'; 
    }
        //если не занят ни емаил ни логин
    else{
        $user = R::dispense('users');
        $user->login = $data['login'];
        $user->email = $data['email'];
        $user->password = password_hash($data['password'],PASSWORD_DEFAULT);
        $user->avatar = 'content/none_avatar.png';
        $user->username = '';
        $user->posts_counter = 0;
        R::store($user);
        echo '<div style="color:green;">Registration successful.</div><hr>';
        header('Location: /');

    }       
}
draw::user_menu();
?>

