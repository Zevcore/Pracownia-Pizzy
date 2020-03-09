<?php
    use app\Controllers\AuthController;
    use app\Controllers\Route;
    AuthController::checkLoggedIn();
    AuthController::logout();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pracownia Pizzy | Admin Panel</title>
    <link rel="stylesheet" href="<?= Route::homePage(); ?>/styles/pa/main.css"> 
</head>
<body>

    <header class="header">
        <ul class='adminMenu'>
            <li><a href="<?= Route::homePage(); ?>">Strona Główna</a></li>
            <li><a href="admin/dashboard">Zamówienia</a></li>
            <li><a href="admin/menu">Moje Menu</a></li>
            <li><a href="admin/users">Użytkownicy</a></li>
            <li><a href="admin/logout">Wyloguj się</a></li>
        </ul>
    </header>

    <?php 
        Route::loadAdminView();
    ?>

</body>
</html>