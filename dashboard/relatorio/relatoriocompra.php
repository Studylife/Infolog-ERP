<?php 
    include '../../conn/conexao.php';
    include '../../controle/relatorioControle.php';
    
    $banco = new Banco();
    $banco->conectaBanco();
    
    $r = new relatorioControle();
    
    $dataInicio = $_POST['inicio'];
    $dataFim    = $_POST['fim'];
    $compra =   $r->relatorioCompra($dataInicio, $dataFim);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Relatório de Compra</title>
        <link rel="stylesheet" type="text/css" href="../../css/pagina.css" />
    </head>
    <body>
        <div id="relatorio">
            <div class="header-relatorio">
                <img src="../../img/logo.gif" />
                <p><strong>Telefone p/ contato:</strong> (11) 99111-5555</p>
            </div>
            <h4>Periodo de: 19/10/2015 á 19/10/2015</h4>
            <h1>Relatório de Compra</h1>
            <?php
                foreach($compra as $e){
                    echo " <div>";
                    echo "<h2>Cliente: ".$e['nomeFantasia']."<span>".date_format(date_create($e['dataCompra']), 'd/m/Y')."</span></h2>";
                    echo "<h3>Produtos da Compra</h3>";
                    echo "<h5>Codigo da Compra: ".$e['idCompra']." </h5>";
                    echo "
                        <table width='100%' cellpadding='0' cellspacing='0'>
                            <tr>
                                <th>Nome Produto</th>
                                <th>Quantidade</th>
                                <th>desconto</th>
                                <th>Valor Unitario</th>
                                <th>Valor total</th>
                            </tr>
                        ";
                    foreach($r->relatorioItensCompra($e['idCompra']) as $v){
                        echo "
                                <tr>
                                    <td>".$v['nomeProduto']."</td>
                                    <td>".$v['quantidade']."</td>
                                    <td></td>
                                    <td>R$ ".$v['valorUn']."</td>
                                    <td>R$ ".$total = $v['valorUn'] * $v['quantidade']."</td>
                                </tr>                        
                        ";
                        $teste = $total;
                        $valortotal += $total - $e['desconto'];
                        $geral = $geral + $valortotal;
                        $geraldesconto = $geraldesconto + $e['desconto'];
                        $totalProd = $totalProd + $v['quantidade'];
                    }
                    echo "
                        <tr >
                            <td  colspan='2' class='totaltabela'>Total da Compra ...........................................</td>
                            <td class='totaltabela'>R$ ".$e['desconto']."</td>
                            <td class='totaltabela'></td>
                            <td class='totaltabela'><strong>R$ ".number_format($valortotal, 2, ',', '.')."</strong></td>
                        <tr>
                        </table>
                    ";
                    $valortotal = 0;
                    echo "</div>";
                    
                    $totalCompra ++;
                }
            ?>
            <fieldset class="resumo">
                <legend>Resumo Geral</legend>
                <dl>
                    <dt>Numero de Compras:</dt>
                    <dd><?php echo $totalCompra ?></dd>
                </dl>
                <dl>
                    <dt>Produtos vendidos:</dt>
                    <dd><?php echo $totalProd ?></dd>
                </dl>
                <dl>
                    <dt>Total de desconto:</dt>
                    <dd>R$ <?php echo number_format($geraldesconto, 2, ',', '.') ?></dd>
                </dl>
                <dl>
                    <dt>Valor total das Compras:</dt>
                    <dd>R$ <?php echo number_format($geral, 2, ',', '.') ?></dd>
                </dl>
            </fieldset>
            </div>
        </div>
    </body>
</html>
