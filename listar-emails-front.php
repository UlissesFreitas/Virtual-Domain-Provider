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

        <a href="painel-admin-front.php">Cadastrar Email</a>
        <a href="listar-emails-front.php">Listar Emails</a>
        <a href="trocar-senha-front.php">Trocar Senha</a>
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

        
            $result = $bd->query("SELECT * FROM ftpusers");  

            echo("
            
                <TABLE BORDER=1>
                <TR><TH>Nome</TH><TH>Email</TH><TH>Desabilitar</TH></TR>
            ");
            
            while($line =  $result->fetch_assoc())
            {
                              
                if($line["dominio_id"] == $_SESSION["dominio_id"]){
                    echo "<FORM ACTION=\"desabilitar-email-back.php\" METHOD=\"POST\">" .
                    "<TR><TD>" . 
                    "<INPUT TYPE=\"TEXT\" VALUE=\"" . $line['nome'] . "\" name=\"nome\">" .
                    "</TD><TD>" . 
                    "<INPUT TYPE=\"TEXT\" VALUE=\"" . $line['email'] . "\" name=\"email\">" . 
                    "</TD><TD>" ;
                    echo $line['ativo'] == 's' ?  "<INPUT TYPE=\"SUBMIT\" VALUE=\"Desabilitar\">" : "<INPUT TYPE=\"SUBMIT\" VALUE=\"Habilitar\">";

                    echo    "</TD></TR>" .
                    "</FORM>" ;
                }
            }
            
        ?>
    </div>
</body>
</html>
