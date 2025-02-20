<?php
include 'vars.php';
Session_start();

if (isset($_POST['nome']) and isset($_POST['email']) and isset($_POST['senha']))
{
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
}
else
        die('Erro na passagem de par&acirc;metros');

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$bd = new mysqli("192.168.102.100", "CONTAINER024", "1F(999944)", "BD024");

if ($bd->connect_errno)
{
        die("Falha ao conectar ao MySQL: (" . $bd->connect_errno . ") " . $bd->connect_error);
}

// CHECAR SE O EMAIL JA EXISTE

$result = $bd->query("SELECT * from ftpusers where email='$email' ");
if ($bd->errno)
{
        die("Erro na execucao do SQL: $sql ($bd->errno) $bd->error");
}

if ($line =  $result->fetch_assoc()){
        echo 'O email ja existe';
        header('Location: painel-admin-front.php?retorno=' . urlencode('o mail ja existe'));
        exit;
}

// CHECAR SE O DOMINIO ESTA CORRETO

$partes = explode("@", $email);
$username = $partes[0];
$dominio = $partes[1];
$dominio_id = $_SESSION['dominio_id'];

$result = $bd->query("SELECT * FROM dominios WHERE id = '$dominio_id'");

$line = $result->fetch_assoc();

if ($dominio != $line['dominio']){
        header('Location: painel-admin-front.php?retorno=' . urlencode('Dominio Invalido'));
        exit;
}

// Criar EMAIL

$sql = "INSERT INTO ftpusers(nome, login, senha, gid, ativo, dir, shell, email, dominio_id) 
        VALUES ('$nome', '$username', '$senha', 15000, 's', '/home/$dominio/$username', '/bin/bash', '$email', '$dominio_id')";
    

$result = $bd->query($sql);
if ($bd->errno)
{
        die("Erro na execucao do SQL: $sql ($bd->errno) $bd->error");
        exit;
}

header('Location: painel-admin-front.php?retorno=' . urlencode('Email criado.'));
exit;

?>