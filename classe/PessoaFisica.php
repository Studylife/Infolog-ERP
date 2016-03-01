<?php
/**
 * Description of pessoaFisica
 *
 * @author jefferson
 */
include 'pessoa.php';

class PessoaFisica extends Pessoa{
    private $idPessoaFisica;
    private $idPessoa;
    private $cpf;
    private $rg;
    
    function getIdPessoaFisica() {
        return $this->idPessoaFisica;
    }

    function getIdPessoa() {
        return $this->idPessoa;
    }

    function getCpf() {
        return $this->cpf;
    }

    function getRg() {
        return $this->rg;
    }

    function setIdPessoaFisica($idPessoaFisica) {
        $this->idPessoaFisica = $idPessoaFisica;
    }

    function setIdPessoa($idPessoa) {
        $this->idPessoa = $idPessoa;
    }

    function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    function setRg($rg) {
        $this->rg = $rg;
    }
}