<?php 
    include '../../conn/conexao.php';
    include '../../controle/relatorioControle.php';
    
    $banco = new Banco();
    $banco->conectaBanco();
    
    $r = new relatorioControle();
    $produto =  $r->relatorioProduto();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Relatório de Produto</title>
        <link rel="stylesheet" type="text/css" href="../../css/pagina.css" />
    </head>
    <body>
        <div id="relatorio">
            <div class="header-relatorio">
                <img src="../../img/logo.gif" />
                <p><strong>Telefone p/ contato:</strong> (11) 99111-5555</p>
            </div>
            <h1>Relatório de Produto</h1>
            <table class="estoque" cellspacing="0" cellpadding="0">
                <tr>
                    <th>C. Barras</th>
                    <th>Produto</th>
                    <th>V. venda</th>
                    <th>Est. Min</th>
                    <th>Es. Atual</th>
                </tr>
                <?php
                foreach ($produto as $p){
                echo "
                <tr>
                    <td>".$p['codBarras']."</td>
                    <td>".$p['nomeProduto']."</td>
                    <td>R$ ".number_format($p['valorVenda'], 2, ',', '.')."</td>
                    <td>".$p['estoqueMin']."</td>
                    <td>".$p['estoqueProd']."</td>
                </tr>
                ";
                }
                ?>
            </table>
        </div>
    </body>
</html>
