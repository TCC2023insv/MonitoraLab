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
    <link rel="stylesheet" href="css/icone-tema.css">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="php/conexao/conexaoBD.php"></script>
	<script src="php/classes/usuarios.php"></script>
	<script src="../js/erro-de-login.js"></script>
    <title>Entrar</title>
    <!-- <style>
        body{
            visibility: hidden;
        }
    </style> -->
</head>
<body id="body">
    <main class="container">
        <div class="caixa-logo">
            <h1>MonitoraLab</h1>
        </div>
        <fieldset class="caixa-forms">
            <div class="caixa-1">
                <div class="icone-mudar-tema-login" onclick="trocarTema()">
                    <i id="mode-icon-login" class="ph-fill ph-moon"></i>
                </div>	
                <h2>Login</h2>
            </div>
            
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
                <button type="submit" onclick="Entrar()" id="btn" name="entrar" style="cursor: pointer;">Entrar</button>
            </form>
        </fieldset>
    </main>

    <script>
        const mode = document.getElementById('mode-icon-login');
        function trocarTema(){
            if(body.classList == 'tema-escuro')
            {
                body.classList = 'tema-claro';
                mode.classList.remove('ph-sun');
                mode.classList.add('ph-moon');


                localStorage.setItem('temaSelecionado', 'claro');
            }
            else
            {
                body.classList = 'tema-escuro';
                mode.classList.remove('ph-moon');
                mode.classList.add('ph-sun');

                localStorage.setItem('temaSelecionado', 'escuro');
            }
        }

        window.onload = function () {
            var temaAtual = localStorage.getItem('temaSelecionado');

            if (temaAtual === 'escuro') 
            {
                body.classList.add('tema-escuro');
                mode.classList.remove('ph-moon');
                mode.classList.add('ph-sun');
            } 
            else
            {
                body.classList.add('tema-claro');
                mode.classList.remove('ph-sun');
                mode.classList.add('ph-moon');
            }
            document.body.style.visibility = 'visible';
        };
    </script>
</body>
</html>