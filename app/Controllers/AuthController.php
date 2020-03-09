<?php

namespace app\Controllers;
use app\Models\Auth;

class AuthController extends Auth{
    public function tryLogin($login, $password){
        $user = $this->getUser($login);

        if(!$user || !password_verify($password, $user['password'])){
            echo "Błędne dane. Spróbuj ponownie.";
            return;
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
}