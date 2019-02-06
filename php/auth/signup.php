<?php
include_once $_SERVER['DOCUMENT_ROOT'] . "/php/db/db_connection.php";

//TODO сообщения об ошибках регистрации отображаются на новой странице

$data = $_POST;
$errors = array();
$path = 'php/auth/';

if (isset($data['do_signup'])) {

    if($data['password'] != $data['password2']){
        $errors[] = 'Re-password do not match, try again';
    }
    //TODO что то не так с регой на этапе когда все правильно, отдалить 
    if(empty($errors)){ 
        //если нет ошибок, то 
        echo 'ошибок нет!';
        //если логин занят
        var_dump($data);
        if(R::count('users',"login = ?", array($data['login']))>0){
            $errors[] = "This login is already taken, try again.";
        }
        //если емаил занят
        else if(R::count('users',"email = ?", array($data['email']))>0){
            $errors[] = "This email is already in use, try again.";
        }
        //если не занят ни емаил ни логин
        else{
            $user = R::dispense('users');
            $user->login = $data['login'];
            $user->email = $data['email'];
            $user->password = password_hash($data['password'],PASSWORD_DEFAULT);
            R::store($user);
            header("Location: /");
            echo '<div style="color:green;">Registration successful.</div><hr>';
        }
    }
    else{
        echo '<div style="color:red;">', array_shift($errors), '</div><hr>';
    } 
}
?>


<!--<link rel="stylesheet" href="/css/login-popup.css">
<div id="login-wrap" style="display: block"></div>-->
    <div id="signup-popup" style="display: <?php if(isset($data['do_signup'])){echo 'block';}else echo 'none'; ?>">
        <button onclick="show('none');" tabindex="7">x</button>
        <form action="<?php echo $path ?>signup.php"  method="post">
            <h3>Sign up</h3>
            <input type="text" name="login" placeholder="login" required value="<?php echo @$data['login']?>" tabindex="1"> 
            <input type="email" name="email" placeholder="email" required value="<?php echo @$data['email']?>" tabindex="2">
            <input type="password" name="password" placeholder="password" required tabindex="3">
            <input type="password" name="password2" placeholder="confirm password" required tabindex="4">
            <input type="submit" name="do_signup" value="Sign up" tabindex="5">
            <p><a tabindex="6" onclick="switchTab('login-popup');">or log in</a></p>
        </form>
    </div>
