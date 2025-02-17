<?php

if (isset($_POST['nome']) and isset($_POST['email']) and isset($_POST['senha']))
{
        $email=$_POST['email'];
        $senha=$_POST['senha'];
}
else
        die('Erro na passagem de par&acirc;metros');

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$bd = new mysqli("192.168.102.100", "CONTAINER024", "1F(999944)", "BD024");

if ($bd->connect_errno)
{
        die("Falha ao conectar ao MySQL: (" . $bd->connect_errno . ") " . $bd->connect_error);
}

?>