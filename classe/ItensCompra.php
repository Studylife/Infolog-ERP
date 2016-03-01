<?php
class ItensCompra {
    private $idItensCompra;
    private $idCompra;
    private $idproduto;
    public $valorUn;
    public $quantidade;
    
    function getIdItensCompra() {
        return $this->idItensCompra;
    }

    function getIdCompra() {
        return $this->idCompra;
    }

    function getIdproduto() {
        return $this->idproduto;
    }

    function getValorUn() {
        return $this->valorUn;
    }

    function getQuantidade() {
        return $this->quantidade;
    }

    function setIdItensCompra($idItensCompra) {
        $this->idItensCompra = $idItensCompra;
    }

    function setIdCompra($idCompra) {
        $this->idCompra = $idCompra;
    }

    function setIdproduto($idproduto) {
        $this->idproduto = $idproduto;
    }

    function setValorUn($valorUn) {
        $this->valorUn = $valorUn;
    }

    function setQuantidade($quantidade) {
        $this->quantidade = $quantidade;
    }


}
