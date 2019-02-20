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
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="css/main.css">
        <link rel="icon" href="/content/ico.png">
        <title><? echo '@',$user->login,' - ',$user->username;?></title>
    </head>

    <body>

        <?php include 'php/components/header.php'; ?>

        <div id="content">
            <div class="container">
                <div class="left-col">
                    <div class="user-page">
                        <div class="user-about">
                            <img src="<? echo $user->avatar ?>" alt="avatar" class="avatar">
                            <div class="bio">
                                <h4 class="user-name"><? echo $user->login ?></h4>
                                <p class="real-name"><? echo $user->username ?></p>
                                <p class="bio-article">I'm 18 y.o. Since 13 y.o. i am interested in design and programming. Now i'm actively learning web technologies and UI/UX design. Also have 3d-modelling skills.</p>
                            </div>
                        </div>
                        <div class="user-stats">
                            <div class="stats-card">
                                <h4>Written posts</h4>
                                <h3><? echo $user->posts_counter;?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="posts">
                            <? foreach($posts as $post) {
                                draw::post($post);
                            } ?>
                    </div>
                </div>
                <div class="right-col">
                    <div class="right-col-content">
                        <? draw::side_bar(); ?>
                    </div>
                </div>  
            </div>
        </div>
        <?php include 'php/components/footer.php'; ?>
        <script src="libs/jquery-3.3.1.min.js"></script>
        <script src="scripts/main.js"></script>
        <script src="scripts/ajax.js"></script>

    </body>

    </html>
<? } ?>
