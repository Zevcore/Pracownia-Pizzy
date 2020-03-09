<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pracownia Pizzy</title>

    <link rel="stylesheet" href="styles/index/main.css">
    <script
    src="https://code.jquery.com/jquery-3.4.1.js"
    integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
    crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/2a39a63a0a.js" crossorigin="anonymous"></script>
</head>

<body>


    <header class="header">
        <ul class="menu">
            <li><a href="home"><img src="assets/images/logo.jpg"></a></li>
            <li class="burger"><a onclick="slideMenu()"><i class="fas fa-bars"></i></a></li>
            <li class="submenu"><a href="/"><i class="fas fa-pizza-slice"></i> Menu</a></li>
            <li class="submenu"><a href="order"><i class="fas fa-utensils"></i> Zamów</a></li>
            <li class="submenu"><a href="/"><i class="far fa-address-book"></i> Kontakt</a></li>
        </ul>

        <ul class="menu-contact">
            <li class="submenu"><a href=""><i class="fas fa-phone-square-alt"></i> +48 111-111-111</a></li>
            <li class="submenu"><a href="login"><i class="fas fa-sign-in-alt"></i></a></li>
            <li class="submenu"><a href=""><i class="fab fa-facebook"></i></a></li>
        </ul>
    </header>

    <script>
        function slideMenu() {
            $(".submenu").slideToggle();
        }
    </script>