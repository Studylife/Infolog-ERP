<?php 
    include '../../conn/conexao.php';
    include '../../controle/relatorioControle.php';
    
    $banco = new Banco();
    $banco->conectaBanco();
    
    $cidade = new relatorioControle();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Relatório de Estado e Cidade</title>
        <link rel="stylesheet" type="text/css" href="../../css/pagina.css" />
    </head>
    <body>
        <div id="relatorio">
            <div class="header-relatorio">
                <img src="../../img/logo.gif" />
                <p><strong>Telefone p/ contato:</strong> (11) 99111-5555</p>
            </div>
            <h1>Relatório de Estado e Cidade</h1>
            <?php
                foreach($cidade->relatorioEstado() as $e){
                    echo "<h2>" . $e['nomeEstado']. " - " .$e['sigla']. "</h2>";
                    foreach ($cidade->relatorioCidade() as $c){
                        if($e['idEstado'] == $c['idEstado']){
                            echo "<p>" . $c['nomeCidade']. "</p>";
                        }
                    }
                    echo '<br /><br />';
                }
            ?>
        </div>
    </body>
</html>
