<?php
    if (!isset($_SESSION)) session_start();

    if (!isset($_SESSION['login']) or $_SESSION['tipoDeUsuario'] != 'Prof')
    {
        session_destroy();
        header("Location: ../login.php");
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
        <title>Registrar Ocorrência</title>
    </head>
    <body>
        <nav>
        <h1 class="logo">MonitoraLab</h1>
        <img src="../../icons/icone-professor.png" class="icone-usuario">
        <div class="usuario">Professor</div>
            <ul>
                <li><a class="nav-li" href="inicio.php">Diagnósticos</a></li>
                <li><a class="active" href="">Ocorrências</a></li>
                <li><a class="nav-li" href="monitores-cadastrados.php">Cadastros</a></li>
                <li><a class="Btn-Sair" onclick="Sair()" style="cursor: pointer;">Sair</a> </li>
            </ul>
        </nav>

        <div class="voltar">
            <a href="javascript: history.go(-1)" id="voltar-icone" class="ph ph-arrow-left"></a>
            <a href="javascript: history.go(-1)" class="texto-voltar">voltar</a>
        </div>

        <h2>Registrar Ocorrência</h2>
        <fieldset>
            <form class="formulário" id="Ocorrencia" action="../../php/classes/usuarios.php" method="post"></form>
            <div class="cabecalho-forms">
                <div class="data">
                    <label class="titulo-info">Data</label>
                    <input type="date" id="dataOcorrencia" name="" class="input-data">
                </div>
                <div class="laboratorio">
                    <label class="titulo-info">Laboratório</label>
                    <select name="" id="Sele-lab" class="select-lab">
                        <option>Selecione</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                    </select>
                </div>
                <div class="problema">
                    <label class="titulo-info">Problema encontrado</label>
                    <select id="Sele-problema" class="select-prob">
                        <option>Selecione</option>
                        <option>Falta de internet</option>
                        <option>Computadores desorganizados</option>
                        <option>Sumiço de dispositivo</option>
                        <option>Dispositivo quebrado</option>
                        <option>Cadeiras desorganizadas</option>
                        <option>Cabos desconectados</option>
                        <option>Disjuntor desligado</option>
                        <option>Janela aberta</option>
                        <option>Queda de energia</option>      
                    </select>
                </div>   
            </div>
            <div class="titulo-descricao">
                <input type="text" name="txt-titulo" id="titulo-ocorrencia" placeholder="Escreva um titulo para a ocorrência...">
                <textarea class="txt-descricao" id="descricaoOcorrencia" placeholder="Descreva com detalhes a ocorrência"></textarea>
            </div>
            <button type="submit" name="btnRegistrarOcorrencia" class="botao">Resgistrar</button>
        </fieldset>

        <script>
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