<?php
class servicoControle {
    
    public function salvarServico($servico){
        $sql = "INSERT INTO servico (nomeServico, precoServico, tempoReparo, descrServico) VALUES ('{$servico['servico']}', '{$servico['valor']}', '{$servico['tempo']}', '{$servico['descricao']}')";
        mysql_query($sql);
        
        if(empty(mysql_error())){
            $this->mensagem("Salvo com sucesso!");
        } else {
            $this->mensagem("Ops ocorreu um erro: ".mysql_error());
        }
    }
    
    public function excluirServico($idServico){
        $sql = "DELETE FROM servico WHERE idServico = '$idServico'";
        mysql_query($sql);
        
        if(empty(mysql_error())){
            $this->mensagem("Removido com sucesso!");
        } else {
            $this->mensagem("Ops ocorreu um erro: ".mysql_error());
        }
    }
    
    public function listarServico(){
        $sql = "SELECT * FROM servico";
        $consulta = mysql_query($sql);
        while($resultado = mysql_fetch_array($consulta)){
            $linha[] = $resultado;
        }
        return $linha;
    }
    
    public function recuperaServico($idServico){
        $sql = "SELECT * FROM servico WHERE idServico = '$idServico'";
        $consulta = mysql_query($sql);
        $resultado = mysql_fetch_assoc($consulta);
        return $resultado;
    }
    
    public function editarServico($servico, $idServico){
        $sql = "UPDATE servico SET nomeServico='{$servico['servico']}', precoServico='{$servico['valor']}', tempoReparo='{$servico['tempo']}', descrServico='{$servico['descricao']}' WHERE idServico = '$idServico'";
        mysql_query($sql);
        
        if(empty(mysql_error())){
            $this->mensagem("Alterado com sucesso!");
        } else {
            $this->mensagem("Ops ocorreu um erro: ".mysql_error());
        }
    }
    
    function mensagem($mensagem){
        echo "<script> window.alert('" . $mensagem . "'); window.location.href='servico.php'</script>";
    }
}
