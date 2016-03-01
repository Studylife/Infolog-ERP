<?php

class Estado {
    private $idEstado;
    public $nomeEstado;
    public $siglaEstado;
    
    function getIdEstado() {
        return $this->idEstado;
    }

    function getNomeEstado() {
        return $this->nomeEstado;
    }

    function getSiglaEstado() {
        return $this->siglaEstado;
    }

    function setIdEstado($idEstado) {
        $this->idEstado = $idEstado;
    }

    function setNomeEstado($nomeEstado) {
        $this->nomeEstado = $nomeEstado;
    }

    function setSiglaEstado($siglaEstado) {
        $this->siglaEstado = $siglaEstado;
    }



}
