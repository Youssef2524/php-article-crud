<?php
class Database {
    private $host = "localhost"; 
    private $db_name = "blog_db";  
    private $username = "root";  
    private $password = ""; 
    private $conn;

    // contection to db
    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection error: " . $e->getMessage();
        }

        return $this->conn;
    }

    // وظيفة لتنفيذ استعلامات 
    public function execute($query, $params = []) {
        try {
            $stmt = $this->conn->prepare($query);
            return $stmt->execute($params);
        } catch (PDOException $e) {
            echo "Query error: " . $e->getMessage();
            return false;
        }
    }

    // وظيفة لجلب النتائج من استعلام 
    public function fetch($query, $params = []) {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Fetch error: " . $e->getMessage();
            return [];
        }
    }
}
