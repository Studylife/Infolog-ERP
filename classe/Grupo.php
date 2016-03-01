<?php
/**
 * Description of Grupo
 *
 * @author jefferson
 */
class Grupo {
    private $idGrupo;
    public $nomeGrupo;
    
    function getIdGrupo() {
        return $this->idGrupo;
    }

    function getNomeGrupo() {
        return $this->nomeGrupo;
    }

    function setIdGrupo($idGrupo) {
        $this->idGrupo = $idGrupo;
    }

    function setNomeGrupo($nomeGrupo) {
        $this->nomeGrupo = $nomeGrupo;
    }


}
