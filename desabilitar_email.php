<?php

Session_start();
if (!($_SESSION["autenticado"]))
        header("Location: index.html");


if (isset($_POST['email']) )
    $email=$_POST['email'];
else
    //die('Erro na passagem de par&acirc;metros');


mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$bd = new mysqli("192.168.102.100", "CONTAINER024", "1F(999944)", "BD024");
if ($bd->connect_errno)
    echo "falhaaaa na conexao";


$result = $bd->query("SELECT ativo FROM ftpusers WHERE email='$email'");  
if ($bd->errno)
    echo 'errrooo na query';


$line = $result->fetch_assoc();

if($line["ativo"] == 's')
    $result = $bd->query("UPDATE ftpusers SET ativo = 'n' WHERE email = '$email'");
else
    $result = $bd->query("UPDATE ftpusers SET ativo = 's' WHERE email = '$email'");



header("Location: listar_emails.php");
?>