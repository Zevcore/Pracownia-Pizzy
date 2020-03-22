<?php

namespace app\Controllers;
use app\Models\Auth;

class AuthController extends Auth{
    public function tryLogin($login, $password){
        $user = $this->getUser($login);

        if(!$user || !password_verify($password, $user['password'])){
            return "<p style='color: red; font-weight: bold; font-size: 15px; font-family: 'Open-Sans', sans-serif;'>Błędne dane. Spróbuj ponownie.</p>";
        }

        $_SESSION['logged_in'] = $user['id'];
    }

    public function checkLoggedIn(){
        if(isset($_SESSION['logged_in'])){
            if(Route::$url == "login"){
                header("Location: ".Route::homePage()."/admin");
                die();
            }
        }else{
            if(Route::$url == "admin"){
                header("Location: ".Route::homePage()."/login");
                die();
            }
        }
    }

    public function logout(){
        if(isset($_GET['act']) && $_GET['act'] == "logout" && isset($_SESSION['logged_in'])){
            session_unset();
            session_destroy();
            header("Location: ".Route::homePage());
            die();
        }
    }

    public function printAllUsers() {
        return $this->getAllUsers();
    }

    public function checkUser($login, $password, $name) {

        if(strlen($password) < 8) {
            echo "Twoje hasło musi mieć co najmniej 8 znaków!";
            return;
        }
        if(strlen($login) < 3) {
            echo "Twój login musi składać się co najmniej z 3 znaków!";
            return;
        }

        $hashedPass = password_hash($password, PASSWORD_DEFAULT);

        if($this->addUser($login, $hashedPass, $name)) {
            echo "Użytkownik dodany pomyślnie!";
            return;
        }
        else {
            echo "Coś poszło nie tak!";
            return;
        }

    }

    public function deleteExistUser($id) {
        return $this->deleteUser($id);
    }
}