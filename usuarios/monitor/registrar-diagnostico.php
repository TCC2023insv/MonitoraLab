<?php
    if (!isset($_SESSION)) session_start();

    if (!isset($_SESSION['login']) or $_SESSION['tipoDeUsuario'] != 'Mon')
    {
        session_destroy();
        header("Location: ../login.php");
    }

    require('../../php/conexao/conexaoBD.php');
    $conexao = ConectarBanco();
    $sql_query = $conexao->query("SELECT `Nome` FROM monitor WHERE login = '"  . $_SESSION['login'] . "'");
    while ($monitor = $sql_query->fetch_assoc())
    {
        $nomeMonitor = $monitor['Nome'];
    }

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../css/navbar.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" type="text/css" href="../../css/registrar.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="../../js/sweetalert.js"></script>
    <title>Registrar Diagnóstico</title>
</head>
<body>
    <nav>
    <h1 class="logo">MonitoraLab</h1>
        <img src="../../icons/icone-monitor.png" class="icone-usuario">
        <div class="usuario">Monitor</div>
        <ul>
            <li><a href="inicio.php">Diagnósticos</a></li>
            <li><a class="active" href="registrar-diagnostico.php">Registrar</a></li>
            <li><a class="Btn-Sair" onclick="Sair()" style="cursor: pointer;">Sair</a> </li>
        </ul>
    </nav>

    <div class="voltar">
        <a href="javascript: history.go(-1)" id="voltar-icone" class="ph ph-arrow-left"></a>
        <a href="javascript: history.go(-1)" class="texto-voltar">voltar</a>
    </div>

    <h1 class="titulo">REGISTRAR DIAGNÓSTICO</h1>
   
    <fieldset class="forms">
        <form id="Diagnostico" class=" " action="../../php/classes/usuarios.php" method="post">
            <div class="caixas">
                <div class="caixa-esquerda">
                
                    <div class="Resp">
                        <label class="sub-titulo">Responsável</label>
                        <input class="txt" type="text" name="responsavel" id="Responsavel" value="<?= $nomeMonitor ?>" readonly required>
    
                    </div>
                    
                    <div class="Lab-Data">
                        <div class="Lab">
                            <label class="sub-titulo">Laboratório</label>
                            <select class="sele-lab" name="sele-lab" id="laboratorio" required>
                                <option value="">Selecione</option>
                                <option value="Lab 1">Lab 1</option>
                                <option value="Lab 2">Lab 2</option>
                                <opti/on value="Lab 3">Lab 3</option> 
                                <option value="Lab 4">Lab 4</option>
                            </select>
                        </div>
                        <div class="Data">
                            <label class="sub-titulo">Data</label>
                            <input id="date" type="date" name="data" required>
                        </div>
                    </div>
    
                    <div class="caixa-problemas">
                        <label class="titulo-2">Problemas</label>
    
                        <div class="itens">
                            <label class="txtProb" name="apps">App</label>
                            <input class="txtQuant" id="quantApps" type="number" min="0" max="100" placeholder="00" name="quantApps">
    
                            <select class="select-prob" id="probApps" name="prob-apps">
                                <option value="Sel">Selecionar</option>
                                <option value="Quebrado">Quebrado</option>
                                <option value="Desatualizado">Desatualizado</option>
                                <option value="Em falta">Em falta</option>
                                <option value="Corrompido">Corrompido</option>
                                <option value="Em excesso">Em excesso</option>
                                <option value="Outros">Outros</option>
                            </select>
                        </div>
    
                        <div class="itens">
                            <label class="txtProb" name="fonte">Fonte</label>
                            <input class="txtQuant" id="quantFonte" type="number" min="0" max="100" placeholder="00" name="quantFonte">
    
                            <select class="select-prob" id="probFonte" name="prob-fonte">
                                <option value="Sel">Selecionar</option>
                                <option value="Quebrado">Quebrado</option>
                                <option value="Desatualizado">Desatualizado</option>
                                <option value="Em falta">Em falta</option>
                                <option value="Corrompido">Corrompido</option>
                                <option value="Em excesso">Em excesso</option>
                                <option value="Outros">Outros</option>
                            </select>
                        </div>
    
                        <div class="itens">
                            <label class="txtProb" name="hd">HD</label>
                            <input class="txtQuant" id="quantFonte" type="number" min="0" max="100" placeholder="00" name="quantHD">
    
                            <select class="select-prob" id="probHd" name="prob-hd">
                                <option value="Sel">Selecionar</option>
                                <option value="Quebrado">Quebrado</option>
                                <option value="Desatualizado">Desatualizado</option>
                                <option value="Em falta">Em falta</option>
                                <option value="Corrompido">Corrompido</option>
                                <option value="Em excesso">Em excesso</option>
                                <option value="Outros">Outros</option>
                            </select>
                        </div>
    
                        <div class="itens">
                            <label class="txtProb" name="monitor">Monitor</label>
                            <input class="txtQuant" id="quantMonitor" type="number" min="0" max="100" placeholder="00" name="quantMonitor">
    
                            <select class="select-prob" id="probMonitor" name="prob-monitor">
                                <option value="Sel">Selecionar</option>
                                <option value="Quebrado">Quebrado</option>
                                <option value="Desatualizado">Desatualizado</option>
                                <option value="Em falta">Em falta</option>
                                <option value="Corrompido">Corrompido</option>
                                <option value="Em excesso">Em excesso</option>
                                <option value="Outros">Outros</option>
                            </select>
                        </div>
    
                        <div class="itens">
                            <label class="txtProb" name="mouse">Mouse</label>
                            <input class="txtQuant" id="quantMouse" type="number" min="0" max="100" placeholder="00" name="quantMouse">
    
                            <select class="select-prob" id="probMouse" name="prob-mouse">
                                <option value="Sel">Selecionar</option>
                                <option value="Quebrado">Quebrado</option>
                                <option value="Desatualizado">Desatualizado</option>
                                <option value="Em falta">Em falta</option>
                                <option value="Corrompido">Corrompido</option>
                                <option value="Em excesso">Em excesso</option>
                                <option value="Outros">Outros</option>
                            </select>
                        </div>
    
                        <div class="itens">
                            <label class="txtProb" name="teclado">Teclado</label>
                            <input class="txtQuant" id="quantTeclado" type="number" min="0" max="100" placeholder="00" name="quantTeclado">
    
                            <select class="select-prob" id="probTeclado" name="prob-teclado">
                                <option value="Sel">Selecionar</option>
                                <option value="Quebrado">Quebrado</option>
                                <option value="Desatualizado">Desatualizado</option>
                                <option value="Em falta">Em falta</option>
                                <option value="Corrompido">Corrompido</option>
                                <option value="Em excesso">Em excesso</option>
                                <option value="Outros">Outros</option>
                            </select>
                        </div>
    
                        <div class="itens">
                            <label class="txtProb" name="windows">Fonte</label>
                            <input class="txtQuant" id="quantWindows" type="number" min="0" max="100" placeholder="00" name="quantWindows">
    
                            <select class="select-prob" id="probWindows" name="prob-windows">
                                <option value="Sel">Selecionar</option>
                                <option value="Quebrado">Quebrado</option>
                                <option value="Desatualizado">Desatualizado</option>
                                <option value="Em falta">Em falta</option>
                                <option value="Corrompido">Corrompido</option>
                                <option value="Em excesso">Em excesso</option>
                                <option value="Outros">Outros</option>
                            </select>
                        </div>
                    </div>
    
                </div>
    
                <div class="caixa-direita">
                    <label class="titulo-2">Atividade Exercida</label>
                    <textarea class="caixa-texto" id="atvExercida" name="atvExercida" placeholder="Descreva em detalhes as atividades exercidas" required></textarea>
                    <label class="titulo-2">Problemas não solucionados</label>
                    <textarea class="caixa-texto" id="probSolucionados" name="probSolucionados" placeholder="Descreva em detalhes os problemas não solucionados" required></textarea>
                </div>
    
                
            </div>
            <div class="Fotos">
                <label class="titulo-2">Fotos</label>                
                <div class="input-div">
                    <i id="icon-foto" class="ph-fill ph-cloud-arrow-up"></i>
                    <p class="escolher-foto">Escolher arquivo</p>
                    <input type="file" id="file-input" multiple="multiple" accept="image/png, image/jpeg, image/jpg, image/jfif" onchange="preview()">
                </div>

                <p class="fotos-selecionadas">Fotos selecionadas:</p>

                <div id="miniaturas"></div>
            </div>

            <button type="submit" class="Btn-Registrar" name="BtnRegistrar">REGISTRAR</button>
        </form>
    </fieldset>

    <script src="../../js/miniatura.js"></script>
    <script>
    var formData = new FormData();
         
    document.getElementById("upload").onchange = function(e)
    {
        if (e.target.files != null && e.target.files != 0)
        {
            formData.append("foto[]", e.target.files[0]);
        }
    }
    $(document).ready(function() {
        $("#Diagnostico").submit(function(e) {
            e.preventDefault();

            var Lab = $("#laboratorio").val();
            var data = $("#date").val();
            var responsavel = $("#Responsavel").val();
            var quantApps = $("#quantApps").val();
            var probApps = $("#probApps").val();
            var quantFonte = $("#quantFonte").val();
            var probFonte = $("#probFonte").val();
            var quantHD = $("#quantHD").val();
            var probHD = $("#probHD").val();
            var quantMonitor = $("#quantMonitor").val();
            var probMonitor = $("#probMonitor").val();
            var quantMouse = $("#quantMouse").val();
            var probMouse = $("#probMouse").val();
            var quantTeclado = $("#quantTeclado").val();
            var probTeclado = $("#probTeclado").val();
            var quantWindows = $("#quantWindows").val();
            var probWindows = $("#probWindows").val();
            var atvExercida = $("#atvExercida").val();
            var probSolucionados = $("#probSolucionados").val();
            var RegistrarDiagnostico = "RegistrarDiagnostico";

            formData.append("Lab", Lab);
            formData.append("data", data);
            formData.append("responsavel", responsavel);
            formData.append("quantApps", quantApps);
            formData.append("probApps", probApps);
            formData.append("quantFonte", quantFonte);
            formData.append("probFonte", probFonte);
            formData.append("quantHD", quantHD);
            formData.append("probHD", probHD);
            formData.append("quantMonitor", quantMonitor);
            formData.append("probMonitor", probMonitor);
            formData.append("quantMous", quantMouse);
            formData.append("probMouse", probMouse);
            formData.append("quantTeclado",quantTeclado);
            formData.append("probTeclado", probTeclado);
            formData.append("quantWindows", quantWindows);
            formData.append("probWindows", probWindows);
            formData.append("atvExercida", atvExercida);
            formData.append("probSolucionados", probSolucionados);
            formData.append("RegistrarDiagnostico", RegistrarDiagnostico);

            $.ajax({
                type: "POST",
                url: $(this).attr("action"),
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    swal({
                    title: "Diagnóstico Registrado!",
                    text: "O diagnóstico foi registrado com sucesso. Agradecemos a colaboração!",
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
                    text: "Ocorreu um problema ao registrar o diagnóstico.Tente novamente.",
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
    <?php
        $conexao->close();
    ?>
    </body>
</html>
