<?php 
include_once $_SERVER['DOCUMENT_ROOT'] . "/php/db/db_connection.php";

$posts = R::findAll('posts','ORDER BY id DESC');
?>


<div class="container">
    <section id="content">
        <div class="row">
            <div class="col order-2 order-md-1 left-col">
            <? if(isset($_SESSION['logged_user'])) draw::post_form()?>
                <div class="posts-container">
                    <?php foreach ($posts as $post) { 
                    draw::post($post);
                    } ?>
                </div>
            </div>    
            <div class="col-12 col-md-3 order-1 order-md-2 right-col">
                <div class="right-col-content">
                    <? draw::side_bar(); ?>
                </div>
            </div>    
        </div>
    </section>
</div>           