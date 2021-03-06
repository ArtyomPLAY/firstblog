<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/php/db/db_connection.php";

//TODO сообщения об ошибках входа отображаются на новой странице

$data = $_POST;
$errors = array();
$path = 'php/auth/';

if(!isset($_SESSION['logged_user'])){


    if(isset($data['log_in'])){
        $user = R::findOne('users','login = ?',array($data['login']));
        if(!$user){
            $user = R::findOne('users','email = ?',array($data['login']));

        }    
        if($user){
            //существует

            if(password_verify($data['password'], $user->password)){
                //пароль введен правильно, авторизация
                $_SESSION['logged_user'] = $user;
                echo 1;
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


if(isset($data['sign_up'])){
    //если логин занят
    if(R::count('users',"login = ?", array($data['login']))>0){
        echo 'Login is already used';
    }
        //если емаил занят
    else if(R::count('users',"email = ?", array($data['email']))>0){
        echo 'Email is already used';
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
        echo 1;
    }     
}

//пост действия


if(isset($data['post_id']) && isset($data['like'])){
    if(isset($_SESSION['logged_user'])):
        $post = R::findOne('posts','id = ?', array($data['post_id']));
        $liked = R::findOne('actions','user_id = :user_id AND post_id = :post_id AND action_type = "1"',array(':user_id'=>$_SESSION['logged_user']->id,':post_id'=>$post->id));
        if(empty($liked)){
            $post->likes++;
            R::store($post);
            $query = R::dispense('actions');
                $query->user_id = $_SESSION['logged_user']->id;
                $query->post_id = $post->id;
                $query->action_type = 1; //1 - like ; 11 - repost
                $query->action_date = date('F j, H:i');
            R::store($query);
            echo 1;
        }
        else{
            R::exec("DELETE FROM actions WHERE id = '$liked->id'");
            $post->likes--;
            R::store($post);
            echo 2;
        }
    else: echo 'You are not logged in!';
    endif;
}

if(isset($data['post_id']) && isset($data['repost'])){
    if(isset($_SESSION['logged_user'])):
        $post = R::findOne('posts','id = ?', array($data['post_id']));
        $reposted = R::findOne('actions','user_id = :user_id AND post_id = :post_id AND action_type = "11"',array(':user_id'=>$_SESSION['logged_user']->id,':post_id'=>$post->id)); 
        if(empty($reposted)){
            $post->reposts++;
            R::store($post);
            $query = R::dispense('actions');
            $query->user_id = $_SESSION['logged_user']->id;
            $query->post_id = $post->id;
            $query->action_type = 11; //1 - like ; 11 - repost
            $query->action_date = date('F j, H:i');
            R::store($query);
            echo 1;
        }
        else{
            R::exec("DELETE FROM actions WHERE id = '$reposted->id'");
            $post->reposts--;
            R::store($post);
            echo 2;
        }
    else: echo 'You are not logged in!';
    endif;
}
?>