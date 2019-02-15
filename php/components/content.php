<?php 
include_once $_SERVER['DOCUMENT_ROOT'] . "/php/db/db_connection.php";

$posts = R::findAll('posts','ORDER BY id DESC');
?>


<div id="content">
        <div class="container">
            <div class="left-col">
                <?php foreach ($posts as $post) { 
                $user = R::findOne('users', 'id = ?', array($post->authors_id));//поиск юзера по id ?
                    post_drawer($post,$user);
                } ?>
            </div>    
            <div class="right-col">
                <div class="right-col-content">
                    <? sidebar_drawer(); ?>
                </div>
            </div>    
        </div>
    </div>           