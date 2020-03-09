<?php
    require 'vendor/autoload.php';
    session_start();

    use app\Controllers\Route;
    Route::loadView();