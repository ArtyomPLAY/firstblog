<!DOCTYPE html>
<meta name="theme-color" content="#007991">
<html lang="en">
<?php 
include_once $_SERVER['DOCUMENT_ROOT'] . "/php/db/db_connection.php";

if(isset($_GET['id'])){
    $data = $_GET;
    $user = R::findOne('users','id = ?', array($data['id']));
}
else
    echo 'ERROR 404';
    
if(empty($user)){ ?>
    <link rel="stylesheet" href="css/main.css">
    <div id="error-page">
        <div class="content">
            <p>🤨</p>
            <div class="error-text">
                <h2>Page not found</h2>
                <h4>Who are you looking for?</h4>
            </div>
        </div>
    </div>


<?}
else{
    $posts = R::findAll('posts','authors_id=? ORDER BY id DESC',array($user->id));
    ?>
    <head>
        <meta charset="UTF-8">
        <link href="https://fonts.googleapis.com/css?family=Rubik:400,500,700&amp;subset=cyrillic" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">        
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="css/main.css">
        <link rel="icon" href="/content/ico.png">
        <title><? echo '@',$user->login,' - ',$user->username;?></title>
    </head>

    <body>

        <?php include 'php/components/header.php'; ?>

    <div class="container">
        <section id="content">
            <div class="row">
                <div class="col left-col">
                        <div class="user-card">
                            <div class="top">
                                <div class="row">
                                    <div class="col main-info">
                                        <img src="<? echo $user->avatar ?>" alt="avatar" class="avatar">
                                        <div class="info">
                                            <h4 class="user-name"><? echo $user->login ?></h4>
                                            <p class="real-name"><? echo $user->username ?></p>
                                        </div>
                                    </div>    
                                    <div class="col social-acts">

                                    </div>
                                </div>
                                <p class="bio-article">I'm 18 y.o. Since 13 y.o. i am interested in design and programming. Now i'm actively learning web technologies and UI/UX design. Also have 3d-modelling skills.</p>
                            </div>
                            <div class="user-stats">
                                <div class="stats-card">
                                    <h4>posts</h4>
                                    <h3><? echo $user->posts_counter;?></h3>
                                </div>
                                <div class="stats-card">
                                    <? $rating = R::getAll('SELECT SUM(likes) FROM POSTS WHERE authors_id = ?',array($user->id));?>
                                    <h4>Rating</h4>
                                    <h3><? echo $rating[0]["SUM(likes)"];?></h3>
                                </div>
                                <div class="stats-card">
                                    <h4>friends</h4>
                                    <h3><? echo 5;?></h3>
                                </div>
                                <div class="stats-card">
                                    <h4>followers</h4>
                                    <h3><? echo 36?></h3>
                                </div>
                                <div class="stats-card">
                                    <h4>following</h4>
                                    <h3><? echo 24?></h3>
                                </div>
                            </div>
                        </div>
                        <div class="posts">
                        <? if($_SESSION['logged_user']->id == $data['id'])
                            draw::post_form()?>
                                <? foreach($posts as $post) {
                                    draw::post($post);
                                } ?>
                        </div>
                    </div>
                    <div class="col-md-3 right-col">
                        <div class="right-col-content">
                            <? draw::side_bar(); ?>
                        </div>
                    </div>  
                </div>
        </section>
    </div>   
    <?php include 'php/components/footer.php'; ?>
    <script src="libs/jquery-3.3.1.min.js"></script>
    <script src="scripts/main.js"></script>
    <script src="scripts/ajax.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

</body>
</html>
<? } ?>
