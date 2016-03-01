<?php


class pessoaJuridicaControle extends pessoaControle {
    function __construct($pessoa) {
        parent::__construct($pessoa);
        
        $pj = new PessoaJuridica();
        $pj->setIdPessoa($pessoa);
        $pj->setIdPJuridica($pessoa);
        $pj->setNomeFantasia($pessoa['fantasia']);
        $pj->setCnpj($pessoa['cnpj']);
        
        if(!empty($pj->getCnpj())){
            $this->salvarPessoaJuridica(mysql_insert_id(), $pj->getNomeFantasia(), $pj->getCnpj());
        }
        
    }

    function salvarPessoaJuridica($idPessoa,$nomeFantasia, $cnpj){
        $sql = "INSERT INTO pessoajuridica (idPJuridica, idPessoa, nomeFantasia, CNPJ) VALUES ('','$idPessoa','$nomeFantasia','$cnpj')";
        mysql_query($sql);
        
        echo mysql_error();
    }
    
    function removePJuridica($idPJuridica){
        $sql = "DELETE FROM pessoajuridica WHERE idPessoa = '$idPJuridica'";
        mysql_query($sql);
        
        if(!empty(mysql_error())){
            $this->mensagem("Não foi possivel excluir esta Pessoa");
        } else {
            $removePessoa = new pessoaControle();
            $removePessoa->removePessoa($idPJuridica);
            $this->mensagem("Pessoa excluida com sucesso");
        }
    }
    
    function listaPessoaJuridica(){
        $sql = "SELECT pessoa.*, pessoajuridica.*, cidade.nomeCidade FROM pessoajuridica INNER JOIN pessoa ON pessoajuridica.idPessoa = pessoa.idPessoa INNER JOIN cidade ON pessoa.idCidade = cidade.IdCidade";
        
        $consulta = mysql_query($sql);
        while($resultado = mysql_fetch_array($consulta)){
            $linha[] = $resultado;
        }
        return $linha;
    }
    
    
    //UPDATE
    //RECUPERA AS INFORMAÇÕES DA EMPRESA
    public function recuperaPJ($idPJuridica){
        $sql = "SELECT * FROM pessoajuridica INNER JOIN pessoa ON pessoajuridica.idPessoa = pessoa.idPessoa INNER JOIN cidade ON pessoa.idCidade = cidade.IdCidade WHERE idPJuridica = '$idPJuridica'";
        $consulta = mysql_query($sql);
        $resultado = mysql_fetch_assoc($consulta);
        return $resultado;
    }
    //ATUALIZA AS INFORMAÇÕES DA PESSOA JURIDICA
    public function editarPJ($pessoa, $idPJ, $idPessoa){
        $sql = "UPDATE pessoajuridica SET nomeFantasia='{$pessoa['fantasia']}', CNPJ='{$pessoa['cnpj']}' WHERE idPJuridica = '$idPJ'";
        mysql_query($sql);
        
        $p = new pessoaControle();
        $p->editaPessoa($pessoa, $idPessoa);
        
        if(mysql_error()){
            $this->mensagem("Ops, você não pode alterar este Cliente");
        } else {
            $this->mensagem("Cliente atualizado com sucesso! ".  mysql_error());
        }
        
    }
    
    function mensagem($mensagem){
        echo "<script> window.alert('" . $mensagem . "'); window.location.href='pessoajuridica.php'</script>";
    }
}
