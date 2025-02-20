<?php
include 'vars.php';
Session_start();

if (isset($_POST['nome_dominio']))
{
        $nome_dominio = $_POST['nome_dominio'];

}
else
        die('Erro na passagem de par&acirc;metros');


mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$bd = new mysqli("192.168.102.100", "CONTAINER024", "1F(999944)", "BD024");

if ($bd->connect_errno)
{
        die("Falha ao conectar ao MySQL: (" . $bd->connect_errno . ") " . $bd->connect_error);
}

$result = $bd->query("SELECT * from dominios where dominio='$nome_dominio' ");
if ($bd->errno)
{
        die("Erro na execucao do SQL: $sql ($bd->errno) $bd->error");
}

if ($line =  $result->fetch_assoc()){
        //echo 'O dominio ja existe';
        header('Location: painel-super-admin-front.php?retorno=' . urlencode('o dominio ja existe'));
        exit;
}
$result = $bd->query("INSERT INTO dominios(dominio) VALUES('$nome_dominio') ");

header('Location: painel-super-admin-front.php?retorno=' . urlencode('dominio criado'));

?>