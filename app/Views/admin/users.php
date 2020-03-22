<table class="menuConf">

    <?php 
    
        use app\Controllers\AuthController;
        $authController = new AuthController;
        $users = $authController->printAllUsers();

        if(isset($_GET['del'])) {
            $id = $_GET['del'];
            $authController->deleteExistUser($id);
        }

    ?>

    <tr><td>Nazwa Użytkownika</td><td>Imię i Nazwisko</td><td>Usuń</tr>
    <?php
        foreach($users as $user) {
            echo "<tr><td> {$user['login']} </td> <td> {$user['name']} </td> <td><a href='?del={$user['id']}'><i class='fas fa-trash-alt'></i></a> </td>  </tr>";
        }
    ?>


</table>

<form class="newMenu" method="POST">
    <input type="submit" name="addUser" value="Dodaj nowego użytkownika">
</form>

<?php
    if(isset($_POST['checkUserData'])) {
        $authController->checkUser($_POST['login'], $_POST['password'], $_POST['name']);
    }

    if(isset($_POST['addUser'])) {
        ?>
            <form method="POST" class="adminForm">
                <input type="text" name="login" placeholder="Login" requred>
                <input type="password" name="password" placeholder="Hasło" required>
                <input type="text" name="name" placeholder="Imię i Nazwisko" required>
                <input type="submit" name="checkUserData" value="Dodaj">
            </form>
        <?php
    }
    else {
        return;
    }
?>