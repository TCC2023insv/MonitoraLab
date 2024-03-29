<?php
    if (!isset($_SESSION)) session_start();

    if (!isset($_SESSION['login']) or $_SESSION['tipoDeUsuario'] != 'Mon')
    {
        session_destroy();
        header("Location: ../../login.php");
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
    <script src="../../js/jquery.js"></script>
    <script src="../../js/sweetalert.js" type="module"></script>
    <link rel="stylesheet" href="../../css/fonte-alert.css">
    <script type="text/javascript" src="../../js/trocartema.js" defer=""></script>
    <link rel="stylesheet" type="text/css" href="../../css/icone-tema.css">
    <title>Registrar Diagnóstico</title>
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
        <img src="../../icons/icone-monitor.png" class="icone-usuario">
        <div class="usuario"><?php echo $_SESSION['login'] ;?></div>
        <ul class="nav-monitor">
            <li><a class="nav-li" href="inicio.php">Diagnósticos</a></li>
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
        <form id="Diagnostico" enctype="multipart/form-data" action="../../php/classes/usuarios.php" method="post">
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
                                <option value="Lab 3">Lab 3</option> 
                                <option value="Lab 4">Lab 4</option>
                            </select>
                        </div>
                        <div class="Data">
                            <label class="sub-titulo">Data</label>
                            <input id="date" type="date" name="data" value="<?= date('Y-m-d') ?>" required>
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
                            <input class="txtQuant" id="quantHD" type="number" min="0" max="100" placeholder="00" name="quantHD">
    
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
                            <label class="txtProb" name="windows">Windows</label>
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
                    <p class="escolher-foto">Escolher foto</p>
                    <input type="file" id="file-input" name="foto[]" multiple="multiple" accept="image/png, image/jpeg, image/jpg, image/jfif">
                
                </div>

                <p class="fotos-selecionadas">Fotos selecionadas:</p>

                <div id="miniaturas"></div>
            </div>

            <button type="submit" class="Btn-Registrar" name="RegistrarDiagnostico">REGISTRAR</button>
        </form>
    </fieldset>

    <script>
        const escolherFoto = document.querySelector('.escolher-foto')
        // fileSelectorInput
        const fileInput = document.querySelector('#file-input')
        
        const imageContainer = document.getElementById("miniaturas")

        var formData = new FormData()

        // Fazer upload da foto 
        escolherFoto.onclick = () => fileInput.click()
        fileInput.onchange = () =>{
            [...fileInput.files].forEach((file) =>{
                if(typeValidation(file.type)){
                    // console.log(file);
                    uploadFile(file)
                }
            })
        }

        // Quando colocar a imagem na drag area
        fileInput.ondrop = (e) =>{
            e.preventDefault();
            if(e.dataTransfer.items)
            {
                [...e.dataTransfer.items].forEach((item) =>{
                    if(item.kind === 'file'){
                        const file = item.getAsFile();
                        if(typeValidation(file.type)){
                            uploadFile(file)
                        }
                    }
                })
            }
            else{
                [...e.dataTransfer.files].forEach((file) =>{
                    if(typeValidation(file.type)){
                        uploadFile(file)
                    }
                })
            }
        }



        // check o tipo do arquivo
        function typeValidation(type){
            var splitType = type.split('/')[0]
            if(splitType == 'image')
            {
                return true;
            }
        }

        // // Função de upload
        // function uploadFile(file)
        // {
        //     // console.log(file);
        //     formData.append("foto[]", file)
        //     imageContainer.innerHTML = '';

        //     // miniatura
        //     for (i of fileInput.files)
        //     {
        //         let reader = new FileReader();
        //         let figure = document.createElement("figure");
        //         let figCap = document.createElement("figcaption");
        //         figCap.innerText = i.name;
        //         figure.appendChild(figCap);
        //         reader.onload=()=>{
        //             let img = document.createElement("img");
        //             img.setAttribute("src", reader.result);
        //             figure.insertBefore(img,figCap);
        //         }
        //         imageContainer.appendChild(figure);
        //         reader.readAsDataURL(i);
        //     }


        //     var http = new XMLHttpRequest()
        //     // var data = new FormData()
        //     // data.append('file', file)
        //     http.onload = () =>{

        //     }
        //     http.open('POST', 'sender.php', true)
        //     http.send(formData)
    
        // }

        // Função de upload
    function uploadFile(file) {
        formData.append("foto[]", file);

        // Adicionar apenas a última miniatura ao contêiner
        let reader = new FileReader();
        let figure = document.createElement("figure");
        let figCap = document.createElement("figcaption");
        figCap.innerText = file.name;
        figure.appendChild(figCap);

        reader.onload = () => {
            let img = document.createElement("img");
            img.setAttribute("src", reader.result);
            figure.insertBefore(img, figCap);
            imageContainer.appendChild(figure);
        };

        reader.readAsDataURL(file);

        var http = new XMLHttpRequest();
        http.onload = () => {
            // Aqui você pode adicionar lógica para lidar com a resposta do servidor, se necessário
        };
        // http.open('POST', 'sender.php', true);
        // http.send(formData);
    }

    $("button[type='submit']").click(function(){
        if(parseInt($("input[type='file']").get(0).files.length) > 3){
            alert('Não é permitido mais de 3 fotos.')
            $("input[type='file']").val("");
            const div = $("miniatura");
            
        }
    });

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
                var probHD = $("#probHd").val();
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

                formData.append("sele-lab", Lab);
                formData.append("data", data);
                formData.append("responsavel", responsavel);
                formData.append("quantApps", quantApps);
                formData.append("prob-apps", probApps);
                formData.append("quantFonte", quantFonte);
                formData.append("prob-fonte", probFonte);
                formData.append("quantHD", quantHD);
                formData.append("prob-hd", probHD);
                formData.append("quantMonitor", quantMonitor);
                formData.append("prob-monitor", probMonitor);
                formData.append("quantMouse", quantMouse);
                formData.append("prob-mouse", probMouse);
                formData.append("quantTeclado",quantTeclado);
                formData.append("prob-teclado", probTeclado);
                formData.append("quantWindows", quantWindows);
                formData.append("prob-windows", probWindows);
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
                        })
                        .then(value =>{
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