<?php 
include_once $_SERVER['DOCUMENT_ROOT'] . "/php/db/db_connection.php";

$posts = R::findAll('posts','ORDER BY id DESC');
?>


<div class="container">
    <section id="content">
        <div class="row">
            <div class="col left-col">
                <?php foreach ($posts as $post) { 
                    draw::post($post);
                } ?>
            </div>    
            <div class="col-md-3 right-col">
                <div class="right-col-content">
                    <? draw::side_bar(); ?>
                </div>
            </div>    
        </div>
    </section>
</div>           