<!DOCTYPE html>
<html lang="en">
<head>
  <title>list post </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<?php
include_once '../sql/Database.php';
include_once './post.php';

$database = new Database();
$db = $database->getConnection();

$post = new Post($db);
$posts = $post->listAll();
?>

<div class="container mt-3">
  <h2>Posts</h2>
  <a href="create_post.php" class="btn btn-success btn-sm m-3 p-2">Add</a>
<!-- form serch -->

  <form method="GET" action="list_posts.php" class="mb-4">
     <div class="input-group">
       <input type="text" name="search" class="form-control" placeholder="Search by title or content" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
       <button class="btn btn-primary" type="submit">Search</button>
     </div>
   </form>
 
   <?php
      $search = isset($_GET['search']) ? $_GET['search'] : '';
      $posts = $post->searchPosts($search);
      ?>


<!-- table posts -->
  <table class="table table-dark table-striped">
    <thead>
      <tr>
        <th>Title</th>
        <th>Content</th>
        <th>Author</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($posts as $post): ?>
      <tr>
        <td><?php echo $post['title']; ?></td>
        <td><?php echo $post['content']; ?></td>
        <td><?php echo $post['author']; ?></td>
      <td>  <a href="edit_post.php?id=<?php echo $post['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
          <a href="delete_post.php?id=<?php echo $post['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure delete?');">Delete</a>
          <a href="view_post.php?id=<?php echo $post['id']; ?>" class="btn btn-info btn-sm">view</a>

        </td>
    </tr>

      <?php endforeach; ?>
    </tbody>
  </table>
</div>
    
</body>
</html>
