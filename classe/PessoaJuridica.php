<?php
/**
 * Description of pessoaJuridica
 *
 * @author jefferson
 */
include 'Pessoa.php';
class PessoaJuridica extends Pessoa{
    private $idPJuridica;
    private $idPessoa;
    public $nomeFantasia;
    private $cnpj;
    
    function getIdPJuridica() {
        return $this->idPJuridica;
    }

    function getIdPessoa() {
        return $this->idPessoa;
    }

    function getNomeFantasia() {
        return $this->nomeFantasia;
    }

    function getCnpj() {
        return $this->cnpj;
    }

    function setIdPJuridica($idPJuridica) {
        $this->idPJuridica = $idPJuridica;
    }

    function setIdPessoa($idPessoa) {
        $this->idPessoa = $idPessoa;
    }

    function setNomeFantasia($nomeFantasia) {
        $this->nomeFantasia = $nomeFantasia;
    }

    function setCnpj($cnpj) {
        $this->cnpj = $cnpj;
    }
}