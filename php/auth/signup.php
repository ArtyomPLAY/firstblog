<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/php/db/db_connection.php";

//TODO сообщения об ошибках регистрации отображаются на новой странице

$data = $_POST;
$errors = array();
$path = 'php/auth/';

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
        $user->avatar = '';
        $user->username = '';
        R::store($user);
        echo '<div style="color:green;">Registration successful.</div><hr>';
        header('Location: /');

    }       
}
?>


<!--<link rel="stylesheet" href="/css/login-popup.css">
<div id="login-wrap" style="display: block"></div>-->
    <div id="signup-popup" style="display: none">
        <button class="login-popup-close" tabindex="7">x</button>
        <form action="<?php echo $path ?>signup.php"  method="post">
            <h3>Sign up</h3>
            <input type="text" name="login" placeholder="login" required value="<?php echo @$data['login']?>" tabindex="1" readonly pattern="\D[^А-Яа-яЁё]+$"> 
            <input type="email" name="email" placeholder="email" required value="<?php echo @$data['email']?>" tabindex="2" readonly>
            <input type="password" name="password" placeholder="password" required tabindex="3" >
            <input type="password" name="password2" placeholder="confirm password" required tabindex="4" >
            <p class="passv-tip">Passwords do not match</p>
            <input type="submit" name="do_signup" value="Sign up" tabindex="5">
            <p><a tabindex="6" class="switch-tab">or log in</a></p>
        </form>
    </div>
