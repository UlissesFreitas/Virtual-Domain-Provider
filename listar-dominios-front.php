<?php
include 'vars.php';
Session_start();
if (!($_SESSION["autenticado"]))
        header("Location: index.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário em Card</title>
    <link rel="stylesheet" href="css/styles.css">

</head>
<body>
    
    <div class="sidebar">
        <div class="nada"></div>
        <a href="painel-super-admin-front.php">Criar Dominio</a>
        <a href="criar-adm-front.php">Criar ADM de Dominio</a>
        <a href="listar-dominios-front.php">Listar Dominio</a>
        <a href="sair.php">Sair</a>
    </div>

    <div>
        <?php
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
            $bd = new mysqli("192.168.102.100", "CONTAINER024", "1F(999944)", "BD024");
            if ($bd->connect_errno)
            {
                die("Falha ao conectar ao MySQL: (" . $bd->connect_errno . ") " . $bd->connect_error);
            }

        
            $result = $bd->query("SELECT * FROM dominios");  

            echo("
            
                <TABLE BORDER=1>
                <TR><TH>Id</TH><TH>Nome</TH><TH>Excluir</TH></TR>
            ");
            
            while($line =  $result->fetch_assoc())
            {
                              
                echo "<FORM ACTION=\"excluir-dominio-back.php\" METHOD=\"POST\">" .
                "<TR><TD>" .
                "<INPUT TYPE=\"TEXT\" VALUE=\"" . $line['id'] . "\" name=\"id-dominio\">" . 
                "</TD><TD>" . 
                "<INPUT TYPE=\"TEXT\" VALUE=\"" . $line['dominio'] . "\" name=\"nome-dominio\">" . 
                "</TD><TD>" .
                "<INPUT TYPE=\"SUBMIT\" VALUE=\"Excluir\">" .
                "</TD></TR>" .
                "</FORM>" ;
                
            }
            
        ?>
    </div>
</body>
</html>
