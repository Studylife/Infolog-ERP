<?php
class Servico {
    private $idServico;
    public $nomeServico;
    public $precoServico;
    public $tempoReparo;
    public $descrServico;
    
    function getIdServico() {
        return $this->idServico;
    }

    function getNomeServico() {
        return $this->nomeServico;
    }

    function getPrecoServico() {
        return $this->precoServico;
    }

    function getTempoReparo() {
        return $this->tempoReparo;
    }

    function getDescrServico() {
        return $this->descrServico;
    }

    function setIdServico($idServico) {
        $this->idServico = $idServico;
    }

    function setNomeServico($nomeServico) {
        $this->nomeServico = $nomeServico;
    }

    function setPrecoServico($precoServico) {
        $this->precoServico = $precoServico;
    }

    function setTempoReparo($tempoReparo) {
        $this->tempoReparo = $tempoReparo;
    }

    function setDescrServico($descrServico) {
        $this->descrServico = $descrServico;
    }
}
