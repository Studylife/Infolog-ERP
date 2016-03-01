<?php
class itensServicoControle {
    public function __construct() {
        $is = new ItensServico();
        
        $is->setIdItensServico($idItensServico);
        $is->setIdVenda($idVenda);
        $is->setIdServico($idServico);
        $is->setValorServico($valorServico);
        $is->setStatus($status);
    }
}
