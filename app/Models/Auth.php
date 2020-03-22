<?php

namespace app\Models;
use app\Models\Dbh;
use app\Controllers\Route;

class Auth extends Dbh{
    protected function getUser($login){
        $sql = "SELECT * FROM `users` WHERE `login` = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$login]);

        $result = $stmt->fetchAll();

        return $result ? $result[0] : NULL;
    }

    protected function getAllUsers() {
        $sql = "SELECT * FROM `users`";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll();
        return $result;
    }

    protected function addUser($login, $password, $name) {
        $sql = "INSERT INTO `users`(`login`, `password`, `name`) VALUES (?, ?, ?);";
        $stmt = $this->connect()->prepare($sql);
        return $stmt->execute([$login, $password, $name]);
    }

    protected function deleteUser($id) {
        $sql = "DELETE FROM `users` WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        return $stmt->execute([$id]);
    }
}