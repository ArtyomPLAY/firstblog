<?php 
include_once $_SERVER['DOCUMENT_ROOT'] . "/php/db/db_connection.php";

$posts = R::findAll('posts','ORDER BY id DESC');
?>


<div id="content">
        <div class="container">
            <div class="left-col">
                <?php foreach ($posts as $post) { 
                $user = R::findOne('users', 'id = ?', array($post->authors_id));//поиск юзера по id ?>
                <div class="post">
                    <div class="post-author">
                        <img src="<?php if($user->avatar) echo $user->avatar; else echo 'content/none_avatar.png'; ?>" alt="Author's avatar">
                        <div>
                            <span> 
                                <?php echo $user->login; ?>
                            </span>
                            <p class="post-date"><?php echo $post->pub_date;?></p>
                        </div>
                    </div>
                    <h3 class="post-title"><?php echo $post->title; ?></h3>
                    <div class="post-content">
                        <?php echo $post->content;?>
                    </div>
                </div>
                <? } ?>
            </div>    
            <div class="right-col">
                <div>
                    <button>Write Post</button>
                </div>
            </div>
        </div>
    </div>           