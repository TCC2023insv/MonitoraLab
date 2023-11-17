<?php
	session_start(); // Inicie a sessão
	session_destroy();

	if (isset($_SESSION['login_incorreto']) && $_SESSION['login_incorreto'] === true) {
		$_SESSION['login_incorreto'] = false;
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <script src="php/conexao/conexaoBD.php"></script>
	<script src="php/classes/usuarios.php"></script>
	<script src="../js/erro-de-login.js"></script>
    <title>Entrar</title>
</head>
<body>
    <main class="container">
        <div class="caixa-logo">
            <h1>MonitoraLab</h1>
        </div>
        <fieldset class="caixa-forms">
            <h2>Login</h2>
            <form method="post" action="php/classes/usuarios.php" class="forms">  
                <label>Entrar como:</label>		
                <select name="identificacao" class="select" required>
                    <option value=""> Selecione</option>
                    <option value="Dir"> Diretoria</option>
                    <option value="Prof"> Professor</option> 
                    <option value="Mon"> Monitor</option>
                </select>
                <label>Login:</label>
                <input class="txt" type="text" name="login" placeholder="Seu login de usuário" required>
                <label>Senha:</label>
                <input class="txt" type="password" name="senha" placeholder="Senha" required>
                <button type="submit" onclick="Entrar()" id="btn" name="entrar">Entrar</button>
            </form>
        </fieldset>
    </main>
</body>
</html>