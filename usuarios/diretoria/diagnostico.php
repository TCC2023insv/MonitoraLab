<?php
   require("../../php/conexao/conexaoBD.php");
   
   if (!isset($_SESSION)) session_start();

   if (!isset($_SESSION['login']) or $_SESSION['tipoDeUsuario'] != 'Dir')
   {
       session_destroy();
       header("Location: ../../login.php");
   }

   $conexao = ConectarBanco();
   $ID_Reparo = $_GET['id'];

   $sql_query = $conexao->query("SELECT `ID`, `Data`, `Acao`, `Problemas_Nao_Solucionados`, `Responsavel`, 
   `Login_Monitor`, `Laboratorio` FROM `reparo` WHERE ID = '$ID_Reparo'") or die ($conexao->error);

    $sql_query_prob = $conexao->query("SELECT dispositivo.Nome, dispositivo.Quantidade, dispositivo.Problema 
    FROM dispositivo JOIN dispositivo_reparo ON dispositivo.ID = dispositivo_reparo.ID_Dispositivo
    WHERE dispositivo_reparo.ID_Reparo = '$ID_Reparo'") or die ($conexao->error);

    if ($sql_query && mysqli_num_rows($sql_query) > 0) {
        $reparo = mysqli_fetch_assoc($sql_query);
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../css/navbar.css">
    <link rel="stylesheet" type="text/css" href="../../css/diagnostico.css">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" 
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../css/fonte-alert.css">
    <script src="../../js/sweetalert.js" type="module"></script>

    <script type="text/javascript" src="../../js/trocartema.js" defer=""></script>
    <link rel="stylesheet" type="text/css" href="../../css/icone-tema.css">
    <title>Diagnóstico</title>
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
        <img src="../../icons/icone-direcao.png" class="icone-usuario">
        <div class="usuario">Direção</div>
        <ul>
            <li><a class="active" href="inicio.php">Diagnósticos</a></li>
            <li><a class="nav-li" href="ocorrencias.php">Ocorrências</a></li>
            <li><a class="nav-li" href="ocorrencias-arquivadas.php?problema=&data=&lab=">Arquivados</a></li>
            <li><a class="nav-li" href="professores-cadastrados.php">Cadastros</a></li>
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
                <p class="nome-resp"><?php echo $reparo['Responsavel']; ?></p>
            </div>
            <div class="laboratorio">
                <p class="titulo">Laboratório:</p>
                <p class="labN"><?php echo $reparo['Laboratorio']; ?></p>
            </div>
        </div>
        <div class="data"><?php echo date('d/m/Y', strtotime($reparo['Data'])); ?></div>
    </div>

    <div class="caixa-2">
        <div class="caixa-problemas">
            <p class="titulo">Problemas</p>
            <?php
                while ($problema = $sql_query_prob->fetch_assoc())
                {
            ?> 
                <div class="itens">
                    <label class="prob"><?php echo $problema['Nome']; ?></label> 
                    <label class="quant"><?php echo $problema['Quantidade']; ?></label>
                    <label class="qual-prob"><?php echo $problema['Problema'];?></label> 
                </div>
            <?php
                }
            ?>
        </div>
    
        <div class="atv-probN">
            <div class="atv-prob">
                <p class="titulo">Atividade exercida</p>
                <p class="texto"><?php echo $reparo['Acao']; ?></p>
            </div>

            <div class="prob-N-solucionado">
                <p class="titulo">Problemas não solucionados</p>
                <p class="texto"><?php echo $reparo['Problemas_Nao_Solucionados']; ?></p>
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
    <?php
        $conexao->close();
    ?>

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
