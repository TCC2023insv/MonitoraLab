<?php
    // if (!isset($_SESSION)) session_start();

    // if (!isset($_SESSION['login']) or $_SESSION['tipoDeUsuario'] != 'Mon')
    // {
    //     session_destroy();
    //     header("Location: ../login.php");
    // }

    // require('../../php/conexao/conexaoBD.php');
    // $conexao = ConectarBanco();
    // $sql_query = $conexao->query("SELECT `Nome` FROM monitor WHERE login = '"  . $_SESSION['login'] . "'");
    // while ($monitor = $sql_query->fetch_assoc())
    // {
    //     $nomeMonitor = $monitor['Nome'];
    // }

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../css/navbar.css"><link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" type="text/css" href="../../css/registrar.css"><link rel="preconnect" href="https://fonts.googleapis.com">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <title>Registrar Diagnóstico</title>
</head>
<body>
    <nav>
        <h1 class="logo">MonitoraLab</h1>
        <img src="../../icons/icone-monitor.png" class="icone-usuario">
        <div class="usuario">Nicoli Kassa</div>
        <ul>
            <li><a class="active" href="">Diagnósticos</a></li>
            <li><a class="nav-li" href="">Ocorrências</a></li>
            <li><a class="nav-li" href="">Cadastros</a></li>
            <li><a class="Btn-Sair" onclick="Sair()" style="cursor: pointer;">Sair</a> </li>
        </ul>
    </nav>

    <div class="voltar">
        <a href="javascript: history.go(-1)" id="voltar-icone" class="ph ph-arrow-left"></a>
        <a href="javascript: history.go(-1)" class="texto-voltar">voltar</a>
    </div>

    <h1 class="titulo">REGISTRAR DIAGNÓSTICO</h1>
   
    <fieldset class="forms">
        <form class=" " action="" method="">
            <div class="caixas">
                <div class="caixa-esquerda">
                
                    <div class="Resp">
                        <label class="sub-titulo">Responsável</label>
                        <input class="txt" type="text" id="" name=" " placeholder="Insira o nome do responsável" required>
    
                    </div>
                    
                    <div class="Lab-Data">
                        <div class="Lab">
                            <label class="sub-titulo">Laboratório</label>
                            <select class="sele-lab" name="sele-lab" id="" required>
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

            <button type="submit" class="Btn-Registrar" name="btnRegistrar">REGISTRAR</button>
        </form>
    </fieldset>
    <script src="../../js/miniatura.js"></script>
    <script>
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
