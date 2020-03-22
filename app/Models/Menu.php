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

    protected function savePizza($name, $ingridients, $price, $image_dir) {
        $sql = "INSERT INTO `menu`(`name`, `ingredients`, `price`, `image`) VALUES
        (?, ?, ?, ?);";
        $stmt = $this->connect()->prepare($sql);
        return $stmt->execute([$name, $ingridients, $price, $image_dir]);
    }

    public function getItemName($id){
        $sql = "SELECT `name` FROM `menu` WHERE `id` = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);

        $result = $stmt->fetchAll();
        return $result[0]['name'];
    }

    protected function deletePizza($id) {
        $sql = "DELETE FROM `menu` WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        return $stmt->execute([$id]);
    }

    protected function getSingleMenuRecord($id) {
        $sql = "SELECT * FROM `menu` WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetchAll();
        return $result;
    }

    protected function editSinglePizza($name, $ingridients, $price, $id) {
        $sql = "UPDATE `menu` SET `name`=?,`ingredients`=?,`price`=? WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        return $stmt->execute([$name, $ingridients, $price, $id]);
    }
}