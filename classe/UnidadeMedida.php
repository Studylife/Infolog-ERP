<?php
/**
 * Description of cidade
 *
 * @author jefferson
 */
class UnidadeMedida{
    private $idUnidade;
    public $nomeUnidadeMedida;
    
    function getIdUnidade() {
        return $this->idUnidade;
    }

    function getNomeUnidadeMedida() {
        return $this->nomeUnidadeMedida;
    }

    function setIdUnidade($idUnidade) {
        $this->idUnidade = $idUnidade;
    }

    function setNomeUnidadeMedida($nomeUnidadeMedida) {
        $this->nomeUnidadeMedida = $nomeUnidadeMedida;
    }


}
