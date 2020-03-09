<?php

namespace app\Models;
use app\Models\Dbh;

class Auth extends Dbh{
    protected function getUser($login){
        $sql = "SELECT * FROM `users` WHERE `login` = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$login]);

        $result = $stmt->fetchAll();

        return $result ? $result[0] : NULL;
    }
}