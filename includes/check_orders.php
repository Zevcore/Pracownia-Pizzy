<?php
    require '../vendor/autoload.php';
    use app\Controllers\OrderController;
    $order = new OrderController;
    $order->getLastOrders();