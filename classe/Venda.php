<?php
class Venda {
    private $idVenda;
    private $idPessoa;
    public $dataVenda;
    public $valorTotal;
    public $numeroParcelas;
    public $desconto;
    
    function getIdVenda() {
        return $this->idVenda;
    }

    function getIdPessoa() {
        return $this->idPessoa;
    }

    function getDataVenda() {
        return $this->dataVenda;
    }

    function getValorTotal() {
        return $this->valorTotal;
    }

    function getNumeroParcelas() {
        return $this->numeroParcelas;
    }

    function getDesconto() {
        return $this->desconto;
    }

    function setIdVenda($idVenda) {
        $this->idVenda = $idVenda;
    }

    function setIdPessoa($idPessoa) {
        $this->idPessoa = $idPessoa;
    }

    function setDataVenda($dataVenda) {
        $this->dataVenda = $dataVenda;
    }

    function setValorTotal($valorTotal) {
        $this->valorTotal = $valorTotal;
    }

    function setNumeroParcelas($numeroParcelas) {
        $this->numeroParcelas = $numeroParcelas;
    }

    function setDesconto($desconto) {
        $this->desconto = $desconto;
    }
}
