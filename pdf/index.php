<?php

    if (!isset($_SESSION)) session_start();

    if (!isset($_SESSION['login']) or $_SESSION['tipoDeUsuario'] != 'Dir')
    {
        session_destroy();
        header("Location: ../../login.php");
    }

    require('../php/conexao/conexaoBD.php');
    $conexao = ConectarBanco();

    require __DIR__.'/vendor/autoload.php';

    use Dompdf\Dompdf;
    $dompdf = new Dompdf(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);

    $html = '<!DOCTYPE html>';
    $html .= '<html lang="pt-br">';
    $html .= '<head>';
    $html .= '<meta charset="UTF-8">';
    $html .= '<style>';

    $html .= '*{';
    $html .= 'margin: 0;';
    $html .= 'padding: 0;';
    $html .= '}';

    $html .= 'body{';
    $html .= 'font-family: "Segoe UI", sans-serif;';
    $html .= 'font-weight: 470;';
    $html .= 'font-size: 14px;';
    // $html .= 'letter-spacing: 5px; ';
    $html .= '}';

    $html .= 'h2{';
    $html .= 'text-transform: uppercase;';
    // $html .= 'text-align: center;';
    $html .= 'letter-spacing: normal;';
    $html .= 'font-size: 20px;';
    $html .= 'margin-left: 8%;';
    $html .= 'margin-right: 8%;';
    $html .= 'font-family: "Segoe UI", sans-serif; ';
    // $html .= 'border-top: 1px solid #7d7d7d;';
    $html .= 'border-bottom: 1px solid #7d7d7d;';

    $html .= '}';

    // geral
    $html .= '.container-geral{';
    $html .= 'clear: both;';
    $html .= 'position: relative;';
    $html .= '}';

    //quantidades
    $html .= '.container-1{';
    $html .= 'position: absolute;';
    $html .= 'left: 300pt;';
    $html .= 'width: 320px;';
    $html .= 'margin: 2.9% 0 0 8%;';
    $html .= 'font-family: "Segoe UI", sans-serif;';
    $html .= 'font-weight: 400;';
    $html .= 'text-align: justify;';
    $html .= 'word-spacing: 3px;';
    $html .= '}';
    
    $html .= '.problemas{';
    $html .= 'display: block;';
    // $html .= 'margin-bottom: 0px;';    
    $html .= '}';

    //problemas
    $html .= '.container-2{';
    $html .= 'text-align: justify;';
    $html .= 'width: 320px;';
    $html .= 'margin-left: 8%;';
    $html .= 'border-bottom: 1px solid #7d7d7d;';
    $html .= '}';

    $html .= '.problema-data{';
    $html .= 'display: flex;';
    $html .= 'justify-content:space-between;';
    $html .= '}';

    $html .= '.titulo-problema{';
    // $html .= 'color: #24416B;';
    $html .= 'letter-spacing: normal;';
    $html .= 'font-size: .9rem;';
    $html .= 'text-transform: uppercase;';  
    // $html .= 'margin-bottom: 10px;';
    $html .= 'font-family: "Segoe UI", sans-serif;';
    $html .= 'font-weight: 700;';
    $html .= '}';

    $html .= '.titulo-ocorrencia{';
    $html .= 'font-size: 110%;';
    $html .= 'margin-bottom: 10px;';
    $html .= '}';

    $html .= '.infos-ocorrencia{';
    $html .= 'display: flex;';
    $html .= 'flex-direction: column;';
    $html .= '}';

    $html .= '.responsavel{';
    // $html .= 'color: #24416B;';
    $html .= 'margin: 0 0 20px 0;';
    $html .= 'font-size: 110%;';
    $html .= 'font-weight: 700;';
    $html .= '}';

    $html .= '.laboratorio{';
    $html .= 'margin-top: 10px';
    $html .= 'font-size: 110%;';
    $html .= 'font-weight: 700;';
    $html .= '}';

    $html .= '.descricao-ocorrencia{';
    $html .= 'margin: 0 0 4% 0;';
    $html .= 'text-align: justify;';
    $html .= '}';

    // $html .= 'hr{';
    // $html .= 'width: 500px;';
    // $html .= 'height: 0.03px;';
    // $html .= '}';

    $html .= '</style>';
    $html .= '</head>';

    $html .= '<body>';
    $html .= '<img src="./img/cabecalho-relatorio.jpg" alt="Minha Imagem">';
    // $html .= '<img src="data:image/jpg;base64,<BASE64_ENCODED_IMAGE>">';
    // $html .= "<img src='/img/cabecalho-relatorio.jpg' style='width: 100%; height: 100px; object-fit: 'contain';'>";
    $html .= '<br><br><br>';
    $html .= '<h2><br>Ocorrências Arquivadas<br></h2><br><br>';
    $html .= '<span style="font-size: .9rem; position: absolute; right: 8%; top: 80px;">Emitido em: ' . date('d/m/Y') . '</span>';
    $html .= '<div class="container-geral">';
    $html .= '<div class="container-1">';

    $faltaInternet = $conexao->query("SELECT * FROM `ocorrencias-arquivadas` WHERE `problema`='Falta de internet'");
    $quantidadeFalta = mysqli_num_rows($faltaInternet);
 
    $pcDesorganizado = $conexao->query("SELECT * FROM `ocorrencias-arquivadas` WHERE `problema`='Computadores desorganizados'");
    $quantidadePC = mysqli_num_rows($pcDesorganizado);
 
    $sumicoDispositivo = $conexao->query("SELECT * FROM `ocorrencias-arquivadas` WHERE `problema`='Sumiço de dispositivos'");
    $quantidadeSumico = mysqli_num_rows($sumicoDispositivo);
    
    $dispositivoQuebrado = $conexao->query("SELECT * FROM `ocorrencias-arquivadas` WHERE `problema`='Dispositivo quebrado'");
    $quantidadeDispQuebrado = mysqli_num_rows($dispositivoQuebrado);
    
    $CadeirasDesorganizadas = $conexao->query("SELECT * FROM `ocorrencias-arquivadas` WHERE `problema`='Cadeiras desorganizadas'");
    $quantidadeCadeiras = mysqli_num_rows($CadeirasDesorganizadas);
    
    $cabosDesconectados = $conexao->query("SELECT * FROM `ocorrencias-arquivadas` WHERE `problema`='Cabos desconectados'");
    $quantidadeCabos = mysqli_num_rows($cabosDesconectados);
    
    $disjuntorDesligado = $conexao->query("SELECT * FROM `ocorrencias-arquivadas` WHERE `problema`='Disjuntor desligado'");
    $quantidadeDisjuntor = mysqli_num_rows($disjuntorDesligado);
    
    $janelaAberta = $conexao->query("SELECT * FROM `ocorrencias-arquivadas` WHERE `problema`='Janela aberta'");
    $quantidadeJanela = mysqli_num_rows($janelaAberta);
    
    $quedaEnergia = $conexao->query("SELECT * FROM `ocorrencias-arquivadas` WHERE `problema`='Queda de energia'");
    $quantidadeQueda = mysqli_num_rows($quedaEnergia);

    $html .= '<label class="problemas">'.$quantidadeFalta.'x Falta de internet</label><br>';
    $html .= '<label class="problemas">'.$quantidadePC.'x Computadores desorganizados</label><br>';
    $html .= '<label class="problemas">'.$quantidadeSumico.'x Sumiço de dispositivo</label><br>';
    $html .= '<label class="problemas">'.$quantidadeDispQuebrado.'x Dispositivo quebrado</label><br>';
    $html .= '<label class="problemas">'.$quantidadeCadeiras.'x Cadeiras desorganizadas</label><br>';
    $html .= '<label class="problemas">'.$quantidadeCabos.'x Cabos desconectados</label><br>';
    $html .= '<label class="problemas">'.$quantidadeDisjuntor.'x Disjuntor desligado</label><br>';
    $html .= '<label class="problemas">'.$quantidadeJanela.'x Janela Aberta</label><br>';
    $html .= '<label class="problemas">'.$quantidadeQueda.'x Queda de energia</label><br>';
    $html .= '</div>';

    require('../php/classes/ocorrencias.php');
    $Ocorrencia = new Ocorrencia();

    if (isset($_GET['problema']) && $_GET['problema'] != '' && isset($_GET['data']) && $_GET['data'] != '' && isset($_GET['lab']) && $_GET['lab'] != '')
    {
        $sql_query = $conexao->query("SELECT * FROM `ocorrencias-arquivadas` WHERE `problema`='" . $_GET['problema'] . "' AND " . $Ocorrencia->PegarData($_GET['data']) . " AND `laboratorio`='" . $_GET['lab'] . "' ORDER BY `Data`DESC");
    }
    else if (isset($_GET['problema']) && $_GET['problema'] != '' && isset($_GET['data']) && $_GET['data'] != '')
    {
        $sql_query = $conexao->query("SELECT * FROM `ocorrencias-arquivadas` WHERE `problema`='" . $_GET['problema'] . "' AND " . $Ocorrencia->PegarData($_GET['data']) . " ORDER BY `Data` DESC");
    }
    else if (isset($_GET['data']) && $_GET['data'] != '' && isset($_GET['lab']) && $_GET['lab'] != '')
    {
        $sql_query = $conexao->query("SELECT * FROM `ocorrencias-arquivadas` WHERE " . $Ocorrencia->PegarData($_GET['data']) . " AND `laboratorio`='" . $_GET['lab'] . "' ORDER BY `Data` DESC");
    }
    else if (isset($_GET['problema']) && $_GET['problema'] != '' && isset($_GET['lab']) && $_GET['lab'] != '')
    {
        $sql_query = $conexao->query("SELECT * FROM `ocorrencias-arquivadas` WHERE `problema`='" . $_GET['problema'] . "' AND `laboratorio`='" . $_GET['lab'] . "' ORDER BY `Data` DESC");
    }
    else if (isset($_GET['problema']) && $_GET['problema'] != '')
    {
        $sql_query = $conexao->query("SELECT * FROM `ocorrencias-arquivadas` WHERE `problema`='" . $_GET['problema'] . "'  ORDER BY `Data` DESC");
    }
    else if (isset($_GET['data']) && $_GET['data'] != '')
    {
        $sql_query = $conexao->query("SELECT * FROM `ocorrencias-arquivadas` WHERE " . $Ocorrencia->PegarData($_GET['data']) . "  ORDER BY `Data` DESC");
    }
    else if (isset($_GET['lab']) && $_GET['lab'] != '')
    {
        $sql_query = $conexao->query("SELECT * FROM `ocorrencias-arquivadas` WHERE `laboratorio`='" . $_GET['lab'] . "'  ORDER BY `Data` DESC");
    }
    else
    {
        $sql_query = $conexao->query("SELECT * FROM `ocorrencias-arquivadas` ORDER BY `Data` DESC");
    }


    if ($sql_query->num_rows > 0)
    {
        while ($row = $sql_query->fetch_object())
        {
            $html .= '<div class="container-2">
                <div class="cabecalho-ocorrencia">
                    <div class="problema-data"><br>
                        <label class="titulo-problema">'. $row->problema .'</label>
                            <div class="titulo-ocorrencia">'. $row->titulo .'</div>
                            <label class="laboratorio">'. $row->laboratorio .': </label>
                            <label class="data-ocorrencia"> '. date('d/m/Y', strtotime($row->data)) .'</label>
                    </div>
                </div>
                <div class="infos-ocorrencia">
                    <label class="responsavel">Registrada por: '. ucwords($row->responsavel) .'</label>
                </div>
                <div class="descricao-ocorrencia">
                   '. $row->descricao .'
                </div>
            </div>';
        }
    }

    $html .= '</body>';
    $html .= '</html>';

    $dompdf = new Dompdf();

    $dompdf->loadHtml($html);

    $dompdf->setPaper('A4','portrait');

    $dompdf->render();
    header('Content-type: application/pdf');

    $nomeArquivo = 'relatorio_monitoralab_'.date('d-m-Y').'.pdf';
    echo $dompdf->stream($nomeArquivo);
    // echo $dompdf->output();
?>
