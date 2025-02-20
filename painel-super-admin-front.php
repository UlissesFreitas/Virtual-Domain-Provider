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

    <div class="card">
        <h2>Cadastre um Novo Dominio</h2>
        <form class="formulario" action="criar-dominio-back.php" method="POST">
            <label for="nome">Nome do Dominio</label>
            <input type="text" id="nome" name="nome_dominio" required>

            <button class="button" type="submit">Cadastrar</button>
            
            <?php
                if(isset($_GET['retorno']))
                    echo "<label>" . $_GET['retorno'] . "</label>";
            ?>
        </form>
            
    </div>
</body>
</html>
