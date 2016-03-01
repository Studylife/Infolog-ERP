<?php
/**
 * Description of produtoControle
 *
 * @author jefferson
 */
class produtoControle {
    function __construct($produto) {
        $prod = new Produto();
        $prod->setCodBarras($produto['codbarras']);
        $prod->setNomeProduto($produto['nomeproduto']);
        $prod->setEstoqueMin($produto['estoque']);
        $prod->setValorVendas($produto['valor']);
        $prod->setDescricaoProduto($produto['descrproduto']);
        
        if(!empty($prod->getNomeProduto())){
            $this->salvarProduto(
                $prod->getCodBarras(), 
                $prod->getNomeProduto(), 
                $prod->getEstoqueMin(), 
                $prod->getValorVendas(),
                $prod->getDescricaoProduto()
            );
        }
    }
    function salvarProduto($codBarras, $nome, $estoque, $valor, $descricao){
        $sql = "INSERT INTO produto (idProduto, idGrupo, idUnMedida, codBarras, nomeProduto, valorVenda, estoqueProd, estoqueMin, descProduto)"
                        .  "VALUES ('','1','1','$codBarras', '$nome', '$valor', '0', '$estoque', '$descricao')";
        mysql_query($sql);
        
        $this->verificaErro(mysql_error());
    }
    
    function removerProduto($idProduto){
        $sql = "";
        mysql_query($sql);
        $this->verificaErro(mysql_error());
    }
    
    function editarProduto(){
        $sql = "";
        mysql_query($sql);
        $this->verificaErro(mysql_error());
    }
    
    function listaProduto(){
        $sql = "SELECT * FROM produto";
        
        $consulta = mysql_query($sql);
        while($resultado = mysql_fetch_array($consulta)){
            $linha[] = $resultado;
        }
        return $linha;
    }
    
    function verificaErro($erro){
        if(empty($erro)){
            $this->mensagem("Produto salvo com sucesso!");
        } else {
            $this->mensagem("Ops ocorreu um erro, este produto não pode ser salvo!" . mysql_error());
        }
    }
    
    function mensagem($mensagem){
        echo "<script>alert('".$mensagem."');</script>";
    }
    
    public function listaDashboard(){
        $sql = "SELECT * FROM produto ORDER BY estoqueProd ASC LIMIT 10 ";
        
        $consulta = mysql_query($sql);
        while($resultado = mysql_fetch_array($consulta)){
            $linha[] = $resultado;
        }
        return $linha;
    }
}
