<?php
    if (!isset($_SESSION)) session_start();

    if (!isset($_SESSION['login']) or $_SESSION['tipoDeUsuario'] != 'Prof')
    {
        session_destroy();
        header("Location: ../../login.php");
    }

    require("../../php/conexao/conexaoBD.php");
    $conexao = ConectarBanco();

    $id = $_GET["id"];
    $sql_query = $conexao->query("SELECT `ID`, `Data`, `Titulo`, `Laboratorio`, `Problema`, 
    `Descricao`,`Responsavel` FROM ocorrencia WHERE id = '$id'") or die ($conexao->error);

    if ($sql_query && mysqli_num_rows($sql_query) > 0) 
    {
        $ocorrencia = mysqli_fetch_assoc($sql_query);
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
        <title>Editar Ocorrência</title>
    </head>
    <body>
        <nav>
        <h1 class="logo">MonitoraLab</h1>
        <img src="../../icons/icone-professor.png" class="icone-usuario">
        <div class="usuario"><?php echo $_SESSION['login'] ;?></div>
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
            <h2>Editar Ocorrência</h2>
        </div>

        <!-- <h2>Editar Ocorrência</h2> -->
        <fieldset>
            <form class="formulário" id="EditarOcorrencia" action=<?php echo "../../php/classes/usuarios.php?id=" . $ocorrencia['ID']; ?> method="post"></form>
            <div class="cabecalho-forms">
                <div class="data">
                    <label class="titulo-info">Data</label>
                    <input type="date" id="dataOcorrencia" name="" class="input-data" value="<?= $ocorrencia['Data'] ?>">
                </div>
                <div class="laboratorio">
                    <label class="titulo-info">Laboratório</label>
                    <select name="" id="Sele-lab" class="select-lab">
                        <option value="<?= $ocorrencia['Laboratorio'] ?>"><?php echo $ocorrencia['Laboratorio']; ?></option>
                        <option value="Lab 1">1</option>
                        <option value="Lab 2">2</option>
                        <option value="Lab 3">3</option>
                        <option value="Lab 4">4</option>
                    </select>
                </div>
                <div class="problema">
                    <label class="titulo-info">Problema encontrado</label>
                    <select id="Sele-problema" class="select-prob">
                        <option value="<?= $ocorrencia['Problema'] ?>"><?php echo $ocorrencia['Problema']; ?></option>
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
                <input type="text" name="txt-titulo" id="titulo-ocorrencia" value="<?= $ocorrencia['Titulo'] ?>">
                <textarea class="txt-descricao" id="descricaoOcorrencia"><?php echo $ocorrencia['Descricao'] ?></textarea>
            </div>
            <!-- <button type="submit" name="btnEditarOcorrencia" class="botao">Editar</button> -->
            <?php echo '<a class="botao" onclick="Editar(this)" id-ocorrencia="' . $ocorrencia['ID'] . '" >Editar</a>'; ?>
        </fieldset>

        <script>
            function Editar(element)
            {
                var id = element.getAttribute('id-ocorrencia')
                var data = document.getElementById('dataOcorrencia').value
                var titulo = document.getElementById('titulo-ocorrencia').value
                var laboratorio = document.getElementById('Sele-lab').value
                var problema = document.getElementById('Sele-problema').value
                var descricao = document.getElementById('descricaoOcorrencia').value
                var EditarOcorrencia = "EditarOcorrencia";
                console.log(data)


                swal({
                title: "Tem certeza?",
                text: "As informações editadas serão perdidas.",
                icon: "warning",
                buttons: ["Cancel", true],
                dangerMode: true,
                })
                .then((value) => {
                if (value) {
                    swal("Ocorrência atualizada com sucesso!", {
                    icon: "success"
                    }).then(()=>{
                        window.location.href = "../../php/classes/usuarios.php?id="+id+"&data="+data+"&titulo="+titulo+
                    "&laboratorio="+laboratorio+"&problema="+problema+"&descricao="+descricao+"&EditarOcorrencia="+EditarOcorrencia;
                    });
                } else {
                    swal("Não foi possível editar a ocorrência.", {
                    icon: "error",
                    });
                }
                });
            }
    // $(document).ready(function() {
    //     $("#EditarOcorrencia").submit(function(e) {
    //         e.preventDefault();

    //         var data = $("#dataOcorrencia").val();
    //         var titulo = $("#titulo-ocorrencia").val();
    //         var laboratorio = $("#Sele-lab").val();
    //         var problema = $("#Sele-problema").val();
    //         var txtDescricao = $("#descricaoOcorrencia").val();
    //         var EditarOcorrencia = "EditarOcorrencia";

    //         $.ajax({
    //             type: "POST",
    //             url: $(this).attr("action"),
    //             data: {
    //                 data: data,
    //                 titulo: titulo,
    //                 laboratorio: laboratorio,
    //                 problema: problema,
    //                 txtDescricao:txtDescricao,
    //                 EditarOcorrencia:EditarOcorrencia
    //             },
    //             success: function(response) {
    //                 swal({
    //                 title: "Registro Concluído!",
    //                 text: "O ocorrido foi registrado com sucesso. Agradecemos a colaboração!",
    //                 icon: "success",
    //                 button: {confirm: true},
    //                 }).then(value =>{
    //                     if (value)
    //                     {
    //                     window.location.href = "javascript: history.go(-1)";
    //                     }
    //                 });
    //             },
    //             error: function() {
    //                 swal({
    //                 title: "Falha no Registro!",
    //                 text: "Ocorreu um problema ao registrar a ocorrência.Tente novamente.",
    //                 icon: "error",
    //                 button: {confirm: true},
    //                 });
    //             }
    //         });
    //     });
    // });

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