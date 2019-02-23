<!DOCTYPE html>
<meta name="theme-color" content="#ffffff">
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
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
    <link rel="icon" href="/content/ico.png">
    <title><? echo '#', $data_get['tag'] ?></title>
</head>

<body>

    <?php include 'php/components/header.php'; ?>

<div class="container">
    <section id="content">
        <div class="row">
            <div class="col left-col">
                <div class="post">
                    <h4><? echo '#', $data_get['tag'], ' - ',count($posts),' ',count($posts) == 1 ? 'post' : 'posts' ?></h4>
                </div>
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
    <section id="content">
 </div> 
           

    <?php include 'php/components/footer.php'; ?>
    
    <script src="libs/jquery-3.3.1.min.js"></script>
    <script src="scripts/main.js"></script>
    <script src="scripts/ajax.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

</body>

</html>