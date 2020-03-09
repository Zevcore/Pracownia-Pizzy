<?php include_once('app/Views/header.php'); ?>

    <section class="orderForm">

        <h1 class='title'>Złóż zamówienie <span>online</span></h1>

        <section class="orderField">
            <section class="orderMenu">
                <?php
                    use app\Controllers\MenuController;
                    $menu = new MenuController;
                    $result = $menu->getMenu();

                    foreach($result as $row) {
                        echo "<section class='item'>";
                        echo "<p id='name{$row['id']}'>{$row['name']}</p>";
                        echo "<div id='price{$row['id']}' style='display: none;'>{$row['price']}</div>";
                        echo "<button class='add' name='{$row['id']}'>+</button>";
                        echo "</section>";
                    }
                ?>
            </section>

            <form class="orderCart" method='POST'>
                <div class='elements'>
                </div>

                <div class="sum">
                    <p><span>RAZEM: </span> <b id="full">0</b> PLN</p>
                    <input type='hidden' name='full_price' value='0'>
                </div>
                <input type='submit' name='submit_order' value='Zamów'>
            </form>
            
        </section>
        <?php use app\Controllers\Route; ?>
        <script src='<?= Route::homePage(); ?>/scripts/order.js'></script>
    </section>

<?php include_once("app/Views/footer.php");
