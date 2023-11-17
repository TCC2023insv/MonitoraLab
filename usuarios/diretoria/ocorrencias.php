<?php
   require("../../php/conexao/conexaoBD.php");
   
   if (!isset($_SESSION)) session_start();

   if (!isset($_SESSION['login']) or $_SESSION['tipoDeUsuario'] != 'Dir')
   {
       session_destroy();
       header("Location: ../login.php");
   }

   $conexao = ConectarBanco();

   $sql_query = $conexao->query("SELECT `Data`, `Titulo`, `Laboratorio`, `Problema`, `Descricao`, `Responsavel` FROM ocorrencia
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
        <img src="../../icons/icone-direcao.png" class="icone-usuario">
        <div class="usuario">Direção</div>
            <ul>
                <li><a class="nav-li" href="inicio.php">Diagnósticos</a></li>
                <li><a class="active" href="ocorrencias.php">Ocorrências</a></li>
                <li><a class="nav-li" href="professores-cadastrados.php">Cadastros</a></li>
                <li><a class="nav-li" href="ocorrencias-arquivadas.php">Arquivados</a></li>
                <li><a class="Btn-Sair" onclick="Sair()" style="cursor: pointer;">Sair</a> </li>
            </ul>
        </nav>
        
        <div class="voltar">
            <a href="javascript: history.go(-1)" id="voltar-icone" class="ph ph-arrow-left"></a>
            <a href="javascript: history.go(-1)" class="texto-voltar">voltar</a>
        </div>

        <h2>Ocorrência registradas</h2>
       
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
                    <div class="arquivar">
                        <button class="arquivar" name="ArquivarOcorrencia"><i class="fa-solid fa-file-import arquivar"></i></button>
                    </div>
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
    </body>
</html>