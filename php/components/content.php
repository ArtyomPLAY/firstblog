<?php 
include_once $_SERVER['DOCUMENT_ROOT'] . "/php/db/db_connection.php";

$posts = R::findAll('posts','ORDER BY id DESC');
?>


<div id="content">
        <div class="container">
            <div class="left-col">
                <?php foreach ($posts as $post) { 
                    draw::post($post);
                } ?>
            </div>    
            <div class="right-col">
                <div class="right-col-content">
                    <? draw::side_bar(); ?>
                </div>
            </div>    
        </div>
    </div>           