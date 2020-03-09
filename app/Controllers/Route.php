<?php

namespace app\Controllers;

class Route{
    public static $validRoutes = ['login', 'order', 'home', 'admin'];
    public static $url;

    public static function loadView(){
        if(isset($_GET['url'])){
            $url = self::cleanUrl($_GET['url']);
            self::$url = $url;

            if(in_array($url, self::$validRoutes)){
                include_once "app/Views/$url.php";
            }else{
                // albo 404
                header("Location: ".self::homePage());
                return;
            }
        }else{
            include_once "app/Views/home.php";
        }
    }

    public static function homePage(){
        $url = $_SERVER['PHP_SELF'];
        $url = str_replace("/index.php", "", $url);
        return $url;
    }

    public function cleanUrl($string){
        $string = str_replace(" ", "-", $string);
        return preg_replace('/[^A-Za-z0-9\-]/', '', $string);
    }
}