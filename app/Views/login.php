<?php
    use app\Controllers\AuthController;

    if(isset($_POST['login_submit'])){
        $auth = new AuthController;
        $error = $auth->tryLogin($_POST['login'], $_POST['password']);
    }

    AuthController::checkLoggedIn();

    include_once('app/Views/header.php');
?>
    <!-- admin admin -->
    <form method='POST' class="loginForm">

        <label for="login">Login:</label>
        <input type="text" name="login">

        <label for="password">Hasło:</label>
        <input type="password" name='password'>

        <input type="submit" name='login_submit' value="Zaloguj">
        <?= isset($error) ? $error : ""; ?>

    </form>

<?php include_once("app/Views/footer.php");