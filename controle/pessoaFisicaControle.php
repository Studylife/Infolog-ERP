<?php
class pessoaFisicaControle extends pessoaControle{
    function __construct($pessoaFisica) {
        parent:: __construct($pessoaFisica);
        //Variavel $pf é igual a pessoaFisica
        
        $pf = new PessoaFisica();
        $pf->setIdPessoaFisica();
        $pf->setIdPessoa();
        $pf->setCpf($pessoaFisica['cpf']);
        $pf->setRg($pessoaFisica['rg']);
        
        if(!empty($pf->getCpf())){
            $this->salvarPessoaFisica($pf->getCpf(), $pf->getRg(), mysql_insert_id());
        }
    }
    
    function salvarPessoaFisica($cpf, $rg, $idPessoa){
        $sql = "INSERT INTO pessoafisica (IdPessoa, CPF, RG) VALUES ('$idPessoa','$cpf','$rg')";
        mysql_query($sql);
        
        echo mysql_error();
    }
    
    function removePessoaFisica($idPFisica){
        $sql = "DELETE FROM pessoafisica WHERE IdPessoa = '$idPFisica'";
        mysql_query($sql);
        
        if(!empty(mysql_error())){
            return $this->mensagem("Não foi possivel excluir esta Pessoa");
        } else {
            $removePessoa = new pessoaControle();
            $removePessoa->removePessoa($idPFisica);
            return $this->mensagem("Pessoa excluida com sucesso");
        }
        
    }      
    function listaPessoaFisica(){
        $sql = "SELECT pessoafisica.*, pessoa.*, cidade.nomeCidade FROM pessoafisica INNER JOIN pessoa ON pessoafisica.idPessoa = pessoa.idPessoa INNER JOIN cidade ON pessoa.idCidade = cidade.IdCidade ORDER BY idPFisica DESC";
        
        $consulta = mysql_query($sql);
        while($resultado = mysql_fetch_array($consulta)){
            $linha[] = $resultado;
        }
        return $linha;
    }
    
    //UPDATE
    //RECUPERA AS INFORMAÇÕES DE UMA PESSOA
    public function recuperaPF($idPFisica){
        $sql = "SELECT * FROM pessoafisica INNER JOIN pessoa ON pessoafisica.idPessoa = pessoa.idPessoa INNER JOIN cidade ON pessoa.idCidade = cidade.IdCidade WHERE pessoafisica.idPFisica = '$idPFisica'";
        $consulta = mysql_query($sql);
        $resultado = mysql_fetch_assoc($consulta);
        return $resultado;
    }
    
    //ATUALIZA AS INFORMAÇÕES DA PESSOA FISICA
    public function editaPF($pessoa, $idPF, $idPessoa){
        $sql = "UPDATE pessoafisica SET CPF='{$pessoa['cpf']}', RG='{$pessoa['rg']}' WHERE idPFisica = '{$idPF}'";
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
        echo "<script> window.alert('" . $mensagem . "'); window.location.href='pessoafisica.php'</script>";
    }
}
