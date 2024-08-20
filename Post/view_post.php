<?php
include_once '../sql/Database.php';
include_once './post.php';

$database = new Database();
$db = $database->getConnection();

$post = new Post($db);

if (isset($_GET['id'])) {
    $data = $post->read($_GET['id']);
    if ($data) {
        echo "<h1>" . $data['title'] . "</h1>";
        echo "<p>" . $data['content'] . "</p>";
        echo "By: " . $data['author'] . " on " . $data['created_at'] . "";
    } else {
        echo "Post not found.";
    }
}
