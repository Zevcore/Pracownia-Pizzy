<?php
    use app\Controllers\OrderController;
    if(isset($_POST['submit_order'])){
        $order = new OrderController;
        $order->setOrderData($_POST);
    }

    include_once('app/Views/header.php');
?>

    <section class="orderForm">

        <h1 class='title'>Złóż zamówienie <span>online</span></h1>

        <section class='clientData'>
            <label>Adres: </label>
            <input type='text' id='adr1' placeholder='Miasto'>
            <input type='text' id='adr2' placeholder='Ulica'>
            <input type='number' id='adr3' placeholder='Nr Mieszkania'>
            <br>
            <label>Email: </label>
            <input type='text' id='email' placeholder='Email'>
            <br>
            <label>Numer telefonu: </label>
            <input type='number' id='phone' placeholder='Nr. tel.'>
            <br>
            <label>Metoda płatności</label>
            <select id='payment'>
                <option value='Karta'>Karta</option>
                <option value='Gotówka'>Gotówka</option>
            </select>
            <br>
            <span class='continue'>Dalej</span>
            <span class='errorMsg' style='color: red;'></span>
        </section>

        <section class="orderField" style='display: none;'>
            <span class='goBack'>Cofnij</span>
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

                <input type='hidden' name='address'>
                <input type='hidden' name='email'>
                <input type='hidden' name='phone'>
                <input type='hidden' name='payment'>

                <div class="sum">
                    <p><span>RAZEM: </span> <b id="full">0</b> PLN</p>
                    <input type='hidden' name='full_price' value='0'>
                </div>
                <input type='submit' name='submit_order' value='Zamów'>
                <br>
                <span class='errorMsg2' style='color: red;'></span>
            </form>
            
        </section>
        <?php use app\Controllers\Route; ?>
        <script src='<?= Route::homePage(); ?>/scripts/order.js'></script>
    </section>

<?php include_once("app/Views/footer.php");
