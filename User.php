<?php
class User {
    public $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function create($nome, $email, $senha){
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUE (?, ?, ?)");
        return $stmt->execute([$nome, $email, $senhaHash]);
    }

    public function getAll(){
        $stmt = $this->pdo->query("SELECT * FROM usuarios");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($id, $nome, $email){
        $stmt = $this->pdo->prepare("UPDATE usuarios SET nome=? email, email=? WHERE id=?");
        return $stmt->execute([$nome, $email, $id]);
    }

    public function delete($id){
        $stmt = $this->pdo->prepare("DELETE FROM usuarios WHERE id=?");
        return $stmt->execute([$id]);
    }
}
?>