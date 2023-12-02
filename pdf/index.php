<?php
use Dompdf\Css\Style;

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

    $html = '<!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
            <style>
            
            *{
                margin: 0;
                padding: 0;
            }

            h2, span, .problema-data, .titulo-problema, .titulo-ocorrencia, .infos-ocorrencia, 
            .responsavel, .laboratorio, .descricao-ocorrencia{
                font-family: "Arial", sans-serif;
                font-size: 12pt;
            }
            
            html{
                margin: 3cm 2cm 2cm 3cm;
            }

            @font-face{
                font-family: "Arial";
                src: url("arial-cufofonts/arial.ttf");
            }

            body{
                font: normal 15px/20px Arial;
                font-weight: 470;
                font-size: 14px;
            }
            
            h2{
                text-transform: uppercase;
                font-size: 14pt;
                border-bottom: 1px solid #7d7d7d;
            }

            .container-geral{
                clear: both;
                position: relative;
            }
            
            .problemas{
                display: block;
            }

            .container-1{
                text-align: justify;
                border-bottom: 1px solid #7d7d7d;
            }
            
            .problema-data{
                display: flex;
                justify-content:space-between;
            }

            .titulo-problema{
                letter-spacing: normal;
                text-transform: uppercase;
                font-weight: 700;
            }
            
            .titulo-ocorrencia{
                margin-bottom: 10px;
            }
            
            .infos-ocorrencia{
                display: flex;
                flex-direction: column;
            }
            
            .responsavel{
                margin: 0 0 20px 0;
                font-weight: 700;
            }
            
            .laboratorio{
                margin-top: 10px;
                margin-bottom: 3px;
                font-weight: 700;
            }

            .descricao-ocorrencia{
                margin: 0 0 2% 0;
                text-align: justify;
            }

            img{
                width: 800px;
                position: absolute;
                left: -19%;
                top: -8%;
            }

            span{
                font-size: .9rem;
                position: absolute;
                top: 0;
                right: 0;
            }

            .filtros{
                border-top: 1px solid #7d7d7d;
                border-bottom: 1px solid #7d7d7d;
                text-align: center;
                margin-bottom: 10px;
            }

            .filtro-selecionado{
                font-weight: bold;
                font-family: "Arial", sans-serif;
                font-size: 10pt;
            }

            </style>
    </head>
    <body>';

    $imagem = file_get_contents('img/cabecalho-relatorio.jpg');
    $img64 = base64_encode($imagem);

    $html .= '<img src="data:image/jpg;base64,' . $img64 . '>
    <div class="container-geral">
        <h2>Ocorrências Arquivadas<br></h2><br>
        <span>Emitido em: ' . date('d/m/Y') . '</span>
    </div>';

    $filtroProb = "Todos";
    $filtroData = "Todos";
    $filtroLab = "Todos";

    require('../php/classes/ocorrencias.php');
    $Ocorrencia = new Ocorrencia();

    if (isset($_GET['problema']) && $_GET['problema'] != '' && isset($_GET['data']) && $_GET['data'] != '' && isset($_GET['lab']) && $_GET['lab'] != '')
    {
        $filtroProb = $_GET['problema'];
        $filtroData = $_GET['data'];
        $filtroLab = $_GET['lab'];
        $sql_query = $conexao->query("SELECT * FROM `ocorrencias_arquivadas` WHERE `problema`='" . $_GET['problema'] . "' AND " . $Ocorrencia->PegarData($_GET['data']) . " AND `laboratorio`='" . $_GET['lab'] . "' ORDER BY `Data`DESC");
    }
    else if (isset($_GET['problema']) && $_GET['problema'] != '' && isset($_GET['data']) && $_GET['data'] != '')
    {
        $filtroProb = $_GET['problema'];
        $filtroData = $_GET['data'];
        $sql_query = $conexao->query("SELECT * FROM `ocorrencias_arquivadas` WHERE `problema`='" . $_GET['problema'] . "' AND " . $Ocorrencia->PegarData($_GET['data']) . " ORDER BY `Data` DESC");
    }
    else if (isset($_GET['data']) && $_GET['data'] != '' && isset($_GET['lab']) && $_GET['lab'] != '')
    {
        $filtroData = $_GET['data'];
        $filtroLab = $_GET['lab'];
        $sql_query = $conexao->query("SELECT * FROM `ocorrencias_arquivadas` WHERE " . $Ocorrencia->PegarData($_GET['data']) . " AND `laboratorio`='" . $_GET['lab'] . "' ORDER BY `Data` DESC");
    }
    else if (isset($_GET['problema']) && $_GET['problema'] != '' && isset($_GET['lab']) && $_GET['lab'] != '')
    {
        $filtroProb = $_GET['problema'];
        $filtroLab = $_GET['lab'];
        $sql_query = $conexao->query("SELECT * FROM `ocorrencias_arquivadas` WHERE `problema`='" . $_GET['problema'] . "' AND `laboratorio`='" . $_GET['lab'] . "' ORDER BY `Data` DESC");
    }
    else if (isset($_GET['problema']) && $_GET['problema'] != '')
    {
        $filtroProb = $_GET['problema'];
        $sql_query = $conexao->query("SELECT * FROM `ocorrencias_arquivadas` WHERE `problema`='" . $_GET['problema'] . "'  ORDER BY `Data` DESC");
    }
    else if (isset($_GET['data']) && $_GET['data'] != '')
    {
        $filtroData = $_GET['data'];
        $sql_query = $conexao->query("SELECT * FROM `ocorrencias_arquivadas` WHERE " . $Ocorrencia->PegarData($_GET['data']) . "  ORDER BY `Data` DESC");
    }
    else if (isset($_GET['lab']) && $_GET['lab'] != '')
    {
        $filtroLab = $_GET['lab'];
        $sql_query = $conexao->query("SELECT * FROM `ocorrencias_arquivadas` WHERE `laboratorio`='" . $_GET['lab'] . "'  ORDER BY `Data` DESC");
    }
    else
    {
        $sql_query = $conexao->query("SELECT * FROM `ocorrencias_arquivadas` ORDER BY `Data` DESC");
    }

    $html .= '<div class="filtros">
                <label class="filtro-selecionado">FILTRO(S):</label>
                <label class="filtro-selecionado">Problema: ' . $filtroProb . ' | </label>
                <label class="filtro-selecionado">Laboratório: ' . $filtroLab . ' | </label>
                <label class="filtro-selecionado">Período: ' . $filtroData . '</label>
              </div>';


    if ($sql_query->num_rows > 0)
    {
        while ($row = $sql_query->fetch_object())
        {
            $html .= '<div class="container-1">
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
    $conexao->close();
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
