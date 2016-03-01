<?php
    include '../../conn/conexao.php';
    include '../../classe/Cidade.php';
    include '../../classe/PessoaFisica.php';
    include '../../controle/cidadeControle.php';
    include '../../controle/pessoaControle.php';
    include '../../controle/pessoaFisicaControle.php';
    
    $banco = new Banco();
    $banco->conectaBanco();
    
    
    
    //RECEBE AÇÃO
    $remove = (int)$_GET['remover'];
    $editar = (int)$_GET['editar'];
    $update = $_GET['acao'];
    
    
    //Estancia a classe dO CLIENTE
    $PFisica = new pessoaFisicaControle();
    
    //RECUPERA AS INFORMAÇÕES DA PESSOA FISICA
    if(!empty($editar)){
        $pf = $PFisica->recuperaPF($editar);
    }
    
    //SALVA CLIENTE
    if(!empty($_POST)){
        $pessoa['nome']     = $_POST['nome'];
        $pessoa['cpf']      = preg_replace("/\D/","", $_POST['cpf']);
        $pessoa['rg']       = $_POST['rg'];
        $pessoa['cep']      = preg_replace("/\D/","", $_POST['cep']);
        $pessoa['cidade']   = $_POST['cidade'];
        $pessoa['endereco'] = $_POST['endereco'];
        $pessoa['numero']   = $_POST['numero'];
        $pessoa['bairro']   = $_POST['bairro'];
        $pessoa['telefone'] = preg_replace("/\D/","", $_POST['telefone']);
        $pessoa['email']    = $_POST['email'];
        
        //VERIFICA SE É UM UPDATE
        if($update != 'salvar'){
            //SALVA UMA NOVA PESSOA
            $salvaPf = new pessoaFisicaControle($pessoa);
        } else {
            //ATUALIZA UMA PESSOA EXISTENTE
            $PFisica->editaPF($pessoa, $editar, $pf['idPessoa']);
        }
    }
    
    //REMOVE ESTADO
    if(!empty($remove)){
        $PFisica->removePessoaFisica($remove);
    }
    //FUNÇÃO QUE SELECIONA OS ITENS DO COMBO DE FORNECEDORES
    function selecionaCombo($id, $id2){
        if($id == $id2){
            return "selected";
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Cadastro de Pessoa</title>
        <link rel="stylesheet" type="text/css" href="../../css/pagina.css" />
        <script src="../../js/jquery-1.11.3.min.js"></script>
        <script src="../../js/mask.js"></script>
        <script src="../../js/menu.js"></script>
        <script src="../../js/formulario.js"></script>
        <script>
        jQuery(document).ready(function() {
            jQuery('a.confirma').click(function(event) {
                event.preventDefault();
                var url = $(this).attr('href');
                var confirm_box = confirm('Deseja realmente excluir?');
                if (confirm_box) {
                   window.location = url;
                }
            });
            var edit = <?php echo $_GET['editar'] ?>;
            if(edit > 0){
                $('#formulario').show();
            }
        });
        </script>
    </head>
    <body>
        <?php include '../header.php'; ?>
        <?php include '../menu.html'; ?>
        <div id="formulario">
            <p class="fechar">X</p>
            <div class="conteudo-form">
                <form method="post" action="<?php echo !empty($editar) ? $_SERVER['PHP_SELF'].'?acao=salvar&editar='.$pf['idPFisica'] : '' ?>">
                    <h1>Cadastrar de Pessoa</h1>
                    <label id="inputgrande">
                        <p>Nome:</p>
                        <input value="<?php echo $pf['nome']; ?>" class="focus" type="text" name="nome" autocomplete="off"/>
                    </label>
                    <label id="inputmedio">
                        <p>CPF:</p>
                        <input value="<?php echo $pf['CPF']; ?>" class="cpf" type="text" name="cpf" autocomplete="off"/>
                    </label>
                    <label id="inputmedio">
                        <p>RG:</p>
                        <input value="<?php echo $pf['RG']; ?>" type="text" name="rg" autocomplete="off"/>
                    </label>
                    <label id="inputpequeno">
                        <p>CEP:</p>
                        <input value="<?php echo $pf['cep']; ?>" class="cep" type="text" name="cep" autocomplete="off"/>
                    </label>
                    <label id="inputmedio">
                        <p>Cidade:</p>
                        <?php 
                        $cidade = new cidadeControle();
                        if(!empty($cidade->listaCidades())){
                            echo "<select name='cidade'>";
                            echo "<option selected disabled>Selecione uma Cidade</option>";
                            foreach ($cidade->listaCidades() as $c){
                                echo "<option value='".$c['idCidade']."' ".  selecionaCombo($pf['idCidade'], $c['idCidade']).">".$c['nomeCidade']."</option>";
                            }
                            echo "</select>";
                        }
                        ?>
                    </label>
                    <label id="inputgrande">
                        <p>Endereço:</p>
                        <input value="<?php echo $pf['rua']; ?>" type="text" name="endereco" autocomplete="off"/>
                    </label>
                    <label id="inputmini">
                        <p>Numero:</p>
                        <input value="<?php echo $pf['numeroCasa']; ?>" type="text" name="numero" autocomplete="off"/>
                    </label>
                    <label id="inputmedio">
                        <p>Bairro:</p>
                        <input value="<?php echo $pf['bairro']; ?>" type="text" name="bairro" autocomplete="off"/>
                    </label>
                    <label id="inputmedio">
                        <p>Telefone:</p>
                        <input value="<?php echo $pf['telefone']; ?>" class="phone" type="text" name="telefone" autocomplete="off"/>
                    </label>
                    <label id="inputgrande">
                        <p>E-mail:</p>
                        <input value="<?php echo $pf['email']; ?>" type="email" name="email" autocomplete="off"/>
                    </label>
                    <input id="botaoinput" type="submit" value="Cadastrar" />
                </form>
            </div>
        </div>
        <div id="conteudo">
            <p class="migalha">Dashboard > Cadastro de Pessoa</p>
            <h1>Cadastro de Pessoa</h1>
            <p id="botao1" class="botaoregistro">Nova Pessoa</p>
            <table cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>RG</th>
                        <th>Cidade</th>
                        <th>CEP</th>
                        <th>Casa</th>
                        <th>Rua</th>
                        <th>Bairro</th>
                        <th>Telefone</th>
                        <th>Email</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $listaPessoa = new pessoaFisicaControle();
                if(count($listaPessoa->listaPessoaFisica())){
                    foreach ($listaPessoa->listaPessoaFisica() as $l){
                        echo "<tr>";
                        echo "<td><a href=''>".$l['nome']."</a></td>";
                        echo "<td class='cpf'><a href=''>".$l['CPF']."</a></td>";
                        echo "<td><a href=''>".$l['RG']."</a></td>";
                        echo "<td><a href=''>".$l['nomeCidade']."</a></td>";
                        echo "<td class='cep'><a href=''>".$l['cep']."</a></td>";
                        echo "<td><a href=''>".$l['numeroCasa']."</a></td>";
                        echo "<td><a href=''>".$l['rua']."</a></td>";
                        echo "<td><a href=''>".$l['bairro']."</a></td>";
                        echo "<td class='telefone'><a href=''>".$l['telefone']."</a></td>";
                        echo "<td><a href=''>".$l['email']."</a></td>";
                        echo "<td width='5%'><a href=".'?editar='.$l['idPFisica']."><img src='../../img/icon/edit.gif' /></a></td>";
                        echo "<td width='5%'><a href=".'?remover='.$l['idPFisica']." class='confirma'><img src='../../img/icon/remove.gif' /></a></td>";
                        echo "<tr>";
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </body>
</html>
