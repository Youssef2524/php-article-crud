<?php
include_once '../sql/Database.php';
include_once 'Post.php';

$database = new Database();
$db = $database->getConnection();

$post = new Post($db);

if (isset($_GET['id'])) {
    if ($post->delete($_GET['id'])) {
        header("Location: list_posts.php");
    } else {
        echo "nit deleted.";
    }
}
?>
