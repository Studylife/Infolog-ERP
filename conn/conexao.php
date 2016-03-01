<?php
//verifica se a está tentando acessar a pagina direto pela url

//faz a conexão com o banco
class Banco{
    private $host       = "localhost";
    private $usuario    = "root";
    private $senha      = "";
    private $banco      = "infologg";
    
    public $sql;
    public $conexao;
    public $resultado;
    
    function conectaBanco(){
        $this->conexao = mysql_connect($this->host, $this->usuario, $this->senha, $this->resultado);
        if(!$this->conexao){
            echo "Ops ocorreu um erro: " . mysql_error();
            die();
        } else if(!mysql_select_db($this->banco, $this->conexao)){
            echo "Ops ocorreu um erro: " . mysql_error();
            die();
        }
        //Força o banco a salvar em formato UTF8 as informações.
        mysql_query("SET NAMES 'utf8'");
    }
    
    function disconnect(){
        return mysql_close($this->conexao);
    }
    
}