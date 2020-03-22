<?php

namespace app\Controllers;
use app\Models\Menu;
use app\Controllers\Route;

class MenuController extends Menu{
    public function getMenu() {
        return $this->getAllRecords();
    }

    public function checkPizza($name, $ingridients, $price, $image) {
        $target_dir = "assets/pizza_img/";
        $target_file = $target_dir . basename($_FILES['image']['name']);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
           return;
        }

        if(move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            $this->savePizza($name, $ingridients, $price, $target_file);
        }
    }

    public function editPizza($name, $ingridients, $price, $id) {
        return $this->editSinglePizza($name, $ingridients, $price, $id);
    }

    public function deleteExistPizza($id) {
        return $this->deletePizza($id);
    }

    public function getSingleRecord($id) {
        return $this->getSingleMenuRecord($id);
    }

}