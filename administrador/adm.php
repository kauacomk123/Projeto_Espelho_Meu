<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="administrador.css">
    <title>Espelho Meu</title>
</head>
<body>
    <header class="logo-login">
        <img src="img/logo.png" alt="Logo Espelho Meu" height="100px" height="300px">
    </header>
    <section class="form-login">
        <form action="login_adm.php" method="post">
            <p>Email ou login de administrador:</p>
            <input type="text" name="administrador" required>
            <p>Senha:</p>
            <input type="password" name="senha_adm" required>
            <br><br>
            <button class="button" type="submit" value="Login">Entrar</button>
        </form>
    </section>
</body>
</html>