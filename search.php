<!DOCTYPE html>
<meta name="theme-color" content="#007991">
<html lang="en">
<?php 
include_once $_SERVER['DOCUMENT_ROOT'] . "/php/db/db_connection.php";

if(isset($_GET['tag'])){
    $data_get = $_GET;
}
else
    echo 'ERROR 404';

$posts = R::findAll('posts','tags LIKE :tag ORDER BY id DESC',array(':tag'=> '%'.'#'.$data_get['tag'].'%'));
?>
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,500,700&amp;subset=cyrillic" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/main.css">
    <link rel="icon" href="/content/ico.png">
    <title><? echo '#', $data_get['tag'] ?></title>
</head>

<body>

    <?php include 'php/components/header.php'; ?>

    <div id="content">
        <div class="container">
            <div class="left-col">
                <div class="post">
                    <h4><? echo '#', $data_get['tag'] ?></h4>
                </div>
                <? foreach ($posts as $post) { 
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
    <?php include 'php/components/footer.php'; ?>
    
    <script src="libs/jquery-3.3.1.min.js"></script>
    <script src="scripts/main.js"></script>
    <script src="scripts/ajax.js"></script>

</body>

</html>