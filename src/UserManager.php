<?php

 namespace Ashraful\TestProject;

use InvalidArgumentException;
 use PDO;

 class UserManager
  {
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function createUser($name)
    {
        if (empty($name)) {
            throw new InvalidArgumentException('Name cannot be empty');
        }
        $stmt = $this->pdo->prepare("INSERT INTO users(name) VALUES(:name)");
        $stmt->execute([':name' => $name]);

        return $this->pdo->lastInsertId();
    }

    public function getUser($userId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id=:id");
        $stmt->execute([':id' => $userId]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateUser($userId, $newName)
    {
        if (empty($newName)) {
            throw new InvalidArgumentException('New name cannot be empty');
        }
        $stmt = $this->pdo->prepare("UPDATE users SET name=:name WHERE id=:id");
        $stmt->execute([':id' => $userId, ':name' => $newName]);
    }

    public function deleteUser($userId)
    {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE id=:id");
        $stmt->execute([':id' => $userId]);
    }
 }

?>