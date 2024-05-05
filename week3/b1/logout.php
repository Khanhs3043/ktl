<?php
session_start();
if ($_SESSION["isLogin"] == false)
    header("Location: login.html");

if($_SERVER["REQUEST_METHOD"]== "POST"){
    $_SESSION["isLogin"] = false;
    header("Location: login.html");
}
?>