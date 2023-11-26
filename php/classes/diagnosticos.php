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

        function __construct($laboratorio, $data, $problemaApps, $quantApps, $problemaFonte, $quantFonte, $problemaHD, 
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
    }
?>