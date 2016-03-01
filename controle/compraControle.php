<?php

class compraControle {
    public function __construct($compra) {
        $c = new Compra();
        $c->setIdCompra($compra['idCompra']);
        $c->setIdPJuridica($compra['fornecedor']);
        $c->setDataCompra($compra['dataCompra']);
        $c->setValorCompra($compra['totalCompra']);
        $c->setDesconto($compra['desconto']);
        $c->setNumeroParcelas($compra['parcela']);
        $c->setVencimento($compra['vencimento']);
        
        if(!empty($c->getDataCompra())){
            $this->salvarCompra(
                    $c->getIdPJuridica(),
                    $c->getDataCompra(),
                    $c->getValorCompra(),
                    $c->getDesconto(),
                    $c->getNumeroParcelas(),
                    $c->getVencimento()
            );
        }
    }
    
    public function salvarCompra($pj, $dcompra, $vCompra, $desc, $parc, $venc){
        $sql = "INSERT INTO compra (idPJuridica, dataCompra, valorCompra, desconto, numeroParcelas, vencimento) VALUES ('$pj','$dcompra','$vCompra' ,'$desc','$parc','$venc')";
        
        mysql_query($sql);
        echo mysql_error();
        if(empty(mysql_error())){
            $this->mensagem("Salvo com sucesso!");
        } else {
            $this->mensagem("Ops ocorreu um erro: ".mysql_error());
        }
    }   
    
    public function listarCompra(){
        $sql = "SELECT * FROM compra INNER JOIN itenscompra ON compra.idCompra = itenscompra.idCompra INNER JOIN pessoajuridica ON compra.idPJuridica = pessoajuridica.idPJuridica GROUP BY compra.idCompra ORDER BY compra.idCompra DESC";
        $consulta = mysql_query($sql);
        while ($resultado = mysql_fetch_array($consulta)){
            $r[] = $resultado;
        }
        return $r;
    }
    
    public function listarCompraCod($idCompra){
        $sql = "SELECT * FROM compra WHERE idCompra = $idCompra";
        $consulta = mysql_query($sql);
        $c = mysql_fetch_assoc($consulta);
        
        return $c;
    }
    
    public function listaItensCompra($idCompra){
        $sql = "SELECT * FROM itensCompra INNER JOIN produto ON itensCompra.idProduto = produto.idProduto WHERE idCompra = $idCompra";
        $consulta = mysql_query($sql);
        
        while ($resultado = mysql_fetch_array($consulta)){
            $c[] = $resultado;
        }
        return $c;
    }
    
    public function contaCompra(){
        $sql = "SELECT count(idCompra) as 'Compra'  FROM compra";
        $consulta = mysql_query($sql);
        while($resultado = mysql_fetch_array($consulta)){
                $linha[] = $resultado;
        }
        return $linha;
    }
    
    public function mensagem($mensagem){
        echo "<script>alert('".$mensagem."');</script>";
    }
}
