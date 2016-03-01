<?php 
    include '../../conn/conexao.php';
    include '../../controle/relatorioControle.php';
    
    $banco = new Banco();
    $banco->conectaBanco();
    
    $r = new relatorioControle();
    
    $dataInicio = $_POST['inicio'];
    $dataFim    = $_POST['fim'];
    $venda  =   $r->relatorioVenda($dataInicio, $dataFim);
    $compra =   $r->relatorioCompra($dataInicio, $dataFim);
    $produto =  $r->relatorioProduto();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Relatório de Estoque</title>
        <link rel="stylesheet" type="text/css" href="../../css/pagina.css" />
    </head>
    <body>
        <div id="relatorio">
            <div class="header-relatorio">
                <img src="../../img/logo.gif" />
                <p><strong>Telefone p/ contato:</strong> (11) 99111-5555</p>
            </div>
            <h4>Periodo de: <?php echo date_format(date_create($dataInicio), 'd/m/Y') ?> á <?php echo date_format(date_create($dataFim), 'd/m/Y') ?></h4>
            <h1>Relatório de Estoque</h1>
            <table class="estoque" cellspacing="0" cellpadding="0">
                <tr>
                    <th>Produto</th>
                    <th>Un</th>
                    <th>T. Compra</th>
                    <th>T. Venda</th>
                    <th>Est. Min</th>
                    <th>Es. Periodo</th>
                    <th>Es. Atual</th>
                </tr>
            <?php 
                foreach($produto as $p){
                    foreach ($compra as $c){
                        foreach($r->relatorioItensCompra($c['idCompra']) as $ic){
                            if($p['idProduto'] == $ic['idProduto'] ){
                                $teC = $teC + $ic['quantidade'];
                            }
                        }
                    }
                    foreach ($venda as $v){
                        foreach($r->relatorioItensVenda($v['idVenda']) as $iv){
                            if($p['idProduto'] == $iv['idProduto'] ){
                                $teV = $teV + $iv['quantidade'];
                            }
                        }
                    }
                    $estoque = $teC - $teV;
                    echo "
                        <tr>
                            <td>".$p['idProduto']." - " .$p['nomeProduto']."</td>
                            <td>PC</td>
                            <td>".$teC."</td>
                            <td>".$teV."</td>
                            <td>".$p['estoqueMin']."</td>
                            <td><p>".$estoque."</p></td>
                            <td><p>".$p['estoqueProd']."</p></td>
                        </tr>
                    ";
                    $teC = 0;
                    $teV = 0;
                }
            ?>
            </table>
        </div>
    </body>
</html>
