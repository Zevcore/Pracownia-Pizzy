<?php
    use app\Controllers\Route;
    use app\Controllers\OrderController;

    if(isset($_POST['acceptOrder'])){
        $order = new OrderController;
        $order->acceptOrder($_POST['orderId']);
    }

    if(isset($_POST['declineOrder'])){
        $order = new OrderController;
        $order->declineOrder($_POST['orderId'], $_POST['reason']);
    }
?>

<script src='<?= Route::homePage(); ?>/scripts/check_orders.js'></script>

<section class='ordersTable'></section>