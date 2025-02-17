<?php
session_start();

if (!isset($_SESSION["user_name"] )) {
    $_SESSION["user_name"]  = "vazio";
}
if (!isset($_SESSION["dominio_id"] )) {
    $_SESSION["dominio_id"]  = "vazio";
}
if (!isset($_SESSION["nome_dominio"] )) {
    $_SESSION["nome_dominio"] = "vazio";
}

?>