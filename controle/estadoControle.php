<?php
class estadoControle {
    function __construct($estado) {
        $est = new Estado();
        $est->setNomeEstado($estado['nome']);
        $est->setSiglaEstado($estado['sigla']);
        if(!empty($est->getNomeEstado())){
            $this->salvarEstado($est->getNomeEstado(), $est->getSiglaEstado());
        }
    }
    
    function salvarEstado($nome, $sigla){
        $sql = "INSERT INTO estado (idEstado, nomeEstado, sigla) VALUES ('', '$nome','$sigla')";
        mysql_query($sql);
        
        if(empty(mysql_error())){
            $this->mensagem("Salvo com sucesso!");
        } else {
            $this->mensagem("Ops ocorreu um erro: ".mysql_error());
        }
    }
    
    function removeEstado($estado){
        $sql = "DELETE FROM estado WHERE idEstado = '$estado'";
        mysql_query($sql);
        
        if(empty(mysql_error())){
            $this->mensagem("Estado removido com sucesso!");
        } else {
            $this->mensagem("Ops, você não pode remover este Estado");
        }
    }
    
    function listaEstado(){
        $sql = "SELECT * FROM estado order by nomeEstado ASC";
        $consulta = mysql_query($sql);
        while($resultado = mysql_fetch_array($consulta)){
            $linha[] = $resultado;
        }
        return $linha;
    }
    
    function verificaEstado($estado){
        $sql = "SELECT estado.nomeEstado FROM estado WHERE estado.nomeEstado = '$estado'";
        $consulta = mysql_query($sql);
        $resultado = mysql_fetch_object($consulta);
        if(!empty($resultado)){
            return $this->mensagem("Ops, este estado já está cadastrado");
        } else {
            $resultado = "";
            return $resultado;
        }
    }
    
    function mensagem($mensagem){
        echo "<script> alert('" . $mensagem . "');</script>";
    }
}