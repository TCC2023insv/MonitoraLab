<?php
   require("../../php/conexao/conexaoBD.php");
   
   if (!isset($_SESSION)) session_start();

   if (!isset($_SESSION['login']) or $_SESSION['tipoDeUsuario'] != 'Dir')
   {
       session_destroy();
       header("Location: ../login.php");
   }

   $conexao = ConectarBanco();

   $sql_query = $conexao->query("SELECT `Login`, `Nome` FROM `professor`") or die ($conexao->error);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../css/navbar.css"><link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" type="text/css" href="../../css/cadastros.css"><link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="stylesheet" href="../../css/fonte-alert.css">
    <script src="../../js/sweetalert.js" type="module"></script>
    <title>Professores Cadastrados</title>
</head>
<body>
    <nav>
        <h1 class="logo">MonitoraLab</h1>
        <img src="../icons/icone-direcao.png" class="icone-usuario">
        <div class="usuario">Direção</div>
        <ul>
            <li><a class="nav-li" href=" ">Diagnósticos</a></li>
            <li><a class="nav-li" href=" ">Ocorrências</a></li>
            <li><a class="active" href="">Cadastros</a></li>
            <li><a class="Btn-Sair" onclick="Sair()" style="cursor: pointer;">Sair</a> </li>
        </ul>
    </nav>

    <div class="voltar">
        <a href="javascript: history.go(-1)" id="voltar-icone" class="ph ph-arrow-left"></a>
        <a href="javascript: history.go(-1)" class="texto-voltar">voltar</a>
    </div>

    <h1 class="titulo">CADASTROS</h1>
    <a href="cadastrar-professor.php" class="Cadastrar">
        <i id="mais" class="ph ph-plus"></i>
        <div class="Btn-Cadastrar">Cadastrar Professor</div>
    </a>

    <?php
        while ($professor = $sql_query->fetch_assoc())
        {
    ?>
    <div class="cadastrados">
        <div class="caixa-1">
            <div class="dados">
                <div class="nome">
                    <p class="sub-titulos">Nome:</p>
                    <div class="nome-usu"><?php echo $professor['Nome']; ?></div>
                </div>
                <div class="login">
                    <p class="sub-titulos">Login:</p>
                    <div class="login-usu"><?php echo $professor['Login']; ?></div> 
                </div>
            </div>
            <div class="Btn-Excluir">
                <i id="icone-lixo" class="ph-fill ph-trash"></i>
                <a href="#" class="btn-excluir" onclick="ExcluirUsuario(this)" var-login="<?php echo 
                $professor['Login']; ?>" style="cursor: pointer;">Excluir</a>
            </div>
        </div>
        <hr>
    </div>
    
    <?php
        } 
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
                    swal("Não foi possível deletar o professor", {
                    icon: "error",
                    });
                }
                });
        }
    </script>
    </body>
</html>