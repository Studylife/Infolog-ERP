<?php 
    include '../../conn/conexao.php';
    include '../../controle/relatorioControle.php';
    
    $banco = new Banco();
    $banco->conectaBanco();
    
    $r = new relatorioControle();
    $serv =  $r->relatorioServico();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Relatório de Servico</title>
        <link rel="stylesheet" type="text/css" href="../../css/pagina.css" />
    </head>
    <body>
        <div id="relatorio">
            <div class="header-relatorio">
                <img src="../../img/logo.gif" />
                <p><strong>Telefone p/ contato:</strong> (11) 99111-5555</p>
            </div>
            <h1>Relatório de Servico</h1>
            <table class="estoque" cellspacing="0" cellpadding="0">
                <tr>
                    <th>Codigo</th>
                    <th>Serviço</th>
                    <th>Tempo de Reparo</th>
                    <th>Preço</th>
                </tr>
                <?php
                foreach ($serv as $p){
                echo "
                <tr>
                    <td>".$p['idServico']."</td>
                    <td>".$p['nomeServico']."</td>
                    <td>".$p['tempoReparo']."</td>
                    <td>R$ ".number_format($p['precoServico'], 2, ',', '.')."</td>
                </tr>
                ";
                }
                ?>
            </table>
        </div>
    </body>
</html>
