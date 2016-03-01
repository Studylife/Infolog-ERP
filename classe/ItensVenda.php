<?php
class ItensVenda {
    private $idItensVenda;
    private $idVenda;
    private $idProduto;
    public $valorUnProd;
    public $quantidade;
    
    function getIdItensVenda() {
        return $this->idItensVenda;
    }

    function getIdVenda() {
        return $this->idVenda;
    }

    function getIdProduto() {
        return $this->idProduto;
    }

    function getValorUnProd() {
        return $this->valorUnProd;
    }

    function getQuantidade() {
        return $this->quantidade;
    }

    function setIdItensVenda($idItensVenda) {
        $this->idItensVenda = $idItensVenda;
    }

    function setIdVenda($idVenda) {
        $this->idVenda = $idVenda;
    }

    function setIdProduto($idProduto) {
        $this->idProduto = $idProduto;
    }

    function setValorUnProd($valorUnProd) {
        $this->valorUnProd = $valorUnProd;
    }

    function setQuantidade($quantidade) {
        $this->quantidade = $quantidade;
    }
}

