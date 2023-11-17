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
        <title>Ocorrências arquivadas</title>
    </head>
    <body>
        <nav>
            <h1 class="logo">MonitoraLab</h1>
            <img src="../icons/icone-direcao.png" class="icone-usuario">
            <div class="usuario">Direção</div>
            <ul>
                <li><a class="active" href="inicio.php">Diagnósticos</a></li>
                <li><a class="nav-li" href="ocorrencias.php">Ocorrências</a></li>
                <li><a class="nav-li" href="professores-cadastrados.php">Cadastros</a></li>
                <li><a class="Btn-Sair" onclick="Sair()" style="cursor: pointer;">Sair</a> </li>
            </ul>
        </nav>
        
        <div class="voltar">
            <a href="javascript: history.go(-1)" id="voltar-icone" class="ph ph-arrow-left"></a>
            <a href="javascript: history.go(-1)" class="texto-voltar">voltar</a>
        </div>

        <h2>Ocorrências Arquivadas</h2>
        <button class="botao-extrair">Extrair relatório<i class="fa-solid fa-print"></i></button>

        <div class="container-geral">
            <div class="container-1">
                <label class="problemas">3x Falta de internet</label>
                <label class="problemas">3x Computadores desorganizados</label>
                <label class="problemas">3x Sumiço de dispositivo</label>
                <label class="problemas">10x Dispositivo quebrado</label>
                <label class="problemas">3x Cadeiras desorganizadas</label>
                <label class="problemas">5x Cabos desconectados</label>
                <label class="problemas">7x Disjuntor desligado</label>
                <label class="problemas">15x Janela Aberta</label>
                <label class="problemas">50x Queda de energia</label>
            </div>
            <div class="container-2">
                <div class="cabecalho-ocorrencia">
                    <div class="problema-data">
                        <label class="titulo-problema">Disjuntor desligado</label>
                        <label class="data-ocorrencia">27/10/2323</label>
                    </div>
                    <div class="titulo-ocorrencia">Computadores abertos em período de aula</div>
                </div>
                <div class="infos-ocorrencia">
                    <label class="responsavel">Registrada por:</label>
                    <label class="laboratorio">Laboratório 4</label>
                </div>
                <div class="descricao-ocorrencia">
                    Hoje, na sala de informática, enfrentamos um problema inesperado. Os computadores apresentaram um erro de conexão de rede, impedindo o acesso à internet. Investiguei o problema e descobri que um cabo de rede estava desconectado. Após reconectar o cabo, os computadores voltaram a funcionar normalmente. É fundamental lembrar a importância de verificar as conexões antes de relatar problemas técnicos, pois soluções simples podem evitar interrupções nas atividades dos alunos.
                </div>
            </div>
        </div>
    </body>
</html>