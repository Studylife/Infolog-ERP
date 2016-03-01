<?php
class usuarioSistemaControle {
    public function salvarUsuario($usuario){
        $sql = "INSERT INTO usuario (idPFisica, login, senha, horaInicio, horaFim, observacoes) VALUES ('{$usuario['pessoa']}', '{$usuario['login']}', '{$usuario['senha']}', '{$usuario['inicio']}','{$usuario['fim']}', '{$usuario['obs']}')";
        mysql_query($sql);

        if(empty(mysql_error())){
            $this->mensagem("Salvo com sucesso!");
        } else {
            $this->mensagem("Ops ocorreu um erro: ".mysql_error());
        }	
        
    }
    
    public function listaUsuario(){
        $sql = "SELECT * FROM usuario INNER JOIN pessoafisica ON usuario.idPFisica = pessoafisica.idPFisica INNER JOIN pessoa ON pessoafisica.idPessoa = pessoa.idPessoa";
        $consulta = mysql_query($sql);
        while($resultado = mysql_fetch_array($consulta)){
            $linha [] = $resultado;
        }
        return $linha;
    }
    
    function mensagem($mensagem){
        echo "<script> window.alert('" . $mensagem . "'); window.location.href='usuario.php'</script>";
    }

}
