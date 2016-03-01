<?php
class itensCompraControle{
    public function __construct($compra) {
        $ic = new ItensCompra();
        $ic->setIdItensCompra($compra);
        $ic->setIdCompra($compra['idcompra']);
        $ic->setIdproduto($compra['idItem']);
        $ic->setValorUn($compra['valorUn']);
        $ic->setQuantidade($compra['quant']);
                
        if(!empty($ic->getIdCompra())){
            $this->salvarItensCompra(
                    $ic->getIdCompra(),
                    $ic->getIdproduto(),
                    $ic->getValorUn(),
                    $ic->getQuantidade()
            );
        }
    }
    
    public function salvarItensCompra($compra, $produto, $valorUn, $quantidade){
        //INSERE ITENS DO CARRINHO
        $sql = "INSERT INTO itenscompra (idCompra, idProduto, valorUn, quantidade) VALUES ('$compra','$produto','$valorUn','$quantidade')";
        mysql_query($sql);
        
        echo mysql_error();
        unset($_SESSION['carrinho']);
        
        //VERIFICA ESTOQUE DO PRODUTO E ATUALIZA O ESTOQUE DO PRODUTO
        if($this->verificaquantidadeEstoque($produto) != 0){
            $quantidade = $quantidade + $this->verificaquantidadeEstoque($produto);
            $this->atualizaestoqueCompra($produto, $quantidade);
        } else {
            $this->atualizaestoqueCompra($produto, $quantidade);
        }
    }
    
    public function atualizaestoqueCompra($idProduto, $estoque){
        $sql = "UPDATE produto SET estoqueProd='$estoque' WHERE idProduto = '$idProduto'";
        mysql_query($sql);
        
        echo mysql_error();
    }
    public function verificaquantidadeEstoque($idProduto){
        $sql = "SELECT estoqueProd FROM produto WHERE idProduto = '$idProduto'";
        $consulta = mysql_query($sql);
        $resultado = mysql_fetch_assoc($consulta);
        
        return $resultado['estoqueProd'];
    }
}
