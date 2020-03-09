<?php

namespace app\Controllers;
use app\Models\Menu;

class MenuController extends Menu{
    public function getMenu() {
        return $this->getAllRecords();
    }
}