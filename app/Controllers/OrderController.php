<?php

namespace app\Controllers;
use app\Models\Order;

class OrderController extends Order{
    public function setOrderData($data){
        print_r($data);
        die();
        // $this->setOrder($data);
    }
}