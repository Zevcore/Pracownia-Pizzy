<?php

namespace app\Models;
use app\Models\Dbh;

class Menu extends Dbh{
    protected function getAllRecords() {
        $sql = "SELECT * FROM `menu`";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll();
        return $result;
    }
}