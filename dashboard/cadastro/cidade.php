<?php
    include '../../conn/conexao.php';
    include '../../classe/Cidade.php';
    include '../../controle/cidadeControle.php';
    include '../../classe/Estado.php';
    include '../../controle/estadoControle.php';
    include '../../classe/Pessoa.php';
    include '../../controle/pessoaControle.php';
    
    $banco = new Banco();
    $banco->conectaBanco();
    
    
    
    $remove = (int)$_GET['remover'];
    $editar = (int)$_GET['editar'];
    $update = $_GET['acao'];
    
    $selecionaCidade = new cidadeControle();
    
    
    if(!empty($_POST)){
        $cidade['nome']     = $_POST['cidade'];
        $cidade['estado']   = $_POST['estado'];
        if($update != 'salvar'){
            $salvaCidade = new cidadeControle($cidade);
        } else {
            $selecionaCidade->editarCidade($cidade['nome'], $cidade['estado'], $editar);
        }
    }
    if(!empty($remove)){
        $removerCidade = new cidadeControle();
        $removerCidade->removerCidade($remove);
    }
    if(!empty($editar)){
        $cid = $selecionaCidade->recuperaCidade($editar);
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
        <title>Cadastro de Cidade</title>
        <link rel="stylesheet" type="text/css" href="../../css/pagina.css" />
        <script src="../../js/jquery-1.11.3.min.js"></script>
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
                <form method="post" action="<?php  echo !empty($editar) ? $_SERVER['PHP_SELF'].'?acao=salvar&editar='.$cid['idCidade'] : $_SERVER['PHP_SELF'] ?>">
                    <h1>Cadastrara Cidade</h1>
                    <label id="inputmedio">
                        <p>Nome Cidade:</p>
                        <input value="<?php echo $cid['nomeCidade'] ?>" class="focus" type="text" name="cidade" autocomplete="off"/>
                    </label>
                    <label id="inputfull">
                        <p>Estado:</p>
                        <?php 
                        $selecionaEstado = new estadoControle();
                        if(!empty($selecionaEstado->listaEstado())){
                            echo "<select name='estado'>";
                            echo "<option disabled selected>Selecione para qual estado esta cidade pertence</option>";
                            foreach ($selecionaEstado->listaEstado() as $nomeEstado){
                                echo "<option value='".$nomeEstado['idEstado']."' ".  selecionaCombo($cid['idEstado'], $nomeEstado['idEstado'])." >";
                                echo $nomeEstado['nomeEstado'];
                                echo "</option>";
                            }
                            echo "</select>";
                        }
                        ?>
                    </label>
                    <input id="botaoinput" type="submit" value="Cadastrar" />
                </form>
            </div>
        </div>
        <div id="conteudo">
            <p class="migalha">Dashboard > Cadastro cidade</p>
            <h1>Cadastro de Cidade</h1>
            <p id="botao1" class="botaoregistro">Nova cidade</p>
            <table cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Cidade</th>
                        <th>Estado</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    if(count($selecionaCidade->listaCidades())){
                        foreach($selecionaCidade->listaCidades() as $c){
                            echo "<tr>";
                            echo "<td><a href=".'?codigo='.$c['idCidade'].">".$c['idCidade']."</a></td>";
                            echo "<td><a href=".'?codigo='.$c['idCidade'].">".$c['nomeCidade']."</a></td>";
                            echo "<td><a href=".'?codigo='.$c['idCidade'].">".$c['sigla']."</a></td>";
                            echo "<td width='5%'><a href=".'?editar='.$c['idCidade']." ><img src='../../img/icon/edit.gif' /></a></td>";
                            echo "<td width='5%'><a href=".'?remover='.$c['idCidade']." class='confirma'><img src='../../img/icon/remove.gif' /></a></td>";
                            echo "</tr>";
                        }
                    }
                ?>
                </tbody>
            </table>
        </div>
    </body>
</html>
