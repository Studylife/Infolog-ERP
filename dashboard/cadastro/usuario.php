<?php
    include '../../conn/conexao.php';
    include '../../classe/PessoaFisica.php';
    include '../../controle/pessoaControle.php';
    include '../../controle/pessoaFisicaControle.php';
    include '../../controle/usuarioSistemaControle.php';
    
    $banco = new Banco();
    $banco->conectaBanco();
    
    
    $p = new pessoaFisicaControle();
    $u = new usuarioSistemaControle();
    
    if(!empty($_POST)){
        $usuario['pessoa']  = $_POST['pessoa'];
        $usuario['login']   = $_POST['login'];
        $usuario['senha']   = $_POST['senha'];
        $usuario['inicio']  = date('Y-m-d H:i:s', $_POST['inicio']);
        $usuario['fim']     = date('Y-m-d H:i:s', $_POST['fim']);
        $usuario['obs']     = $_POST['obs'];
        
        
        //VERIFICA PARA FAZER UPDATE
        if($update != 'salvar'){
            $u->salvarUsuario($usuario);
        } else {
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
                    <h1>Cadastro de Usuarios do Sistema</h1>
                    <label id="inputgrande">
                        <p>Nome do Funcionário:</p>
                        <select name="pessoa">
                            <option selected disabled>Selecione um funcionário</option>
                            <?php 
                                foreach($p->listaPessoaFisica() as $pf){
                                    echo "<option value='".$pf['idPFisica']."'>" . $pf['nome'] . "</option>";
                                }
                            ?>
                        </select>
                    </label>
                    <label id="inputpequeno" class="float">
                        <p>Login:</p>
                        <input value="<?php echo $cid['nomeCidade'] ?>" type="text" name="login" autocomplete="off"/>
                    </label>
                    <label id="inputpequeno" class="float">
                        <p>Senha:</p>
                        <input value="<?php echo $cid['nomeCidade'] ?>" type="password" name="senha" autocomplete="off"/>
                    </label>
                    <div>
                        <label id="inputpequeno" class="float">
                            <p>Hora Inicio:</p>
                            <input value="<?php echo $cid['nomeCidade'] ?>" type="time" name="inicio" autocomplete="off"/>
                        </label>
                        <label id="inputpequeno" class="float">
                            <p>Hora Fim:</p>
                            <input value="<?php echo $cid['nomeCidade'] ?>" type="time" name="fim" autocomplete="off"/>
                        </label>
                    </div>
                    <label id="inputfull">
                        <p>Observações:</p>
                        <textarea name="obs"></textarea>
                    </label>
                    <input id="botaoinput" type="submit" value="Cadastrar" />
                </form>
            </div>
        </div>
        <div id="conteudo">
            <p class="migalha">Dashboard > Cadastro cidade</p>
            <h1>Cadastro de Usuarios do Sistema</h1>
            <p id="botao1" class="botaoregistro">Novo usuario</p>
            <table cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th>Funcionario</th>
                        <th>Login</th>
                        <th>Hora inicio</th>
                        <th>Hora inicio</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    if(count($u->listaUsuario())){
                        foreach($u->listaUsuario() as $c){
                            echo "<tr>";
                            echo "<td><a href=".'?codigo='.$c['idCidade'].">".$c['nome']."</a></td>";
                            echo "<td><a href=".'?codigo='.$c['idCidade'].">".$c['login']."</a></td>";
                            echo "<td><a href=".'?codigo='.$c['idCidade'].">".  date('H:i:s', time())."</a></td>";
                            echo "<td><a href=".'?codigo='.$c['idCidade'].">".date('H:i:s', time())."</a></td>";
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
