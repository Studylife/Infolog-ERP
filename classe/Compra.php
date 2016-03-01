<?php
class Compra {
    private $idCompra;
    private $idPJuridica;
    private $dataCompra;
    public  $valorCompra;
    public  $desconto;
    public  $numeroParcelas;
    public  $vencimento;
    
    
    function getValorCompra() {
        return $this->valorCompra;
    }

    function setValorCompra($valorCompra) {
        $this->valorCompra = $valorCompra;
    }

    function getIdCompra() {
        return $this->idCompra;
    }

    function getIdPJuridica() {
        return $this->idPJuridica;
    }

    function getDataCompra() {
        return $this->dataCompra;
    }

    function getDesconto() {
        return $this->desconto;
    }

    function getNumeroParcelas() {
        return $this->numeroParcelas;
    }

    function getVencimento() {
        return $this->vencimento;
    }

    function setIdCompra($idCompra) {
        $this->idCompra = $idCompra;
    }

    function setIdPJuridica($idPJuridica) {
        $this->idPJuridica = $idPJuridica;
    }

    function setDataCompra($dataCompra) {
        $this->dataCompra = $dataCompra;
    }

    function setDesconto($desconto) {
        $this->desconto = $desconto;
    }

    function setNumeroParcelas($numeroParcelas) {
        $this->numeroParcelas = $numeroParcelas;
    }

    function setVencimento($vencimento) {
        $this->vencimento = $vencimento;
    }


}
