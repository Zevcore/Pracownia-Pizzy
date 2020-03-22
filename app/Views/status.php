<?php
    use app\Controllers\Route;
    if(!isset($_SESSION['order_redirect'])){
        header("Location: ".Route::homePage());
        die();
    }else{
        unset($_SESSION['order_redirect']);
    }

    require_once('header.php');
?>

<section class="status">
    <h1>Status zamówienia</h1>
    <p>Twoje zamówienie oczekuje na akceptację przez pizzerię!</p>
    <p>O postępach zostaniesz poinformowany/-a pocztą elektroniczną!</p>
    <a href="/kontakt">Kontakt</a>
</section>