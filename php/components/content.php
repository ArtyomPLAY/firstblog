<?php 
include_once $_SERVER['DOCUMENT_ROOT'] . "/php/db/db_connection.php";

$posts = R::findAll('posts','ORDER BY id DESC');

?>


<div id="content">
        <?php foreach ($posts as $post) { ?>
        <div class="container">
            <div class="post">
                <div class="post-author">
                    <img src="content/me.png" alt="Author's avatar">
                    <div>
                        <span> 
                            <?php $user = R::findOne('users', 'id = ?', array($post->authors_id)); echo $user->login; ?>
                        </span>
                        <p class="post-date"><?php echo $post->pub_date;?></p>
                    </div>
                </div>
                <h3 class="post-title"><?php echo $post->title; ?></h3>
                <div class="post-content">
                    <?php echo $post->content;?>
                </div>
            </div>
        </div>
        <? } ?>
    </div>           