<?php
loadModel('Login');
session_start();
error_reporting(E_ERROR);
$exception = null;
if(count($_POST) > 0){
    $login = new Login($_POST);
    var_dump($login);
    try{
        $user = $login->checkLogin();
        $_SESSION['user'] = $user;
        header("Location: day_records.php");
        exit();
    }
    catch(AppException $e){
        $exception = $e;
    }
}
loadView('login', $_POST + ['exception' => $exception]);