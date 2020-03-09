<?php
    use app\Controllers\AuthController;
    AuthController::checkLoggedIn();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pracownia Pizzy | Admin Panel</title>
    <link rel="stylesheet" href="../styles/admin/main.css"> 
</head>
<body>

    <header class="header">
        <ul>
            <li><a href="">Zamówienia</a></li>
            <li><a href="">Moje Menu</a></li>
            <li><a href="">Użytkownicy</a></li>
            <li><a href="">Wyloguj się</a></li>
        </ul>
    </header>

    <?php 
        use app\Controllers\Route;
        Route::loadAdminView();
    ?>

</body>
</html>