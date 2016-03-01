<?php
/**
 * Description of pessoa
 *
 * @author jefferson
 */
class Pessoa {
    //INFORMAÇÕES PESSOAIS
    private $idPessoa;
    private $idCidadePessoa;
    public $dataCadastro;
    public $dataNascimento;
    public $nomePessoa;
    //ENDEREÇO
    public $cep;
    public $numeroCasa;
    public $rua;
    public $bairro;
    public $telefone;
    public $email;
    public $observacoes;
    
    function getIdPessoa() {
        return $this->idPessoa;
    }

    function getIdCidadePessoa() {
        return $this->idCidadePessoa;
    }

    function getDataCadastro() {
        return $this->dataCadastro;
    }

    function getDataNascimento() {
        return $this->dataNascimento;
    }

    function getNomePessoa() {
        return $this->nomePessoa;
    }

    function getCep() {
        return $this->cep;
    }

    function getNumeroCasa() {
        return $this->numeroCasa;
    }

    function getRua() {
        return $this->rua;
    }

    function getBairro() {
        return $this->bairro;
    }

    function getTelefone() {
        return $this->telefone;
    }

    function getEmail() {
        return $this->email;
    }

    function getObservacoes() {
        return $this->observacoes;
    }

    function setIdPessoa($idPessoa) {
        $this->idPessoa = $idPessoa;
    }

    function setIdCidadePessoa($idCidadePessoa) {
        $this->idCidadePessoa = $idCidadePessoa;
    }

    function setDataCadastro($dataCadastro) {
        $this->dataCadastro = $dataCadastro;
    }

    function setDataNascimento($dataNascimento) {
        $this->dataNascimento = $dataNascimento;
    }

    function setNomePessoa($nomePessoa) {
        $this->nomePessoa = $nomePessoa;
    }

    function setCep($cep) {
        $this->cep = $cep;
    }

    function setNumeroCasa($numeroCasa) {
        $this->numeroCasa = $numeroCasa;
    }

    function setRua($rua) {
        $this->rua = $rua;
    }

    function setBairro($bairro) {
        $this->bairro = $bairro;
    }

    function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setObservacoes($observacoes) {
        $this->observacoes = $observacoes;
    }
}
