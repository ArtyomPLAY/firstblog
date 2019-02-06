<?php 
include_once $_SERVER['DOCUMENT_ROOT'] . "/php/db/db_connection.php";

$data = $_POST;
if(isset($data['post_submit']))
{
   $post = R::dispense('posts');
   $post->title = $data['title'];
   $post->content = $data['content'];
   $post->authors_id = $_SESSION['logged_user']->id;
   $post->pub_date = date('Y-m-d G:i');
   R::store($post);
}


?>
<form action="post_form.php" method="post">
    <input type="text" name="title" placeholder="Title" required>
    <textarea name="content" cols="30" rows="45" placeholder="Write text" required></textarea>
    <input type="submit" value="post" name="post_submit">
</form>
