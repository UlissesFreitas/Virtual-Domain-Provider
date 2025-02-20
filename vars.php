<?php
session_start();

if (!isset($_SESSION["user_name"] )) {
    $_SESSION["user_name"]  = "vazio";
}
if (!isset($_SESSION["dominio_id"] )) {
    $_SESSION["dominio_id"]  = 0;
}
if (!isset($_SESSION["user_email"] )) {
    $_SESSION["user_email"] = "vazio";
}

?>
