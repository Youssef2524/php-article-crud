<?php
class Post {
    private $conn;
    private $table_name = "posts";
    public $id;
    public $title;
    public $content;
    public $author;
    public $created_at;
    public $updated_at;

    public function __construct($conn, $id = null, $title = null, $content = null, $author = null, $created_at = null, $updated_at = null) {
        $this->conn = $conn;
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->author = $author;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    // create post new
    public function create() {
        // validateion required
        if (empty($this->title) || empty($this->content) || empty($this->author)) {
            return "All fields are required."; 
        }
        $query = "INSERT INTO " . $this->table_name . " (title, content, author) VALUES (:title, :content, :author)";
        $stmt = $this->conn->prepare($query);

        // validation string not tag
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->content = htmlspecialchars(strip_tags($this->content));
        $this->author = htmlspecialchars(strip_tags($this->author));

        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":content", $this->content);
        $stmt->bindParam(":author", $this->author);
    

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // read post
    public function read($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // update post 
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET title = :title, content = :content, author = :author WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // validation string not tag
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->content = htmlspecialchars(strip_tags($this->content));
        $this->author = htmlspecialchars(strip_tags($this->author));

        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":content", $this->content);
        $stmt->bindParam(":author", $this->author);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    //  delete post
    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$id]);
    }

    // view all posts
    public function listAll() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // search post 
    public function searchPosts($search) {
        $query = "SELECT * FROM " . $this->table_name . " 
                  WHERE title LIKE ? OR content LIKE ?
                  ORDER BY created_at DESC";

        $stmt = $this->conn->prepare($query);
        $search = "%{$search}%";
        $stmt->execute([$search, $search]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
