<?php

   if (!isset($_SESSION)) session_start();

   if (!isset($_SESSION['login']) or $_SESSION['tipoDeUsuario'] != 'Dir')
   {
       session_destroy();
       header("Location: ../login.php");
   }
    require('../../php/conexao/conexaoBD.php');

   $conexao = ConectarBanco();

   $sql_query = $conexao->query("SELECT * FROM `ocorrencias-arquivadas`
   ORDER BY `Data`DESC") or die ($conexao->error);

   $faltaInternet = $conexao->query("SELECT * FROM `ocorrencias-arquivadas` WHERE `problema`='Falta de internet'");
   $quantidadeFalta = mysqli_num_rows($faltaInternet);

   $pcDesorganizado = $conexao->query("SELECT * FROM `ocorrencias-arquivadas` WHERE `problema`='Computadores desorganizados'");
   $quantidadePC = mysqli_num_rows($pcDesorganizado);

   $sumicoDispositivo = $conexao->query("SELECT * FROM `ocorrencias-arquivadas` WHERE `problema`='Sumiço de dispositivos'");
   $quantidadeSumico = mysqli_num_rows($sumicoDispositivo);
   
   $dispositivoQuebrado = $conexao->query("SELECT * FROM `ocorrencias-arquivadas` WHERE `problema`='Dispositivo quebrado'");
   $quantidadeDispQuebrado = mysqli_num_rows($dispositivoQuebrado);
   
   $CadeirasDesorganizadas = $conexao->query("SELECT * FROM `ocorrencias-arquivadas` WHERE `problema`='Cadeiras desorganizadas'");
   $quantidadeCadeiras = mysqli_num_rows($CadeirasDesorganizadas);
   
   $cabosDesconectados = $conexao->query("SELECT * FROM `ocorrencias-arquivadas` WHERE `problema`='Cabos desconectados'");
   $quantidadeCabos = mysqli_num_rows($cabosDesconectados);
   
   $disjuntorDesligado = $conexao->query("SELECT * FROM `ocorrencias-arquivadas` WHERE `problema`='Disjuntor desligado'");
   $quantidadeDisjuntor = mysqli_num_rows($disjuntorDesligado);
   
   $janelaAberta = $conexao->query("SELECT * FROM `ocorrencias-arquivadas` WHERE `problema`='Janela aberta'");
   $quantidadeJanela = mysqli_num_rows($janelaAberta);
   
   $quedaEnergia = $conexao->query("SELECT * FROM `ocorrencias-arquivadas` WHERE `problema`='Queda de energia'");
   $quantidadeQueda = mysqli_num_rows($quedaEnergia);
   
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../../css/navbar.css">
        <link rel="stylesheet" type="text/css" href="../../css/ocorrencias-arquivadas.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <script src="https://unpkg.com/@phosphor-icons/web"></script>
        <link rel="stylesheet" href="../../css/fonte-alert.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" 
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="../../js/sweetalert.js" type="module"></script>
        <title>Ocorrências arquivadas</title>
    </head>
    <body>
        <nav>
        <h1 class="logo">MonitoraLab</h1>
        <img src="../../icons/icone-direcao.png" class="icone-usuario">
        <div class="usuario">Direção</div>
            <ul>
                <li><a class="nav-li" href="inicio.php">Diagnósticos</a></li>
                <li><a class="nav-li" href="ocorrencias.php">Ocorrências</a></li>
                <li><a class="nav-li" href="professores-cadastrados.php">Cadastros</a></li>
                <li><a class="active" href="">Arquivados</a></li>
                <li><a class="Btn-Sair" onclick="Sair()" style="cursor: pointer;">Sair</a> </li>
            </ul>
        </nav>
        <h2>Ocorrências Arquivadas</h2>
        <button class="botao-extrair" onclick="GerarPDF()">Extrair relatório<i class="fa-solid fa-print"></i></button>

        <div class="container-geral">
            <div class="container-1">
                <label class="problemas"><?php echo $quantidadeFalta ;?>x Falta de internet</label>
                <label class="problemas"><?php echo $quantidadePC ;?>x Computadores desorganizados</label>
                <label class="problemas"><?php echo $quantidadeSumico ;?>x Sumiço de dispositivo</label>
                <label class="problemas"><?php echo $quantidadeDispQuebrado ;?>x Dispositivo quebrado</label>
                <label class="problemas"><?php echo $quantidadeCadeiras ;?>x Cadeiras desorganizadas</label>
                <label class="problemas"><?php echo $quantidadeCabos ;?>x Cabos desconectados</label>
                <label class="problemas"><?php echo $quantidadeDisjuntor ;?>x Disjuntor desligado</label>
                <label class="problemas"><?php echo $quantidadeJanela ;?>x Janela Aberta</label>
                <label class="problemas"><?php echo $quantidadeQueda ;?>x Queda de energia</label>
            </div>

            <div class="container-2">
            <?php
                while ($ocorrencia = $sql_query->fetch_assoc())
                {
            ?>
                <div class="cabecalho-ocorrencia">
                    <div class="problema-data">
                        <label class="titulo-problema"><?php echo $ocorrencia['problema']; ?></label>
                        <label class="data-ocorrencia"><?php echo $ocorrencia['data']; ?></label>
                    </div>
                    <div class="titulo-ocorrencia"><?php echo $ocorrencia['titulo']; ?></div>
                </div>
                <div class="infos-ocorrencia">
                    <label class="responsavel">Registrada por: <?php echo $ocorrencia['responsavel']; ?></label>
                    <label class="laboratorio"><?php echo $ocorrencia['laboratorio']; ?></label>
                </div>
                <div class="descricao-ocorrencia">
                    <?php echo $ocorrencia['descricao']; ?>
                </div>
            <?php 
                }
            ?>
            </div>
        </div>

    <script>
        function GerarPDF()
        {
            window.location.href = '../../pdf/';
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