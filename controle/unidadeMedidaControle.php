<?php
/**
 * Description of produtoControle
 *
 * @author jefferson
 */
class unidadeMedidaControle {
    function __construct($unidade) {
        $un = new UnidadeMedida();
        $un->setIdUnidade($unidade);
        $un->setNomeUnidadeMedida($unidade);
        
        if(empty($un->getNomeUnidadeMedida())){
        }
    }
    
    function salvarUnidadeMedida(){
        
    }
    
    function removerUnidadeMedida(){
        
    }
    
    function editarUnidadeMedida(){
        
    }
    
    function listarUnidadeMedida(){
        
    }
    
    function verificaErro($erro){
        if(empty($erro)){
            $this->mensagem("Produto salvo com sucesso!");
        } else {
            $this->mensagem("Ops ocorreu um erro, este produto não pode ser salvo!");
        }
    }
    
    function mensagem($mensagem){
        echo $mensagem;
    }
}
