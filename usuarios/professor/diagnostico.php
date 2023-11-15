<?php
//    require("../../php/conexao/conexaoBD.php");
   
//    if (!isset($_SESSION)) session_start();

//    if (!isset($_SESSION['login']) or $_SESSION['tipoDeUsuario'] != 'Prof')
//    {
//        session_destroy();
//        header("Location: ../login.php");
//    }

//    $conexao = ConectarBanco();
//    $ID_Reparo = $_GET['id'];

//    $sql_query = $conexao->query("SELECT `ID`, `Data`, `Acao`, `Problemas_Nao_Solucionados`, `Responsavel`, 
//    `Login_Monitor`, `Laboratorio` FROM `reparo` WHERE ID = '$ID_Reparo'") or die ($conexao->error);

//     $sql_query_prob = $conexao->query("SELECT dispositivo.Nome, dispositivo.Quantidade, dispositivo.Problema 
//     FROM dispositivo JOIN dispositivo_reparo ON dispositivo.ID = dispositivo_reparo.ID_Dispositivo
//     WHERE dispositivo_reparo.ID_Reparo = '$ID_Reparo'") or die ($conexao->error);

//     if ($sql_query && mysqli_num_rows($sql_query) > 0) {
//         $reparo = mysqli_fetch_assoc($sql_query);
//     }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../css/navbar.css">
    <link rel="stylesheet" type="text/css" href="../../css/diagnostico.css">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <title>Diagnóstico</title>
</head>
<body>
    <nav>
        <h1 class="logo">MonitoraLab</h1>
        <img src="../icons/icone-direcao.png" class="icone-usuario">
        <div class="usuario">Direção</div>
        <ul>
            <li><a class="active" href="">Diagnósticos</a></li>
            <li><a class="nav-li" href="">Ocorrências</a></li>
            <li><a class="nav-li" href="../paginas/navbar.html">Cadastros</a></li>
            <li><a class="Btn-Sair" onclick="Sair()" style="cursor: pointer;">Sair</a> </li>
        </ul>
    </nav>
    
    <div class="voltar">
        <a href="javascript: history.go(-1)" id="voltar-icone" class="ph ph-arrow-left"></a>
        <a href="javascript: history.go(-1)" class="texto-voltar">voltar</a>
    </div>

    <div class="caixa-1">
        <div class="resp-lab">
             <div class="responsavel">
                <p class="titulo">Responsável: </p>
                <p class="nome-resp">Nicoli Kassa</p>
            </div>
            <div class="laboratorio">
                <p class="titulo">Laboratório:</p>
                <p class="labN">Lab 1</p>
            </div>
        </div>
        <div class="data">00/00/0000</div>
    </div>

    <div class="caixa-2">
        <div class="caixa-problemas">
            <p class="titulo">Problemas</p>
            <div class="itens">
                <label class="prob">App</label>
                <label class="qual-prob">Desatualizado</label>  
                <label class="quant">1</label>
            </div>
            <div class="itens">
                <label class="prob">Monitor</label>
                <label class="qual-prob">Quebrado</label>  
                <label class="quant">1</label>
            </div>
        </div>


        <div class="atv-probN">
            <div class="atv-prob">
                <p class="titulo">Atividade exercida</p>
                <p class="texto">Durante o período especificado, solucionamos vários problemas na sala de informática, incluindo questões de conexão à internet, lentidão em computadores, problemas com impressoras, software, acesso a redes locais e vírus/malware. Também abordamos problemas de energia elétrica com a instalação de um UPS, resolvemos questões de hardware e substituímos periféricos defeituosos.</p>
            </div>

            <div class="prob-N-solucionado">
                <p class="titulo">Problemas não solucionados</p>
                <p class="texto">Apesar dos esforços da equipe de suporte, alguns problemas na sala de informática permanecem sem solução. Isso inclui desafios relacionados a falhas ocasionais na conexão à internet, que podem ser atribuídas a questões de infraestrutura externa. Além disso, a lentidão de alguns computadores persiste devido a limitações de hardware que não podem ser totalmente resolvidas com as atualizações disponíveis.</p>
            </div>
        </div>
    </div>

    <div class="fotos">
        <p class="titulo">Fotos</p>
        <div class="carrosel-fotos">
            <div class="foto">a</div>
            <div class="foto">a</div>
            <div class="foto">a</div>
        </div>
    </div>
</body>
</html>
