<?php
class itensVendaControle {
    public function __construct() {
        $iv = new ItensVenda();
        
        $iv->setIdItensVenda($idItensVenda);
        $iv->setIdVenda($idVenda);
        $iv->setIdProduto($idProduto);
        $iv->setValorUnProd($valorUnProd);
        $iv->setQuantidade($quantidade);
    }
}
