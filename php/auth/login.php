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
                echo 'success';
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

if(isset($data['post_id'])){
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
        echo 'liked';
    }
    else{
        R::exec("DELETE FROM actions WHERE id = '$liked->id'");
        $post->likes--;
        R::store($post);
        echo 'unliked';
        
    }
}
?>