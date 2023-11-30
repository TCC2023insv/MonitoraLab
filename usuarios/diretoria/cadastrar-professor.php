<?php
   require("../../php/conexao/conexaoBD.php");
   
   if (!isset($_SESSION)) session_start();

   if (!isset($_SESSION['login']) or $_SESSION['tipoDeUsuario'] != 'Dir')
   {
       session_destroy();
       header("Location: ../../login.php");
   }

   $conexao = ConectarBanco();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../css/navbar.css"><link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" type="text/css" href="../../css/cadastrar.css"><link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="../../css/fonte-alert.css">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="../../js/jquery.js"></script>
    <script src="../../js/sweetalert.js"></script>
    <!-- <script type="text/javascript" src="../js/mudar-tema.js" defer=""></script> -->
    <title>Cadastrar Professor</title>
</head>
<body>
    <nav>
    <h1 class="logo">MonitoraLab</h1>
        <img src="../../icons/icone-direcao.png" class="icone-usuario">
        <div class="usuario">Direção</div>
        <ul>
            <li><a class="nav-li" href="inicio.php">Diagnósticos</a></li>
            <li><a class="nav-li" href="ocorrencias.php">Ocorrências</a></li>
            <li><a class="active" href="professores-cadastrados.php">Cadastros</a></li>
            <li><a class="nav-li" href="ocorrencias-arquivadas.php?problema=&data=&lab=">Arquivados</a></li>
            <li><a class="Btn-Sair" onclick="Sair()" style="cursor: pointer;">Sair</a> </li>
        </ul>
    </nav>

    <div class="voltar">
        <a href="javascript: history.go(-1)" id="voltar-icone" class="ph ph-arrow-left"></a>
        <a href="javascript: history.go(-1)" class="texto-voltar">voltar</a>
    </div>

    <fieldset class="caixa">
        <h1 class="titulo">CADASTRAR PROFESSOR</h1>
        <form class="cad" id="CadProfessor" action="../../php/classes/usuarios.php" method="post">
            <label class="sub-titulo">Nome</label>
            <input class="txt" type="text" id="nomeProf" name="nome" placeholder="Insira o nome do professor" required>
            <label class="sub-titulo">Login</label>
            <input class="txt" type="text" id="loginProf" name="login" placeholder="Insira o login" required>
            <label class="sub-titulo">Senha</label>
            <input class="txt" type="password" id="senhaProf" name="senha" placeholder="Insira a senha" required>
            <button type="submit" class="Btn-Cadatrar" id="Btn" name="cadastrarProfessor">Cadastrar Professor</button>
        </form>
    </fieldset>
    <script>
        $(document).ready(function() {
            $("#CadProfessor").submit(function(e) {
                e.preventDefault();
    
                var nome = $("#nomeProf").val();
                var login = $("#loginProf").val();
                var senha = $("#senhaProf").val();
                var CadastrarProfessor = "CadastrarProfessor";
    
                $.ajax({
                    type: "post",
                    url: $(this).attr("action"),
                    data: {
                        nome: nome,
                        login: login,
                        senha: senha,
                        CadastrarProfessor: CadastrarProfessor
                    },
                    success: function(response) {
                        swal({
                        title: "Professor cadastrado com sucesso!",
                        text: "O novo login já está disponível.",
                        icon: "success",
                        button: {confirm: true},
                        }).then(value =>{
                            if (value)
                            {
                            window.location.href = "javascript: history.go(-1)";
                            }
                        });
                    },
                    error: function() {
                        swal({
                        title: "Falha no Cadastro!",
                        text: "Ocorreu um problema ao cadastrar o novo professor.Tente novamente.",
                        icon: "error",
                        button: {confirm: true},
                        });
                    }
                });
            });
        });
    
            function ExcluirUsuario(element)
            {
                var login = element.getAttribute('var-login')
                swal({
                    title: "Tem certeza?",
                    text: "Uma vez deletado, o usuário perderá o login.",
                    icon: "warning",
                    buttons: ["Cancel", true],
                    dangerMode: true,
                    })
                    .then((value) => {
                    if (value) {
                        swal("Professor excluído com sucesso!", {
                        icon: "success",
                        });
                        window.location.href = "../../php/classes/usuarios.php?login-prof="+login;
                    } else {
                        swal("Não foi possível deletar o professor.", {
                        icon: "error",
                        });
                    }
                    });
            }
        </script>

        <?php 
            $conexao->close();
        ?>

    <script>
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