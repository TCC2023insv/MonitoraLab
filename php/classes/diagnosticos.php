<?php
    class Diagnostico
    {
        public $laboratorio;
        public $data;
        public $problemaApps;
        public $quantApps;
        public $problemaFonte;
        public $quantFonte;
        public $problemaHD;
        public $quantHD;
        public $problemaMonitor;
        public $quantMonitor;
        public $problemaMouse;
        public $quantMouse;
        public $problemaTeclado;
        public $quantTeclado;
        public $problemaWindows;
        public $quantWindows;
        public $atividadeExercida;
        public $problemasSolucionados;
        public $responsavel;

        function FazerDiagnostico($laboratorio, $data, $problemaApps, $quantApps, $problemaFonte, $quantFonte, $problemaHD, 
        $quantHD, $problemaMonitor, $quantMonitor, $problemaMouse, $quantMouse, $problemaTeclado, $quantTeclado, 
        $problemaWindows, $quantWindows, $atividadeExercida, $problemasSolucionados, $responsavel)
        {
            $this->laboratorio = $laboratorio;
            $this->data = $data;
            $this->problemaApps = $problemaApps;
            $this->quantApps = $quantApps;
            $this->problemaFonte = $problemaFonte;
            $this->quantFonte = $quantFonte;
            $this->problemaHD = $problemaHD;
            $this->quantHD = $quantHD;
            $this->problemaMonitor = $problemaMonitor;
            $this->quantMonitor = $quantMonitor;
            $this->problemaMouse = $problemaMouse;
            $this->quantMouse = $quantMouse;
            $this->problemaTeclado = $problemaTeclado;
            $this->quantTeclado = $quantTeclado;
            $this->problemaWindows = $problemaWindows;
            $this->quantWindows = $quantWindows;
            $this->atividadeExercida = $atividadeExercida;
            $this->problemasSolucionados = $problemasSolucionados;
            $this->responsavel = $responsavel;
        }

        function PegarData($data)
        {
            switch ($data)
            {
                case '3 meses':
                    return "data BETWEEN CURDATE() - INTERVAL 90 DAY AND CURDATE()";
                
                case '6 meses':
                    return "data BETWEEN CURDATE() - INTERVAL 180 DAY AND CURDATE()";

                case '1 ano':
                    return "data BETWEEN CURDATE() - INTERVAL 365 DAY AND CURDATE()";
            }
            return '';
        }

        // function MostrarOcorrencias($problema, $data, $lab)
        // {
        //     require('../conexao/conexaoBD.php');
        //     $conexao = ConectarBanco();
            
        //     if (isset($problema) && $problema != '' && isset($data) && $data != '' && isset($lab) && $lab != '')
        //     {
        //         return $conexao->query("SELECT * FROM `ocorrencias-arquivadas` WHERE `problema`='" . $_GET['problema'] . "' AND " . $Diagnostico->PegarData($_GET['data']) . " AND `laboratorio`='" . $_GET['lab'] . "' ORDER BY `Data`DESC");
        //     }
        //     else if (isset($problema) && $problema != '' && isset($data) && $data != '')
        //     {
        //         return $conexao->query("SELECT * FROM `ocorrencias-arquivadas` WHERE `problema`='" . $_GET['problema'] . "' AND " . $Diagnostico->PegarData($_GET['data']) . " ORDER BY `Data` DESC");
        //     }
        //     else if (isset($data) && $data != '' && isset($lab) && $lab != '')
        //     {
        //         return $conexao->query("SELECT * FROM `ocorrencias-arquivadas` WHERE " . $Diagnostico->PegarData($_GET['data']) . " AND `laboratorio`='" . $_GET['lab'] . "' ORDER BY `Data` DESC");
        //     }
        //     else if (isset($problema) && $problema != '' && isset($lab) && $lab != '')
        //     {
        //         return $conexao->query("SELECT * FROM `ocorrencias-arquivadas` WHERE `problema`='" . $_GET['problema'] . "' AND `laboratorio`='" . $_GET['lab'] . "' ORDER BY `Data` DESC");
        //     }
        //     else if (isset($problema) && $problema != '')
        //     {
        //         return $conexao->query("SELECT * FROM `ocorrencias-arquivadas` WHERE `problema`='" . $_GET['problema'] . "'  ORDER BY `Data` DESC");
        //     }
        //     else if (isset($data) && $data != '')
        //     {
        //         return $conexao->query("SELECT * FROM `ocorrencias-arquivadas` WHERE " . $Diagnostico->PegarData($_GET['data']) . "  ORDER BY `Data` DESC");
        //     }
        //     else if (isset($lab) && $lab != '')
        //     {
        //         return $conexao->query("SELECT * FROM `ocorrencias-arquivadas` WHERE `laboratorio`='" . $_GET['lab'] . "'  ORDER BY `Data` DESC");
        //     }
        //         return $conexao->query("SELECT * FROM `ocorrencias-arquivadas` ORDER BY `Data` DESC");
            
        // }
    }
?>