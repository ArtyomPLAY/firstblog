<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/php/db/db_connection.php";

//TODO сообщения об ошибках входа отображаются на новой странице

$data = $_POST;
$errors = array();
$path = 'php/auth/';

if(!isset($_SESSION['logged_user'])){


if(isset($data['do_login'])){
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
            header("Location: /");
        }   
        else{
            $errors[] = 'Password is incorrect';
        }
    }
    //логин не существует
    else{
        $errors[] = 'Login or email not found';
    }

    if(!empty($errors)){
        echo '<div style="color:red;">', $errors ,'</div><hr>';
    }
}

?>

<link rel="stylesheet" href="/css/main.css">
<div id="login-wrap" style="display: none"></div>
<?php require "signup.php"; ?>
    <div id="login-popup" style="display: none;">
        <button class="login-popup-close" tabindex="5">x</button>
        <form action="<?php echo $path ?>login.php"  method="post">
            <h3>Log in</h3>
            <input type="text" placeholder="login" tabindex="1" required name="login" readonly pattern="\D[^А-Яа-яЁё]+$">
            <input type="password" placeholder="password"
            tabindex="2" required name="password" readonly>
            <input type="submit" value="Log in" tabindex="3" name="do_login">
            <p><a tabindex="4" class="switch-tab">or sign up</a></p>
        </form>
    </div>

<?php } ?>