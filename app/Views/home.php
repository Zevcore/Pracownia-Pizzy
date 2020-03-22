<?php 
    include_once("app/Views/header.php");
    use app\Controllers\MenuController;
?>

<main class="main">
    <h1>PIZZA SOBIEKURSK</h1>
    <h2>TYLKO NA DOWÓZ!</h2>
    <a class="btn" href="order">ZAMÓW TERAZ!</a>
</main>

<section class="fast-menu">

    <a href="">Oferty Specjalne</a>
    <a href="order">Zamów Online</a>
    <a href="contact">Kontakt</a>

</section>

<section class="orders">
    <h1 class="heading">Nasze menu:</h1>
    <?php
        $menu = new MenuController;
        $records = $menu->getMenu();

        foreach($records as $record) {
            ?>
                <article>
                    <img src="<?= $record['image'] ?>">
                    <div class="wrapper">
                        <h1><?= $record['name'] ?></h1>
                        <h2><?= $record['ingredients'] ?></h2>
                        <h3><?= $record['price'] ?> <span>PLN</span></h3>
                    </div>
                </article>
            <?php
        }
    ?>

</section>

<?php include_once("app/Views/footer.php");