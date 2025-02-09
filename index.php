<?php
Session_start();

if( $_SESSION["autenticado"]=1)
	header("Location: testebd.php");

$_SESSION['autenticado']=0;
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <div class="login-container">
        <form class="login-form" action="login.php" method="POST">
            <label for="email">Email</label>
            <input type="email" id="email" placeholder="Digite seu email">
            
            <label for="password">Senha</label>
            <input type="password" id="password" placeholder="Digite sua senha">
            <a href="#" class="forgot-password">Esqueceu a senha?</a>
            
            <button type="submit" class="login-button">ENTRAR NO PAINEL</button>
        </form>
    </div>

    <footer>
        <p>Desenvolvido por: Ulisses Freitas</p>
    </footer>

</body>
</html>
