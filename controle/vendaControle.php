<?php
class vendaControle{
    //////////////////////////////////////////////////
    //PRODUTOS
    //////////////////////////////////////////////////
    //LISTA TODOS OS PRODUTOS
    public function listaProdutos(){
        $sql = "SELECT idProduto, nomeProduto FROM produto";
        $consulta = mysql_query($sql);
        while($resultado = mysql_fetch_array($consulta)){
                $linha[] = $resultado;
        }
        return $linha;
    }	



    //////////////////////////////////////////////////
    //ESTOQUE
    //////////////////////////////////////////////////
    //VERIFICA QUANTIDADE ESTOQUE PRODUTO
    public function verificaEstoque($idProduto){
        $sql = "SELECT estoqueProd FROM produto WHERE idProduto = '$idProduto'";
        $consulta = mysql_query($sql);
        $resultado = mysql_fetch_assoc($consulta);

        return $resultado;
    }
    //INSERE DA BAIXA DO PRODUTO NO ESTOQUE
    public function updateEstoque($estoque, $idProduto){
        $sql = "UPDATE produto SET estoqueProd='$estoque' WHERE idProduto = '$idProduto'";
        mysql_query($sql);
    }
    //REALIZA UMA VERIFICAÇÃO SE O PRODUTO CONSTA NO ESTOQUE ANTES DE ADICIONAR NA LISTA DE PRODUTOS
    public function verificaEstoqueCarrinho($idProduto, $quantidade){
        $estoque = $this->verificaEstoque($idProduto);
        
        if($estoque['estoqueProd'] < $quantidade){
        //if($estoque <= 0){
            unset($_SESSION['carrinho'][$idProduto]);
            echo "<script>alert('Quantidade indisponivel, o estoque para este produto é ".$estoque['estoqueProd']."');</script>";
        //}
        }
        
        
    }


    
    //////////////////////////////////////////////////
    //VENDA
    //////////////////////////////////////////////////
    public function salvarVenda($venda){
        $sql = "INSERT INTO venda (idPessoa, dataVenda, valorTotal, numeroParcelas, desconto) VALUES ('{$venda['idPessoa']}','{$venda['dataVenda']}','{$venda['valorTotal']}','{$venda['parcela']}','{$venda['desconto']}')";		
        mysql_query($sql);

        if(empty(mysql_error())){
            $this->mensagem("Salvo com sucesso!");
        } else {
            $this->mensagem("Ops ocorreu um erro: ".mysql_error());
        }	
        
        return mysql_insert_id();
    }	
    //ITENS VENDA	
    public function salvarItensVenda($venda){
        //FAZ O UPDATE DO ESTOQUE.
        $quantidade = $venda['quantidade'];
        
        print_r($this->verificaEstoque($venda['idProduto']));
        
        if($this->verificaEstoque($venda['idProduto']) > 0){
            $venda['quantidade'] = $this->verificaEstoque($venda['idProduto'])['estoqueProd'] - $venda['quantidade'];
            $this->updateEstoque($venda['quantidade'], $venda['idProduto']);
        } else {
            $this->updateEstoque($venda['quantidade'], $venda['idProduto']);
        }

        //INSERE O ITEM DA VENDA.
        $sql = "INSERT INTO itensvenda (idVenda, idProduto, valorUnProd, quantidade) VALUES ('{$venda['idVenda']}','{$venda['idProduto']}','{$venda['valorUnProd']}','{$quantidade}')";		
        mysql_query($sql);

        unset($_SESSION['carrinho']);

        //VERIFICA SE HOUVE ALGUM ERRO, E EXIBE A MENSAGEM.
        if(!empty(mysql_error())){
            echo mysql_error();
        }
    }
    
    public function salvarItensServico($venda){
        //INSERE O ITEM DA VENDA.
        $sql = "INSERT INTO itensServico (idVenda, idServico, valorServico) VALUES ('{$venda['idVenda']}','{$venda['idServico']}','{$venda['precoServico']}')";		
        mysql_query($sql);

        unset($_SESSION['servico']);
        
        echo mysql_errno();
    }
    
    
    
    //////////////////////////////////////////////////
    //LISTAS
    //////////////////////////////////////////////////
    //LISTA TODAS AS VENDAS
    public function listaVenda(){
        $sql = "SELECT * FROM venda INNER JOIN pessoa ON venda.idPessoa = pessoa.idPessoa ORDER BY dataVenda DESC";
        $consulta = mysql_query($sql);
        while($resultado = mysql_fetch_array($consulta)){
                $linha[] = $resultado;
        }
        return $linha;
    }
    //LISTA A VENDA
    public function listarVendaCod($idVenda){
        $sql = "SELECT * FROM venda WHERE idVenda = $idVenda";
        $consulta = mysql_query($sql);
        $resultado = mysql_fetch_assoc($consulta);

        return $resultado;
    }
    //LISTA ITENS VENDA
    public function listaItensVenda($idVenda){
        $sql = "SELECT * FROM itensvenda INNER JOIN produto ON itensvenda.idProduto = produto.idProduto WHERE idVenda = '$idVenda'";
        $consulta = mysql_query($sql);

        while ($resultado = mysql_fetch_array($consulta)){
            $linha[] = $resultado;
        }
        return $linha;
    }
    //LISTA ITENS SERVICO
    public function listaItensServico($idVenda){
        $sql = "SELECT * FROM itensservico INNER JOIN servico ON itensservico.idServico = servico.idServico WHERE idVenda = '$idVenda'";
        $consulta = mysql_query($sql);

        while ($resultado = mysql_fetch_array($consulta)){
            $linha[] = $resultado;
        }
        return $linha;
    }
    
    
    
    
    //LISTA DASHBOARD
    public function listaDashBoard(){
        $sql = "SELECT * FROM venda INNER JOIN pessoa ON venda.idPessoa = pessoa.idPessoa ORDER BY venda.dataVenda ASC LIMIT 10";
        $consulta = mysql_query($sql);
        while($resultado = mysql_fetch_array($consulta)){
                $linha[] = $resultado;
        }
        return $linha;
    }
    //LISTA DASHBOARD
    public function totalVendas(){
        $sql = "SELECT count(idVenda) as 'vendas', SUM(valorTotal) as 'valor'  FROM venda";
        $consulta = mysql_query($sql);
        while($resultado = mysql_fetch_array($consulta)){
                $linha[] = $resultado;
        }
        return $linha;
    }
    
    
    
    function mensagem($mensagem){
        echo "<script> window.alert('" . $mensagem . "'); window.location.href='vendaProduto.php'</script>";
    }





    //////////////////////////////////////////////////
    //SELECIONA PESSOA
    //////////////////////////////////////////////////
    public function listaPessoa(){
        $sql = "SELECT * FROM pessoa";
        $consulta = mysql_query($sql);
        while($resultado = mysql_fetch_array($consulta)){
                $linha[] = $resultado;
        }
        return $linha;
    }
}
    	
?>