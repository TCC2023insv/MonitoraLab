<?php
    if (!isset($_SESSION)) session_start();

    if (!isset($_SESSION['login']) or $_SESSION['tipoDeUsuario'] != 'Prof')
    {
        session_destroy();
        header("Location: ../../login.php");
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../css/navbar.css"><link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" type="text/css" href="../../css/cadastrar.css"><link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="stylesheet" href="../../css/fonte-alert.css">
    <script src="../../js/jquery.js"></script>
    <script src="../../js/sweetalert.js"></script>
    <script type="text/javascript" src="../../js/trocartema.js" defer=""></script>
    <link rel="stylesheet" type="text/css" href="../../css/icone-tema.css">  
    <title>Cadastrar Monitor</title>
    <style>
        body{
            visibility: hidden;
        }
    </style>
</head>
<body id="body">
    <nav>
        <div class="icone-mudar-tema" onclick="trocarTema()">
            <i id="mode-icon" class="ph-fill ph-moon"></i>
        </div>	
        <h1 class="logo">MonitoraLab</h1>
        <img src="../../icons/icone-professor.png" class="icone-usuario">
        <div class="usuario"><?php echo $_SESSION['login'] ;?></div>
        <ul class="nav-professor">
            <li><a class="nav-li" href="inicio.php">Diagnósticos</a></li>
            <li><a class="nav-li" href="ocorrencias.php">Ocorrências</a></li>
            <li><a class="active" href="monitores-cadastrados.php">Cadastros</a></li>
            <li><a class="Btn-Sair" onclick="Sair()" style="cursor: pointer;">Sair</a> </li>
        </ul>
    </nav>

    <div class="voltar">
        <a href="javascript: history.go(-1)" id="voltar-icone" class="ph ph-arrow-left"></a>
        <a href="javascript: history.go(-1)" class="texto-voltar">voltar</a>
    </div>

    <fieldset class="caixa">
        <h1 class="titulo">CADASTRAR MONITOR</h1>
        <form class="cad" id="CadMonitor" method="post" action="../../php/classes/usuarios.php">
            <label class="sub-titulo">Nome</label>
            <input class="txt" type="text" id="nomeMon" name="nome" placeholder="Insira o nome do monitor" required>
            <label class="sub-titulo">Login</label>
            <input class="txt" type="text" id="loginMon" name="login" placeholder="Insira o login" required>
            <label class="sub-titulo">Senha</label>
            <input class="txt" type="password" id="senhaMon" name="senha" placeholder="Insira a senha" required>
            <button type="submit" class="Btn-Cadatrar" name="cadastrarMonitor">Cadastrar Monitor</button>
        </form>
    </fieldset>

    <script>
        const mode = document.getElementById('mode-icon');
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

        $(document).ready(function() {
            $("#CadMonitor").submit(function(e) {
                e.preventDefault();
    
                var nome = $("#nomeMon").val();
                var login = $("#loginMon").val();
                var senha = $("#senhaMon").val();
                var CadastrarMonitor = "CadastrarMonitor";
    
                $.ajax({
                    type: "post",
                    url: $(this).attr("action"),
                    data: {
                        nome: nome,
                        login: login,
                        senha: senha,
                        CadastrarMonitor: CadastrarMonitor
                    },
                    success: function(response) {
                        if (response === "success") {
                        swal({
                        title: "Monitor cadastrado com sucesso!",
                        text: "O novo login já está disponível.",
                        icon: "success",
                        button: {confirm: true},
                        }).then(value =>{
                            if (value)
                            {
                            window.location.href = "javascript: history.go(-1)";
                            }
                        });
                    }
                    else {
                        swal({
                            title: "Falha no Cadastro!",
                            text: "O login já existe.",
                            icon: "error",
                            button: {confirm: true},
                        });
                    }
                },
                    error: function() {
                        swal({
                        title: "Falha no Cadastro!",
                        text: "Ocorreu um problema ao cadastrar o novo monitor.Tente novamente.",
                        icon: "error",
                        button: {confirm: true},
                        });
                    }
                });
            });
        });
    
        function Sair()
        {
            swal({
                title: "Deseja realmente sair?",
                icon: "warning",
                buttons: ["Cancel", true],
            }).then(value =>{
                if (value)
                {
                    window.location.href = "../../php/classes/usuarios.php?resp=true";              
                }
            })
            return false;
        }
        </script>

    </body>
</html>