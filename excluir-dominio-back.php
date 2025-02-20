<?php
include 'vars.php';
Session_start();

if (isset($_POST['id-dominio']))
{
        $id_dominio = $_POST['id-dominio'];

}
else
        die('Erro na passagem de par&acirc;metros');


mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$bd = new mysqli("192.168.102.100", "CONTAINER024", "1F(999944)", "BD024");

if ($bd->connect_errno)
{
        die("Falha ao conectar ao MySQL: (" . $bd->connect_errno . ") " . $bd->connect_error);
}

// exclui o dominio
$result = $bd->query("DELETE FROM dominios WHERE id='$id_dominio' ");
if ($bd->errno)
{
        die("Erro na execucao do SQL: $sql ($bd->errno) $bd->error");
}


// desativa todos os emails referente ao dominio
$result = $bd->query("UPDATE ftpusers SET ativo='n' WHERE id='$id_dominio' ");
if ($bd->errno)
{
        die("Erro na execucao do SQL: $sql ($bd->errno) $bd->error");
}

header('Location: listar-dominios-front.php?');

?>