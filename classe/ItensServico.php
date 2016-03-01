<?php
class ItensServico {
    private $idItensServico;
    private $idVenda;
    private $idServico;
    private $valorServico;
    private $status;
    
    function getIdItensServico() {
        return $this->idItensServico;
    }

    function getIdVenda() {
        return $this->idVenda;
    }

    function getIdServico() {
        return $this->idServico;
    }

    function getValorServico() {
        return $this->valorServico;
    }

    function getStatus() {
        return $this->status;
    }

    function setIdItensServico($idItensServico) {
        $this->idItensServico = $idItensServico;
    }

    function setIdVenda($idVenda) {
        $this->idVenda = $idVenda;
    }

    function setIdServico($idServico) {
        $this->idServico = $idServico;
    }

    function setValorServico($valorServico) {
        $this->valorServico = $valorServico;
    }

    function setStatus($status) {
        $this->status = $status;
    }
}
