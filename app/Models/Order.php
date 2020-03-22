<?php

namespace app\Models;
use app\Models\Dbh;

class Order extends Dbh{
    protected function setOrder($data){
        $sql = "INSERT INTO `orders`(`menu_ids`, `address`, `phone`, `email`, `payment`, `price`) VALUES(?, ?, ?, ?, ?, ?);";
        $stmt = $this->connect()->prepare($sql);
        
        return $stmt->execute([$data['orders'], $data['address'], $data['phone'], $data['email'], $data['payment'], $data['full_price']]);
    }

    protected function getNewestOrders(){
        $sql = "SELECT * FROM `orders` WHERE `user_id` IS NULL";
        $stmt = $this->connect()->prepare($sql);

        if(!$stmt->execute()) return 0;

        $result = $stmt->fetchAll();
        return $result;
    }

    protected function setAcceptOrder($id, $uid){
        $sql = "UPDATE `orders` SET `user_id` = ? WHERE `id` = ?";
        $stmt = $this->connect()->prepare($sql);
        if(!$stmt->execute([$uid, $id])) return 0;

        $sql = "UPDATE `users` SET `orders` = `orders`+1 WHERE `id` = ?";
        $stmt = $this->connect()->prepare($sql);
        return $stmt->execute([$uid]);
    }

    protected function removeOrder($id){
        $sql = "DELETE FROM `orders` WHERE `id` = ?";
        $stmt = $this->connect()->prepare($sql);
        return $stmt->execute([$id]);
    }

    protected function getUnfinishedOrders(){
        $sql = "SELECT * FROM `orders` WHERE `finished` = 0;";
        $stmt = $this->connect()->prepare($sql);
        if(!$stmt->execute()) return 0;
        
        $result = $stmt->fetchAll();
        return $result;
    }

    protected function getOrder($id) {
        $sql = "SELECT * FROM `orders` WHERE id = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);

        $result = $stmt->fetchAll();
        return $result;
    }

    protected function setOrderFinished($id){
        $sql = "UPDATE `orders` SET `finished` = 1 WHERE `id` = $id";
        $stmt = $this->connect()->prepare($sql);
        return $stmt->execute([$id]);
    }
}