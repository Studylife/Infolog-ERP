<?php 
    include '../conn/conexao.php';
    include '../controle/loginControle.php';
    include '../classe/Produto.php';
    include '../controle/produtoControle.php';
    include '../controle/vendaControle.php';
    include '../classe/Compra.php';
    include '../controle/compraControle.php';
    include '../classe/Pessoa.php';
    include '../controle/pessoaControle.php';

    $banco = new Banco();
    $banco->conectaBanco();
    
    $produto    = new produtoControle();
    $venda      = new vendaControle();
    $compra     = new compraControle();
    $cliente    = new pessoaControle();
    $Rv         = $venda->totalVendas();
    $Rc         = $compra->contaCompra();
    $Cl         = $cliente->contaPessoa();
    
    include './include/logar.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Dashboard - Pagina Principal</title>
        <link rel="stylesheet" type="text/css" href="../css/pagina.css" />
        <script src="../js/jquery-1.11.3.min.js"></script>
        <script src="../js/menu.js"></script>
    </head>
    <body>
        <div id="header">
            <p class="menu"><img src="../img/menuresponsivo.gif" /></p>
            <div class="logo"><img src="../img/logo.gif" /></div>
        </div>
        <div id="menu">
            <p class="fechar">X</p>
            <ul>
                <li>
                    <a href="index.php">Dashboard</a>
                </li>
                <li>
                    <a href="#">Cadastro</a>
                    <ul>
                        <li><a href="cadastro/estado.php">Estado</a></li>
                        <li><a href="cadastro/cidade.php">Cidade</a></li>
                        <li><a href="cadastro/pessoafisica.php">Cliente</a></li>
                        <li><a href="cadastro/pessoajuridica.php">Empresa</a></li>
                        <li><a href="cadastro/produto.php">Produto</a></li>
                        <li><a href="cadastro/servico.php">Serviço</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">Movimento</a>
                    <ul>
                        <li><a href="movimento/compraProduto.php">Compra</a></li>
                        <li><a href="movimento/vendaProduto.php">Venda</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">Relatório</a>
                    <ul>
                        <li><a href="relatorio/relatoriocidade.php" target="_blank">Estado e Cidade</a></li>
                        <li><a href="relatorio/relatoriopessoa.php" target="_blank">Cliente</a></li>
                        <li><a href="relatorio/relatoriofornecedor.php" target="_blank">Fornecedor</a></li>
                        <li><a href="relatorio/relatorioproduto.php" target="_blank">Produto</a></li>
                        <li><a href="relatorio/relatorioservico.php" target="_blank">Serviço</a></li>
                        <li><a href="javascript:void(window.open('relatorio/compraperiodo.php','','width=500,height=250,left=0,top=0,resizable=yes,menubar=no,location=no,status=yes,scrollbars=yes'))" target="_blank">Compra</a></li>
                        <li><a href="javascript:void(window.open('relatorio/vendaperiodo.php','','width=500,height=250,left=0,top=0,resizable=yes,menubar=no,location=no,status=yes,scrollbars=yes'))" target="_blank">venda</a></li>
                        <li><a href="javascript:void(window.open('relatorio/estoqueperiodo.php','','width=500,height=250,left=0,top=0,resizable=yes,menubar=no,location=no,status=yes,scrollbars=yes'))" target="_blank">Estoque</a></li>
                    </ul>
                </li>
                <li><a href="cadastro/usuario.php">Usuários Sistema</a></li>
                <li><a href="#">Configurações</a></li>
            </ul>
        </div>
        <div id="conteudo">
            <p class="migalha">Dashboard</p>
            <div class="resumo">
                <dl>
                    <dt>
                        <img src="../img/icon-guia-compras.png" />
                        <p>Numero de Compras</p>
                    </dt>
                    <dd><h1><?php echo $Rc[0]['Compra']; ?></h1></dd>
                </dl>
                <dl>
                    <dt>
                        <img src="../img/icon-financas.png" />
                        <p>Numero de Vendas</p>
                    </dt>
                    <dd><h1><?php echo $Rv[0]['vendas']; ?></h1></dd>
                </dl>
                <dl>
                    <dt>
                        <img src="../img/money_icon.png" />
                        <p>Total Arrecadado</p>
                    </dt>
                    <dd><h1>R$ <?php echo $Rv[0]['valor']; ?></h1></dd>
                </dl>
                <dl>
                    <dt>
                    <img src="../img/edcational-services.png" />
                        <p>Total de Clientes</p>
                    </dt>
                    <dd><h1><?php echo $Cl[0]['cliente']; ?></h1></dd>
                </dl>
            </div>
            <div class="lista-dashboard">
                <h2>Ultimas Vendas</h2>
                <table cellpaddin="0" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="20%">D. Venda</th>
                            <th width="60%">Cliente</th>
                            <th width="20%">Quantia Gasta</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        foreach ($venda->listaDashBoard() as $v){
                            echo "<tr>";
                                echo "<td>".$v['dataVenda']."</td>";
                                echo "<td>".$v['nome']."</td>";
                                echo "<td>R$ ".$v['valorTotal']."</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="lista-dashboard">
                <h2>Estoque</h2>
                <table cellpaddin="0" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="15%">C. Barras</th>
                            <th width="60%">Nome Produto</th>
                            <th width="25%">Q. Estoque</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        foreach ($produto->listaDashboard() as $p){
                            echo "<tr>";
                                echo "<td>".$p['codBarras']."</td>";
                                echo "<td>".$p['nomeProduto']."</td>";
                                echo "<td>".$p['estoqueProd']."</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>
