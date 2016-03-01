<?php
/**
 * Description of cidade
 *
 * @author jefferson
 */
class cidade{
    private $idCidade;
    public $nomeCidade;
    private $idEstado;
    
    function getIdCidade() {
        return $this->idCidade;
    }

    function getNomeCidade() {
        return $this->nomeCidade;
    }

    function getIdEstado() {
        return $this->idEstado;
    }

    function setIdCidade($idCidade) {
        $this->idCidade = $idCidade;
    }

    function setNomeCidade($nomeCidade) {
        $this->nomeCidade = $nomeCidade;
    }

    function setIdEstado($idEstado) {
        $this->idEstado = $idEstado;
    }
}
