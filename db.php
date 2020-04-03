<?php
class Database {

    private $dsn = 'mysql:host=localhost;dbname=php_oops_crud';
    private $user = 'root';
    private $pass = '';

    public $conn;

    public function __construct() {
        try {
            $this->conn = new PDO($this->dsn, $this->user, $this->pass);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function insert($fname, $lname, $email, $phone) {
        
        $sql = 'INSERT INTO usuarios (primeiro_nome, ultimo_nome, email, phone) VALUES (:fname, :lname, :email, :phone)';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'fname'=>$fname,
            'lname'=>$lname,
            'email'=>$email,
            'phone'=>$phone
        ]);
        return true;
    }

    public function read() {

        $data = array();
        $sql = 'SELECT * FROM usuarios';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as $linha) {
            $data[] = $linha;
        }
        return $data;
    }

    public function getUserById($id) {

        $sql = 'SELECT * FROM usuarios WHERE id = :id';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id'=>$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function update($id, $fname, $lname, $email, $phone) {

        $sql = 'UPDATE usuarios SET primeiro_nome = :fname, ultimo_nome = :lname, email = :email, phone = :phone WHERE id = :id';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'fname'=>$fname,
            'lname'=>$lname,
            'email'=>$email,
            'phone'=>$phone,
            'id'=>$id
        ]);
        return true;
    }

    public function delete($id) {

        $sql = 'DELETE FROM usuarios WHERE id = :id';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id'=>$id]);
        return true;
    }

    public function totalRowCount() {
        $sql = 'SELECT * FROM usuarios';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $t_rows = $stmt->rowCount();
        return $t_rows;
    }
}