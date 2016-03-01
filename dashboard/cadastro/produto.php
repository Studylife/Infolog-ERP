<?php
    include '../../conn/conexao.php';
    include '../../classe/Produto.php';
    include '../../controle/produtoControle.php';
    
    $banco = new Banco();
    $banco->conectaBanco();
    
    
    
    if(!empty($_POST)){
        $produto['codbarras']       = $_POST['codbarras'];
        $produto['nomeproduto']     = $_POST['nomeproduto'];
        $produto['valor']           = str_replace(',', '.', str_replace('.', '', $_POST['valor']));
        $produto['estoque']         = $_POST['estoque'];
        $produto['descrproduto']    = $_POST['descrproduto'];
        $produto['grupo']           = $_POST['grupo'];
        $produto['unmedida']        = $_POST['unmedida'];
        
        $salvaproduto = new produtoControle($produto);
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Cadastro de Produto</title>
        <link rel="stylesheet" type="text/css" href="../../css/pagina.css" />
        <script src="../../js/jquery-1.11.3.min.js"></script>
        <script src="../../js/mask.js"></script>
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
                    <h1>Cadastrar Produto</h1>
                    <label id="inputpequeno">
                        <p>Codigo de barras:</p>
                        <input class="focus" type="text" name="codbarras" autocomplete="off" required/>
                    </label>
                    <label id="inputgrande">
                        <p>Nome Produto:</p>
                        <input type="text" name="nomeproduto" autocomplete="off" required/>
                    </label>
                    <label id="inputgrande">
                        <p>Descrição do Produto:</p>
                        <input type="text" name="descrproduto" autocomplete="off" required/>
                    </label>
                    <label id="inputpequeno">
                        <p>Valor para venda:</p>
                        <input class="dinheiro" type="text" name="valor" autocomplete="off" required/>
                    </label>
                    <label id="inputmini">
                        <p>Estoque minimo:</p>
                        <input type="text" name="estoque" autocomplete="off" required/>
                    </label>
                    <label id="inputpequeno">
                        <p>Grupo:</p>
                        <input type="text" name="grupo" autocomplete="off" required/>
                    </label>
                    <label id="inputpequeno">
                        <p>Un. Medida:</p>
                        <input type="text" name="unmedida" autocomplete="off" required/>
                    </label>
                    <input id="botaoinput" type="submit" value="Cadastrar" />
                </form>
            </div>
        </div>
        <div id="conteudo">
            <p class="migalha">Dashboard > Cadastro Produto</p>
            <h1>Cadastro de Produto</h1>
            <p id="botao1" class="botaoregistro">Novo Produto</p>
            <table cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Cod. Barras</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Valor de Venda</th>
                        <th>Est. minimo</th>
                        <th>Estoque</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $listaProduto = new produtoControle();
                    if(count($listaProduto->listaProduto())){
                        foreach($listaProduto->listaProduto() as $p){
                            echo "<tr>";
                            echo "<td><a href=''>".$p['idProduto']."</a></td>";
                            echo "<td><a href=''>".$p['codBarras']."</a></td>";
                            echo "<td><a href=''>".$p['nomeProduto']."</a></td>";
                            echo "<td><a href=''>".$p['descProduto']."</a></td>";
                            echo "<td><a href=''>R$ ".number_format($p['valorVenda'], 2, ',', '.')."</a></td>";
                            echo "<td><a href=''>".$p['estoqueMin']."</a></td>";
                            echo "<td><a href=''>".$p['estoqueProd']."</a></td>";
                            echo "</tr>";
                        }
                    }
                ?>
                </tbody>
            </table>
        </div>
    </body>
</html>
