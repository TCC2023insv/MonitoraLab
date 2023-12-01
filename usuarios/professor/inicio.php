<?php
    require("../../php/conexao/conexaoBD.php");

    if (!isset($_SESSION)) session_start();

    if (!isset($_SESSION['login']) or $_SESSION['tipoDeUsuario'] != 'Prof')
    {
        session_destroy();
        header("Location: ../../../login.php");
    }
    $conexao = ConectarBanco();

    $sql_query = $conexao->query("SELECT `ID`, `Data`, `Responsavel`, `Laboratorio` FROM `reparo` 
    ORDER BY `Data` DESC") or die($conexao->error);
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../../css/navbar.css"><link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="stylesheet" type="text/css" href="../../css/inicio.css"><link rel="preconnect" href="https://fonts.googleapis.com">
        <script src="https://unpkg.com/@phosphor-icons/web"></script>
        <link rel="stylesheet" href="../../css/fonte-alert.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" 
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="../../js/sweetalert.js" type="module"></script>
        <script type="text/javascript" src="../../js/trocartema.js" defer=""></script>
        <link rel="stylesheet" type="text/css" href="../../css/icone-tema.css">
        <title>Diagnósticos</title>
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
                <li><a class="active" href="">Diagnósticos</a></li>
                <li><a class="nav-li" href="ocorrencias.php">Ocorrências</a></li>
                <li><a class="nav-li" href="monitores-cadastrados.php">Cadastros</a></li>
                <li><a class="Btn-Sair" onclick="Sair()" style="cursor: pointer;">Sair</a> </li>
            </ul>
        </nav>
            <h2>Diagnósticos</h2>
            <?php
                while ($reparo = $sql_query->fetch_assoc())
                {
            ?>
            <div class="container">
                <div class="info-diagnostico">
                    <label class="titulo-dados"><?php echo date('d/m/Y', strtotime($reparo['Data'])); ?></label>
                    <label class="titulo-dados">Diagnosticado por: <?php echo $reparo['Responsavel'];?></label>
                    <label class="titulo-dados">Laboratório: <?php echo $reparo['Laboratorio']; ?></label>
                </div>
                    <div class="link-diagnostico">
                    <a class="link" href=<?php echo "diagnostico.php?id=" . $reparo['ID'];?>>Ver diagnóstico<i class="fa-solid fa-arrow-right"></i></a>    
                </div>
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
            </script>
        </body>
</html>