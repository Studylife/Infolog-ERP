<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of pessoaControle
 *
 * @author jefferson
 */

class pessoaControle{
    function __construct($pessoa) {
        //variavel $p é igual a pessoa
        //Instanciei a classe e criei um objeto
        $p = new Pessoa();
        //separei os atributos da classe
        $p->setIdPessoa($pessoa);
        $p->setIdCidadePessoa($pessoa['cidade']);
        $p->setDataCadastro($pessoa);
        $p->setDataNascimento($pessoa);
        $p->setNomePessoa($pessoa['nome']);
        $p->setCep($pessoa['cep']);
        $p->setNumeroCasa($pessoa['numero']);
        $p->setRua($pessoa['endereco']);
        $p->setBairro($pessoa['bairro']);
        $p->setTelefone($pessoa['telefone']);
        $p->setEmail($pessoa['email']);
        $p->setObservacoes($pessoa);
        
        if(!empty($p->getIdPessoa())){
        $this->salvarPessoa(
                $p->getNomePessoa(),
                $p->getCep(),
                $p->getIdCidadePessoa(),
                $p->getRua(),
                $p->getNumeroCasa(),
                $p->getBairro(),
                $p->getTelefone(),
                $p->getEmail()
                );
        }
    }
    
    function salvarPessoa($nome, $cep, $cidade, $rua, $numero, $bairro,$telefone, $email){
        $sql = "INSERT INTO pessoa (idCidade, nome, cep, numeroCasa, rua, bairro, telefone, email) "
             . "VALUES ('$cidade','$nome','$cep','$numero','$rua','$bairro','$telefone', '$email')";
                
        mysql_query($sql);
    }
    
    function removePessoa($idPessoa){
        $sql = "DELETE FROM pessoa WHERE idPessoa = '$idPessoa'";
        mysql_query($sql);
        
        echo mysql_error();
    }
    
    function selecionaNomePessoa(){
        $sql = "SELECT * FROM pessoa";
        $consulta = mysql_query($sql);
        while($resultado = mysql_fetch_array($consulta)){
            $linha[] = $resultado;
        }
        return $linha;
    }
    
    function contaPessoa(){
        $sql = "SELECT count(idPessoa) as 'cliente' FROM pessoa";
        $consulta = mysql_query($sql);
        while($resultado = mysql_fetch_array($consulta)){
            $linha[] = $resultado;
        }
        return $linha;
    }
    
    //ATUALIZA AS INFORMAÇÕES DA PESSOA
    public function editaPessoa($pessoa, $idPessoa){
        echo $pessoa['bairro'];
        $sql = "UPDATE pessoa SET idCidade='{$pessoa['cidade']}', nome='{$pessoa['nome']}', cep='{$pessoa['cep']}', numeroCasa='{$pessoa['numero']}', rua='{$pessoa['endereco']}', bairro='{$pessoa['bairro']}', telefone='{$pessoa['telefone']}', email='{$pessoa['email']}' WHERE idPessoa = '$idPessoa'";
        mysql_query($sql);
    }
}
