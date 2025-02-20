<?php
include 'vars.php';

if (isset($_POST['email']) and isset($_POST['senha']))
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

Session_start();
// tenho que refazer essa bosta
/*
if( $_SESSION["autenticado"]==1){
        $result = $bd->query("SELECT tipo FROM ftpusers WHERE emal='$email'");
        echo 'ja logado';
        if( $line["tipo"] == 'super-admin')
                header("Location: painel-super-admin.html");
        else if ($line["tipo"] == 'admin')
                header("Location: painel-admin.html");
        else if ( $line["tipo"] == 'normal')
                header("Location: painel-normal.html");
        else
                header("Location: index.html");


}
*/
$result = $bd->query("SELECT * from ftpusers where email='$email' and senha='$senha' and ativo='s'");
if ($bd->errno)
{
        //header("Location: index.php");
        die("Erro na execucao do SQL: $sql ($bd->errno) $bd->error");
}

if ($line =  $result->fetch_assoc())
{


        $_SESSION["autenticado"] = 1;
        $_SESSION["user_name"] = $line["nome"];
        $_SESSION["user_email"] = $line["email"];
        $_SESSION["dominio_id"] = $line["dominio_id"];

        if( $line["tipo"] == 'super-admin')
                header("Location: painel-super-admin-front.php");
        else if ($line["tipo"] == 'admin')
                header("Location: painel-admin-front.php");
        else if ( $line["tipo"] == 'normal')
                header("Location: painel-normal-front.php");

        else
                header("Location: index.php");

}
else {

        $_SESSION["autenticado"]=0;
        header("Location: index.php");
}
?>

