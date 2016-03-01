<?php
class loginControle {
    public function verificaUsuario($login, $senha){
        $sql = "SELECT * FROM usuario WHERE login ='$login' AND senha ='$senha'";
        $consulta = mysql_query($sql);
        $resultado = mysql_fetch_array($consulta);
        $this->sessaoLogin($resultado['idUsuario']);
    }
    
    public function sessaoLogin($idLogin){
        if($idLogin != 0){
            session_start();
            $_SESSION['idLogin'] = $idLogin;
            header("location: dashboard/index.php");
        }
    }
    
    public function retornaUsuario($idUsuario){
        $sql = "SELECT * FROM usuario INNER JOIN pessoafisica ON usuario.idPFisica = pessoafisica.idPFisica INNER JOIN pessoa ON pessoafisica.idPessoa = pessoa.idPessoa WHERE usuario.idUsuario = '$idUsuario'";
        $consulta = mysql_query($sql);
        $resultado = mysql_fetch_assoc($consulta);
        
        return $resultado;
    }
}
