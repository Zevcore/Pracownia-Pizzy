<?php  use app\Controllers\MenuController; ?>

<table class="menuConf">


    <tr><td>Nazwa Pizzy</td><td>Składniki</td><td>Cena</td><td>Edytuj</td><td>Usuń</tr>
    <?php
        $menu = new MenuController;
        $records = $menu->getMenu();

        if(isset($_GET['del']))
        {
            $id = $_GET['del'];
            $menu->deleteExistPizza($id);
        }

        foreach($records as $record) 
        {
            echo "<tr><td>{$record['name']}</td> <td>{$record['ingredients']}</td> <td>{$record['price']}</td><td><a href='?edit={$record['id']}'><i class='fas fa-pencil-alt'></i></a></td><td><a href='?del={$record['id']}'><i class='fas fa-trash-alt'></i></a></td></tr>";
        }
    ?>


</table>

<form class="newMenu" method="POST">
    <input type="submit" name="addPizza" value="Dodaj nową pozycję">
</form>

<?php

    if(isset($_POST['checkPizza'])) {
        $menuController->checkPizza(
            $_POST['name'],
            $_POST['ingridients'],
            $_POST['price'],
            $_FILES['image']
        );
    }

    if(isset($_POST['addPizza'])) {
        ?>
            <form class="adminForm" method="POST" enctype="multipart/form-data">
                <input type="text" name="name" placeholder="Nazwa">
                <input type="text" name="ingridients" placeholder="Składniki">
                <input type="number" step="0.01" name="price" placeholder="Cena">
                <input type="file" name="image" id="image">
                <input type="submit" value="Dodaj" name="checkPizza">
            </form>
        <?php
    }

    if(isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $records = $menu->getSingleRecord($id);
        foreach ($records as $record) {
            ?>
                <form class="adminForm" method="POST">
                    <input type="text" value="<?= $record['name'] ?>" name="name" placeholder="Nazwa">
                    <input type="text" value="<?= $record['ingredients'] ?>" name="ingridients" placeholder="Składniki">
                    <input type="number" value="<?= $record['price'] ?>" step="0.01" name="price" placeholder="Cena">
                    <input type="hidden" value="<?= $id ?>" name="id">
                    <input type="submit" value="Edytuj" name="editPizza">
                </form>
            <?php
        }
    }

    if(isset($_POST['editPizza'])) {
        $menu->editPizza(
            $_POST['name'],
            $_POST['ingridients'],
            $_POST['price'],
            $_POST['id']
        );
    }
?>