<?php
/**
 * Description of Produto
 *
 * @author jefferson
 */
class Produto {
    private $codBarras;
    private $nomeProduto;
    private $valorVendas;
    private $estoqueMin;
    private $descricaoProduto;
    
    function getCodBarras() {
        return $this->codBarras;
    }

    function getNomeProduto() {
        return $this->nomeProduto;
    }

    function getValorVendas() {
        return $this->valorVendas;
    }

    function getEstoqueMin() {
        return $this->estoqueMin;
    }

    function getDescricaoProduto() {
        return $this->descricaoProduto;
    }

    function setCodBarras($codBarras) {
        $this->codBarras = $codBarras;
    }

    function setNomeProduto($nomeProduto) {
        $this->nomeProduto = $nomeProduto;
    }

    function setValorVendas($valorVendas) {
        $this->valorVendas = $valorVendas;
    }

    function setEstoqueMin($estoqueMin) {
        $this->estoqueMin = $estoqueMin;
    }

    function setDescricaoProduto($descricaoProduto) {
        $this->descricaoProduto = $descricaoProduto;
    }


}


