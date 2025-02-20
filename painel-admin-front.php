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

    <div class="card">
        <h2>Cadastre um Email</h2>
        <form class="formulario" action="criar-email-back.php" method="POST">
            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>

            <label for="senha">Senha</label>
            <input type="password" id="senha" name="senha" required>
        
            <button class="button" type="submit">Cadastrar</button>

            <?php
                if(isset($_GET['retorno']))
                    echo "<label>" . $_GET['retorno'] . "</label>";
            ?>

        </form>
            
       
    </div>
</body>
</html>
