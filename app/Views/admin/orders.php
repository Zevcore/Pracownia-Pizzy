<?php
    use app\Controllers\Route;
    use app\Controllers\OrderController;
    
    $order = new OrderController;

    if(isset($_POST['orderFinished'])){
        $order->finishOrder($_POST['orderId']);
    }

    $order->getAllUnfinished();
?>