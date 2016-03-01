<?php
class cidadeControle {
    function __construct($cidade) {
        $cit = new Cidade();
        $cit->setNomeCidade($cidade['nome']);
        $cit->setIdEstado($cidade['estado']);
        if(!empty($cit->getNomeCidade())){
            $this->salvarCidade($cit->getNomeCidade(), $cit->getIdEstado());
        }
    }
    
    function salvarCidade($cidade, $estado){
        $sql = "INSERT INTO cidade (idCidade, idEstado, nomeCidade) VALUES ('', '$estado','$cidade')";
        mysql_query($sql);
        
        if(empty(mysql_error())){
            $this->mensagem("Salvo com sucesso!");
        } else {
            $this->mensagem("Ops ocorreu um erro: ".mysql_error());
        }
    }
    
    function editarCidade($cidade, $estado, $idCidade){
        $sql = "UPDATE cidade SET nomeCidade='$cidade', idEstado='$estado' WHERE idCidade = '$idCidade'";
        mysql_query($sql);
        
        if(mysql_error()){
            $this->mensagem("Ops, você não pode alterar esta Cidade");
        } else {
            $this->mensagem("Cidade atualizada com sucesso!");
        }
    }
    
    public function recuperaCidade($idCidade){
        $sql = "SELECT * FROM cidade INNER JOIN estado ON cidade.idEstado = estado.idEstado WHERE idCidade = '$idCidade'";
        $consulta = mysql_query($sql);
        $resultado = mysql_fetch_assoc($consulta);
        return $resultado;
    }
    
    function removerCidade($cidade){
        $sql = "DELETE FROM cidade WHERE idCidade = '$cidade'";
        mysql_query($sql);
        
        if(empty(mysql_error())){
            $this->mensagem("Cidade removida com sucesso!");
        } else {
            $this->mensagem("Ops, você não pode remover esta Cidade");
        }
    }
    
    function listaCidades(){
        $sql = "SELECT * FROM cidade INNER JOIN estado on cidade.idEstado = estado.idEstado ORDER BY cidade.nomeCidade ASC";
        
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