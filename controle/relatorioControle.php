<?php
class relatorioControle {
    
    //LISTA TODOS OS ESTADOS
    public function relatorioEstado(){
        $sql = "SELECT * FROM estado";
        return $this->query($sql);
    }
    
    //LISTA TODAS AS CIDADES
    public function relatorioCidade(){
        $sql = "SELECT * FROM cidade INNER JOIN estado ON cidade.idEstado = estado.idEstado";
        return $this->query($sql);
    }
    
    //PESSOA
    //LISTA TODOS OS CLIENTES
    public function relatorioCliente(){
        $sql= "SELECT * FROM pessoa INNER JOIN pessoafisica ON pessoa.idPessoa = pessoafisica.idPessoa";
        return $this->query($sql);
    }
    //LISTA INFORMAÇÕES DOS FORNECEDORES
    public function relatorioFornecedor(){
        $sql= "SELECT * FROM pessoa INNER JOIN pessoaJuridica ON pessoa.idPessoa = pessoaJuridica.idPessoa";
        return $this->query($sql);
    }
    
    
    //VENDA
    public function relatorioVenda($dataInicio, $dataFim){
        $sql = "SELECT * FROM venda INNER JOIN pessoa ON venda.idPessoa = pessoa.idPessoa WHERE dataVenda BETWEEN '$dataInicio' AND '$dataFim' ORDER BY dataVenda ASC";
        return $this->query($sql);
    }
    public function relatorioItensVenda($idVenda){
        $sql = "SELECT * FROM itensvenda INNER JOIN venda ON itensvenda.idVenda = venda.idVenda INNER JOIN produto ON itensvenda.idProduto = produto.idProduto WHERE itensvenda.idVenda = '$idVenda'";
        return $this->query($sql);
    }
    public function relatorioItensServico($idVenda){
        $sql = "SELECT * FROM itensservico INNER JOIN venda ON itensservico.idVenda = venda.idVenda INNER JOIN servico ON itensservico.idServico = servico.idServico WHERE itensservico.idVenda = '$idVenda'";
        return $this->query($sql);
    }
    
    
    //COMPRA
    public function relatorioCompra($dataInicio, $dataFim){
        $sql = "SELECT * FROM compra INNER JOIN pessoajuridica ON compra.idPJuridica = pessoajuridica.idPJuridica WHERE dataCompra BETWEEN '$dataInicio' AND '$dataFim' ORDER BY dataCompra ASC";
        return $this->query($sql);
    }
    public function relatorioItensCompra($idCompra){
        $sql = "SELECT * FROM itenscompra INNER JOIN compra ON itenscompra.idCompra = compra.idCompra INNER JOIN produto ON itenscompra.idProduto = produto.idProduto WHERE itenscompra.idCompra = '$idCompra' ORDER BY itenscompra.idCompra";
        return $this->query($sql);
    }
    
    
    
    //ESTOQUE
    public function relatorioProduto(){
        $sql = "SELECT * FROM produto";
        return $this->query($sql);
    }
    
    
    //SERVICO
    public function relatorioServico(){
        $sql = "SELECT * FROM servico";
        return $this->query($sql);
    }
    
    
    
    
    
    
    function query($sql){
        $consulta = mysql_query($sql);
        while($resultado = mysql_fetch_array($consulta)){
            $linha[] = $resultado;
        }
        return $linha;
    }
    
    
}
