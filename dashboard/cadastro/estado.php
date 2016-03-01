<?php
    include '../../conn/conexao.php';
    include '../../classe/Estado.php';
    include '../../controle/estadoControle.php';
    
    $banco = new Banco();
    $banco->conectaBanco();
        
    
    
    if(!empty($_POST)){
        $estado['nome']     = $_POST['estado'];
        $estado['sigla']    = $_POST['sigla'];
        
        $salvaEstado = new estadoControle($estado);       
    }
    //REMOVE ESTADO
    $remove = (int)$_GET['remover'];
    if(!empty($remove)){
        $removeEstado = new estadoControle();
        $removeEstado->removeEstado($remove);
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Cadastro de Estado</title>
        <link rel="stylesheet" type="text/css" href="../../css/pagina.css" />
        <script src="../../js/jquery-1.11.3.min.js"></script>
        <script src="../../js/menu.js"></script>
        <script src="../../js/formulario.js"></script>
    </head>
    <body>
        <?php include '../header.php'; ?>
        <?php include '../menu.html'; ?>
        <div id="formulario">
            <p class="fechar">X</p>
            <div class="conteudo-form">
                <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                    <h1>Cadastrar Estado</h1>
                    <label id="inputmedio">
                        <p>Nome Estado:</p>
                        <input class="focus" type="text" name="estado" autocomplete="off"/>
                    </label>
                    <label id="inputmini">
                        <p>Sigla:</p>
                        <input type="text" name="sigla" maxlength="2" autocomplete="off"/>
                    </label>
                    <input id="botaoinput" type="submit" value="Cadastrar" />
                </form>
            </div>
        </div>
        <div id="conteudo">
            <p class="migalha">Dashboard > Cadastro Estado</p>
            <h1>Cadastro de Estado</h1>
            <p id="botao1" class="botaoregistro">Novo Estado</p>
            <table cellspacing="0" cellpadding="0">
                <thead>
                        <tr>
                                <th>Codigo</th>
                                <th>Estado</th>
                                <th>Sigla</th>
                                <th></th>
                                <th></th>
                        </tr>
                </thead>
                <tbody>
                <?php
                $selecionaEstado = new estadoControle();
                if(count($selecionaEstado->listaEstado())){
                    foreach($selecionaEstado->listaEstado() as $e){
                        echo "<tr>";
                        echo "<td><a href=".'?codigo='.$e['idEstado'].">".$e['idEstado']."</a></td>";
                        echo "<td><a href=".'?codigo='.$e['idEstado'].">".$e['nomeEstado']."</a></td>";
                        echo "<td><a href=".'?codigo='.$e['idEstado'].">".$e['sigla']."</a></td>";
                        echo "<td width='5%'><a href=".'?codigo='.$c['idEstado']." class='confirma'><img src='../../img/icon/edit.gif' /></a></td>";
                        echo "<td width='5%'><a href=".'?remover='.$c['idEstado']." class='confirma'><img src='../../img/icon/remove.gif' /></a></td>";
                        echo "</tr>";
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </body>
</html>
