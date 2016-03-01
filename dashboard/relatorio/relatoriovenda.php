<?php 
    include '../../conn/conexao.php';
    include '../../controle/relatorioControle.php';
    
    $banco = new Banco();
    $banco->conectaBanco();
    
    $r = new relatorioControle();
    
    $dataInicio = $_POST['inicio'];
    $dataFim    = $_POST['fim'];
    $venda =   $r->relatorioVenda($dataInicio, $dataFim);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Relatório de Venda</title>
        <link rel="stylesheet" type="text/css" href="../../css/pagina.css" />
    </head>
    <body>
        <div id="relatorio">
            <div class="header-relatorio">
                <img src="../../img/logo.gif" />
                <p><strong>Telefone p/ contato:</strong> (11) 99111-5555</p>
            </div>
            <h4>Periodo de: <?php echo date_format(date_create($dataInicio), 'd/m/Y') ?> á <?php echo date_format(date_create($dataFim), 'd/m/Y') ?></h4>
            <h1>Relatório de Venda</h1>
            <?php
                foreach($venda as $e){
                    echo " <div>";
                    echo "<h2>Cliente: ".$e['nome']."<span>".date_format(date_create($e['dataVenda']), 'd/m/Y')."</span></h2>";
                    echo "<h3>Codigo da venda: ".$e['idVenda']." </h3>";
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
                    foreach($r->relatorioItensVenda($e['idVenda']) as $v){
                        echo "
                                <tr>
                                    <td>".$v['nomeProduto']."</td>
                                    <td>".$v['quantidade']."</td>
                                    <td></td>
                                    <td>R$ ".number_format($v['valorUnProd'], 2, ',', '.')."</td>
                                    <td>R$ ".number_format($total = $v['valorUnProd'] * $v['quantidade'], 2, ',', '.')."</td>
                                </tr>                        
                        ";  
                        $totalItem = $totalItem + $total;
                        $valortotal += $total;
                        $geral = $geral + $totalItem;
                        $totalProd = $totalProd + $v['quantidade'];
                        $totalItem = 0;
                    }
                    echo "
                        <table width='100%' cellpadding='0' cellspacing='0'>
                            <tr>
                                <th colspan='2'>Nome Serviço</th>
                                <th>Tempo de Reparo</th>
                                <th>Preço do serviço</th>
                            </tr>
                        ";
                    foreach($r->relatorioItensServico($e['idVenda']) as $s){
                        echo "
                                <tr>
                                    <td  colspan='2'>".$s['nomeServico']."</td>
                                    <td>".$s['tempoReparo']."</td>
                                    <td>R$ ".number_format($s['precoServico'], 2, ',', '.')."</td>
                                </tr>                        
                        ";
                        $totalservico = $totalservico + $s['precoServico'];
                        $valortotal = $valortotal + $totalservico;
                        $geral = $geral + $totalservico;
                        $totalservico = 0;
                    }
                    
                    
                    $geraldesconto = $geraldesconto + $e['desconto'];
                    echo "
                        <tr >
                            <td  colspan='2' class='totaltabela'>Total da Venda ...........................................</td>
                            <td class='totaltabela'>R$ ".$e['desconto']."</td>
                            <td class='totaltabela'><strong>R$ ".number_format($valortotal - $e['desconto'], 2, ',', '.')."</strong></td>
                        <tr>
                        </table>
                    ";
                    $valortotal = 0;
                    echo "</div>";
                    $totalVenda ++;
                }
            ?>
            <fieldset class="resumo">
                <legend>Resumo Geral</legend>
                <dl>
                    <dt>Numero de Vendas:</dt>
                    <dd><?php echo $totalVenda ?></dd>
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
                    <dt>Valor total das vendas:</dt>
                    <dd>R$ <?php echo number_format($geral - $geraldesconto, 2, ',', '.') ?></dd>
                </dl>
            </fieldset>
            </div>
        </div>
    </body>
</html>
