<?php
    if (!isset($_SESSION)) session_start();

    if (!isset($_SESSION['login']) or $_SESSION['tipoDeUsuario'] != 'Prof')
    {
        session_destroy();
        header("Location: ../../login.php");
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../../css/navbar.css"><link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="stylesheet" type="text/css" href="../../css/registrar-ocorrencia.css"><link rel="preconnect" href="https://fonts.googleapis.com">
        <script src="https://unpkg.com/@phosphor-icons/web"></script>
        <link rel="stylesheet" href="../../css/fonte-alert.css">
        <script src="../../js/sweetalert.js" type="module"></script>
        <script src="../../js/jquery.js"></script>
        <!-- <script type="text/javascript" src="../../js/trocartema.js" defer=""></script> -->
        <link rel="stylesheet" type="text/css" href="../../css/icone-tema.css">
        <title>Registrar Ocorrência</title>
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
            <img src="../../icons/icone-professor.png" class="icone-usuario">
            <div class="usuario"><?php echo $_SESSION['login'] ;?></div>
            <ul class="nav-professor">
                <li><a class="nav-li" href="inicio.php">Diagnósticos</a></li>
                <li><a class="active" href="">Ocorrências</a></li>
                <li><a class="nav-li" href="monitores-cadastrados.php">Cadastros</a></li>
                <li><a class="Btn-Sair" onclick="Sair()" style="cursor: pointer;">Sair</a> </li>
            </ul>
        </nav>

        <div class="voltar">
            <a href="javascript: history.go(-1)" id="voltar-icone" class="ph ph-arrow-left"></a>
            <a href="javascript: history.go(-1)" class="texto-voltar">voltar</a>
            <h2>Registrar Ocorrência</h2>
        </div>


        <fieldset>
            <form class="formulário" id="Ocorrencia" action="../../php/classes/usuarios.php" method="post">
            <div class="cabecalho-forms">
                <div class="data">
                    <label class="titulo-info">Data</label>
                    <input type="date" id="dataOcorrencia" name="data" class="input-data" value="<?= date('Y-m-d') ?>" required>
                </div>
                <div class="laboratorio">
                    <label class="titulo-info">Laboratório</label>
                    <select name="laboratorio" id="Sele-lab" class="select-lab" required>
                        <option value="">Selecione</option>
                        <option value="Lab 1">1</option>
                        <option value="Lab 2">2</option>
                        <option value="Lab 3">3</option>
                        <option value="Lab 4">4</option>
                    </select>
                </div>
                <div class="problema">
                    <label class="titulo-info">Problema encontrado</label>
                    <select id="Sele-problema" name="problema" class="select-prob" required>
                        <option value="">Selecione</option>
                        <option value="Falta de internet">Falta de internet</option>
                        <option value="Computadores desorganizados">Computadores desorganizados</option>
                        <option value="Sumiço de dispositivos">Sumiço de dispositivo</option>
                        <option value="Dispositivo quebrado">Dispositivo quebrado</option>
                        <option value="Cadeiras desorganizadas">Cadeiras desorganizadas</option>
                        <option value="Cabos desconectados">Cabos desconectados</option>
                        <option value="Disjuntor desligado">Disjuntor desligado</option>
                        <option value="Janela aberta">Janela aberta</option>
                        <option value="Queda de energia">Queda de energia</option>      
                    </select>
                </div>   
            </div>
            <div class="titulo-descricao">
                <input type="text" name="titulo" id="titulo-ocorrencia" placeholder="Escreva um titulo para a ocorrência..." required>
                <textarea class="txt-descricao" name="txtDescricao" id="descricaoOcorrencia" placeholder="Descreva com detalhes a ocorrência" required></textarea>
            </div>
            <button type="submit" name="btnRegistrarOcorrencia" class="botao">Registrar</button>
            
        </form>
        </fieldset>

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

        $(document).ready(function() {
        $("#Ocorrencia").submit(function(e) {
            e.preventDefault();

            var data = $("#dataOcorrencia").val();
            var titulo = $("#titulo-ocorrencia").val();
            var laboratorio = $("#Sele-lab").val();
            var problema = $("#Sele-problema").val();
            var txtDescricao = $("#descricaoOcorrencia").val();
            var RegistrarOcorrencia = "RegistrarOcorrencia";

            $.ajax({
                type: "POST",
                url: $(this).attr("action"),
                data: {
                    data: data,
                    titulo: titulo,
                    laboratorio: laboratorio,
                    problema: problema,
                    txtDescricao:txtDescricao,
                    RegistrarOcorrencia:RegistrarOcorrencia
                },
                success: function(response) {
                    swal({
                    title: "Registro Concluído!",
                    text: "O ocorrido foi registrado com sucesso. Agradecemos a colaboração!",
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
                    title: "Falha no Registro!",
                    text: "Ocorreu um problema ao registrar a ocorrência.Tente novamente.",
                    icon: "error",
                    button: {confirm: true},
                    });
                }
            });
        });
    });

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