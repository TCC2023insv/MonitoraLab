<?php
   require("../../php/conexao/conexaoBD.php");
   
   if (!isset($_SESSION)) session_start();

   if (!isset($_SESSION['login']) or $_SESSION['tipoDeUsuario'] != 'Prof')
   {
       session_destroy();
       header("Location: ../../login.php");
   }

   $conexao = ConectarBanco();

   $sql_query = $conexao->query("SELECT `ID`, `Data`, `Titulo`, `Laboratorio`, `Problema`, `Descricao`, `Responsavel` FROM ocorrencia
   ORDER BY `Data`DESC") or die ($conexao->error);
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../../css/navbar.css"><link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="stylesheet" type="text/css" href="../../css/ocorrencias-arquivadas.css"><link rel="preconnect" href="https://fonts.googleapis.com">
        <script src="https://unpkg.com/@phosphor-icons/web"></script>
        <link rel="stylesheet" href="../../css/fonte-alert.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" 
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="../../js/sweetalert.js" type="module"></script>
        <title>Ocorrências</title>
    </head>
    <body>
        <nav>
        <h1 class="logo">MonitoraLab</h1>
        <img src="../../icons/icone-professor.png" class="icone-usuario">
        <div class="usuario"><?php echo $_SESSION['login'] ;?></div>
            <ul class="nav-professor">
                <li><a class="nav-li" href="inicio.php">Diagnósticos</a></li>
                <li><a class="active" href="">Ocorrências</a></li>
                <li><a class="nav-li" href="monitores-cadastrados.php">Cadastros</a></li>
                <li><a class="Btn-Sair" onclick="Sair()" style="cursor: pointer;">Sair</a> </li>
            </ul>
        </nav>

        <h2>Ocorrência registradas</h2>
        <a class="botao-registrar" href="registrar-ocorrencia.php">Registrar Ocorrencia<i class="fa-regular fa-pen-to-square"></i></a>
       
        <?php
            while ($ocorrencia = $sql_query->fetch_assoc())
            {
        ?>
        <div class="container">
            <div class="cabecalho-ocorrencia">
                <div class="problema-data">
                    <label class="titulo-problema"><?php echo $ocorrencia['Problema']; ?></label>
                    <label class="data-ocorrencia"><?php echo date('d/m/Y', strtotime($ocorrencia['Data'])); ?></label>
                </div>
                <div class="titulo-editar">
                <div class="titulo-ocorrencia"><?php echo $ocorrencia['Titulo']; ?></div>
                    <!-- <div class="editar"> -->
                        <a class="editar" href='editar-ocorrencia.php?id=<?php echo $ocorrencia['ID'];?>'>
                            <i class="fa-regular fa-pen-to-square editar"></i>
                        </a>
                    <!-- </div> -->
                </div>
                </div>
            <div class="infos-ocorrencia">
                <label class="responsavel">Registrada por: <?php echo $ocorrencia['Responsavel']; ?></label>
                <label class="laboratorio"><?php echo $ocorrencia['Laboratorio']; ?></label>
            </div>
            <div class="descricao-ocorrencia">
            <?php echo $ocorrencia['Descricao']; ?>
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