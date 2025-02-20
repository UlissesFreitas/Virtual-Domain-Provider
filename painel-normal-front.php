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
        <a href="sair.php">Sair</a>
    </div>

    <div class="card">
        <h2>Troca de Senha</h2>
        <form class="formulario" action="trocar-senha-back.php" method="POST">
            <label for="senha">Senha Atual</label>
            <input type="password" id="senha" name="senha" required>

            <label for="senha">Nova Senha</label>
            <input type="password" id="senha" name="senha" required>

            <label for="senha">Confirme a Nova Senha</label>
            <input type="password" id="senha" name="senha" required>

            <button class="button" type="submit">Cadastrar</button>
        </form>
            
    </div>
</body>
</html>
