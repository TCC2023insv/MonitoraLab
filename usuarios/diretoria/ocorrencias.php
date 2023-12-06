<?php
   require("../../php/conexao/conexaoBD.php");
   
   if (!isset($_SESSION)) session_start();

   if (!isset($_SESSION['login']) or $_SESSION['tipoDeUsuario'] != 'Dir')
   {
       session_destroy();
       header("Location: ../../login.php");
   }

   $conexao = ConectarBanco();

   $sql_query = $conexao->query("SELECT `ID`, `Data`, `Titulo`, `Laboratorio`, `Problema`, `Descricao`, `Responsavel` FROM ocorrencia
   WHERE `arquivado`='não' ORDER BY `Data`DESC") or die ($conexao->error);
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
        <!-- <script type="text/javascript" src="../../js/trocartema.js" defer=""></script> -->
        <link rel="stylesheet" type="text/css" href="../../css/icone-tema.css">
        <title>Ocorrências</title>
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
                <li><a class="nav-li" href="inicio.php">Diagnósticos</a></li>
                <li><a class="active" href="ocorrencias.php">Ocorrências</a></li>
                <li><a class="nav-li" href="professores-cadastrados.php">Cadastros</a></li>
                <li><a class="nav-li" href="ocorrencias-arquivadas.php?problema=&data=&lab=">Arquivados</a></li>
                <li><a class="Btn-Sair" onclick="Sair()" style="cursor: pointer;">Sair</a> </li>
            </ul>
        </nav>
    
        <h2>Ocorrências Registradas</h2>
       
        <?php
            while ($ocorrencia = $sql_query->fetch_assoc())
            {
        ?>
        <div class="flex">
            <div class="container-2">
                <div class="problema-data">
                    <label class="titulo-problema"><?php echo $ocorrencia['Problema']; ?></label>
                    <label class="data-ocorrencia"><?php echo date('d/m/Y', strtotime($ocorrencia['Data'])); ?></label>
                </div>
                <div class="titulo-editar">
                    <div class="titulo-ocorrencia"><?php echo $ocorrencia['Titulo']; ?></div>
                    <!-- <div class="arquivar"> -->
                        <button class="arquivar" name="ArquivarOcorrencia" onclick="Arquivar(this)" var-ocorrencia="<?php echo 
                        $ocorrencia['ID']; ?>"><i class="fa-solid fa-file-import arquivar"></i></button>
                    <!-- </div> -->
                </div>
                <div class="infos-ocorrencia">
                    <label class="responsavel">Registrada por: <?php echo $ocorrencia['Responsavel']; ?></label>
                    <label class="laboratorio"><?php echo $ocorrencia['Laboratorio']; ?></label>
                </div>
                <div class="descricao-ocorrencia">
                <?php echo $ocorrencia['Descricao']; ?>
                </div>
            </div>
        </div>

        <?php
            }
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

        function Arquivar(element)
        {
            var id = element.getAttribute('var-ocorrencia')

            swal({
                title: "Tem certeza?",
                text: "A ação não poderá ser desfeita. Após arquivar a ocorrência, somente você poderá vê-la novamente",
                icon: "warning",
                buttons: ["Cancel", true],
                dangerMode: true,
                })
                .then((value) => {
                if (value) {
                    swal("Ocorrência arquivada com sucesso!", {
                    icon: "success",
                    }).then(()=>{
                    window.location.href = "../../php/classes/usuarios.php?id-arquivar="+id;
                    });
                } else {
                    swal("Não foi possível arquivar a ocorrência.", {
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