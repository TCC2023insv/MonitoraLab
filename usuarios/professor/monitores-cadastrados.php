<?php
   require("../../php/conexao/conexaoBD.php");

   if (!isset($_SESSION)) session_start();
   
   if (!isset($_SESSION['login']) or $_SESSION['tipoDeUsuario'] != 'Prof')
   {
       session_destroy();
       header("Location: ../../login.php");
   }
   
   $conexao = ConectarBanco();

   $sql_query = $conexao->query("SELECT `Login`, `Nome` FROM `monitor`") or die ($conexao->error);
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
    <title>Monitores Cadastrados</title>
</head>
<body>
    <nav>
    <h1 class="logo">MonitoraLab</h1>
        <img src="../../icons/icone-professor.png" class="icone-usuario">
        <div class="usuario"><?php echo $_SESSION['login'] ;?></div>
        <ul class="nav-professor">
            <li><a class="nav-li" href="inicio.php">Diagnósticos</a></li>
            <li><a class="nav-li" href="ocorrencias.php">Ocorrências</a></li>
            <li><a class="active" href="">Cadastros</a></li>
            <li><a class="Btn-Sair" onclick="Sair()" style="cursor: pointer;">Sair</a> </li>
        </ul>
    </nav>

    <h1 class="titulo">CADASTROS</h1>
    <a href="cadastrar-monitor.php" class="Cadastrar" id="Cadastrar">
        <i id="mais" class="ph ph-plus"></i>
        <div class="Btn-Cadastrar">Cadastrar Monitor</div>
    </a>

    <?php
        while ($monitor = $sql_query->fetch_assoc())
        {
    ?>

    <div class="cadastrados">
        <div class="caixa-1">
            <div class="dados">
                <div class="nome">
                    <p class="sub-titulos">Nome:</p>
                    <div class="nome-usu"><?php echo $monitor['Nome']; ?></div>
                </div>
                <div class="login">
                    <p class="sub-titulos">Login:</p>
                    <div class="login-usu" name="var-login"></div><?php echo $monitor['Login']; ?></div>   
                </div>
                <!-- <div class="Btn-Excluir"> -->
                <a class="Btn-Excluir" onclick="ExcluirUsuario(this)" var-login="<?php echo $monitor['Login']; ?>" style="cursor: pointer;">
                    <i id="icone-lixo" class="ph-fill ph-trash"></i>
                    Excluir</a>
                <!-- </div> -->
            </div>
        </div>
        <hr>
    </div>

    <?php
        } 
    ?>

    
<script>
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
                    swal("Monitor excluído com sucesso!", {
                    icon: "success"
                    }).then(()=>{
                        window.location.href = "../../php/classes/usuarios.php?login-mon="+login;
                    });
                } else {
                    swal("Não foi possível deletar o monitor", {
                    icon: "error",
                    });
                }
                });
        }

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