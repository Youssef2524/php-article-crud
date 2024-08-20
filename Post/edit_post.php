<?php
include_once '../sql/Database.php';
include_once './post.php';

$database = new Database();
$db = $database->getConnection();

$post = new Post($db);

if ($_POST) {
    $post->id = $_POST['id'];
    $post->title = $_POST['title'];
    $post->content = $_POST['content'];
    $post->author = $_POST['author'];

    if ($post->update()) {
        header("Location: list_posts.php");
    } else {
        echo "Unable to update post.";
    }
} elseif (isset($_GET['id'])) {
    $data = $post->read($_GET['id']);
    if ($data) {
?>

<!-- start css -->
<style>

form {
  background-color: #444444;
  border-radius: 10px;
  padding: 20px;
  width: 300px;
  margin: 50px auto;
}

.lb {
  display: block;
  margin-bottom: 10px;
  font-size: 18px;
  font-weight: bold;
}

.infos[type="text"], input[type="title"], input[type="content"] {
  width: 100%;
  padding: 10px;
  font-size: 16px;
  border-radius: 5px;
  border: none;
  margin-bottom: 20px;
  background-color: #333333;
  color: white;
}

#send {
  --glow-color: rgb(176, 255, 189);
  --glow-spread-color: rgba(123, 255, 160, 0.781);
  --enhanced-glow-color: rgb(182, 175, 71);
  --btn-color: rgba(13, 241, 21, 0.508);
  border: .25em solid var(--glow-color);
  padding: 1em 2em;
  color: var(--glow-color);
  font-size: 14px;
  font-weight: bold;
  background-color: var(--btn-color);
  border-radius: 1em;
  outline: none;
  box-shadow: 0 0 1em .25em var(--glow-color),
        0 0 4em 1em var(--glow-spread-color),
        inset 0 0 .05em .25em var(--glow-color);
  text-shadow: 0 0 .5em var(--glow-color);
  position: relative;
  transition: all 0.3s;
  margin-left: 100px;
  margin-top: 20px;
}

#send::after {
  pointer-events: none;
  content: "";
  position: absolute;
  top: 120%;
  left: 0;
  height: 100%;
  width: 100%;
  background-color: var(--glow-spread-color);
  filter: blur(2em);
  opacity: .7;
  transform: perspective(1.5em) rotateX(35deg) scale(1, .6);
}

#send:hover {
  color: var(--btn-color);
  background-color: var(--glow-color);
  box-shadow: 0 0 1em .25em var(--glow-color),
        0 0 4em 2em var(--glow-spread-color),
        inset 0 0 .75em .25em var(--glow-color);
}

#send:active {
  box-shadow: 0 0 0.6em .25em var(--glow-color),
        0 0 2.5em 2em var(--glow-spread-color),
        inset 0 0 .5em .25em var(--glow-color);
}

#limpar {
  --glow-color: rgb(255, 176, 176);
  --glow-spread-color: rgba(255, 123, 123, 0.781);
  --enhanced-glow-color: rgb(182, 175, 71);
  --btn-color: rgba(241, 13, 13, 0.508);
  border: .25em solid var(--glow-color);
  padding: 1em 2em;
  color: var(--glow-color);
  font-size: 14px;
  font-weight: bold;
  background-color: var(--btn-color);
  border-radius: 1em;
  outline: none;
  box-shadow: 0 0 1em .25em var(--glow-color),
        0 0 4em 1em var(--glow-spread-color),
        inset 0 0 .05em .25em var(--glow-color);
  text-shadow: 0 0 .5em var(--glow-color);
  position: relative;
  transition: all 0.3s;
}

#limpar::after {
  pointer-events: none;
  content: "";
  position: absolute;
  top: 120%;
  left: 0;
  height: 100%;
  width: 100%;
  background-color: var(--glow-spread-color);
  filter: blur(2em);
  opacity: .7;
  transform: perspective(1.5em) rotateX(35deg) scale(1, .6);
}

#limpar:hover {
  color: var(--btn-color);
  background-color: var(--glow-color);
  box-shadow: 0 0 1em .25em var(--glow-color),
        0 0 4em 2em var(--glow-spread-color),
        inset 0 0 .75em .25em var(--glow-color);
}

#limpar:active {
  box-shadow: 0 0 0.6em .25em var(--glow-color),
        0 0 2.5em 2em var(--glow-spread-color),
        inset 0 0 .5em .25em var(--glow-color);
}
    </style>
<!-- end css -->

<!-- form edit the post and information post -->
<form class="form" method="POST" >

<input type="hidden" id="title" type="title" class="infos" name="id" value="<?php echo $data['id']; ?>">
<label for="title" class="lb">title:</label>
<input type="text" id="title" type="title" class="infos" name="title" value="<?php echo $data['title']; ?>">
<label for="content" class="lb">content:</label>
<input type="text" id="title" type="title" class="infos" name="content" value="<?php echo $data['content']; ?>">
<label for="author" class="lb">author:</label>

<input type="text" id="title" type="title" class="infos" name="author" value="<?php echo $data['author']; ?>">
<input id="send" type="submit" value="Update Post">

 
<?php
    } else {
        echo "Post not found.";
    }
}

?>
