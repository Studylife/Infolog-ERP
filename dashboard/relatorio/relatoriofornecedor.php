<?php 
    include '../../conn/conexao.php';
    include '../../controle/relatorioControle.php';
    
    $banco = new Banco();
    $banco->conectaBanco();
    
    $r = new relatorioControle();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Relatório de Cliente</title>
        <link rel="stylesheet" type="text/css" href="../../css/pagina.css" />
    </head>
    <body>
        <div id="relatorio">
            <div class="header-relatorio">
                <img src="../../img/logo.gif" />
                <p><strong>Telefone p/ contato:</strong> (11) 99111-5555</p>
            </div>
            <h1>Relatório de Fornecedor</h1>
            <?php
            foreach($r->relatorioFornecedor() as $c){
                echo "<h2>".$c['nome']."</h2>";
                echo "<h3>Informações pessoais</h3>";
                echo "
                    <dl>
                        <dt>CNPJ:</dt>
                        <dd>".$c['CNPJ']."</dd>
                    </dl>
                    <dl>
                        <dt>Email:</dt>
                        <dd>".$c['email']."</dd>
                    </dl>
                    <dl>
                        <dt>Telefone:</dt>
                        <dd>".$c['telefone']."</dd>
                    </dl>
                    <h3>Informações pessoais</h3>
                    <dl>
                        <dt>CEP:</dt>
                        <dd>".$c['cep']."</dd>
                    </dl>
                    <dl>
                        <dt>Rua:</dt>
                        <dd>".$c['rua']."</dd>
                        <dt><span></span>Nº:</dt>
                        <dd>".$c['numeroCasa']."</dd>
                    </dl>
                    <dl>
                        <dt>Bairro:</dt>
                        <dd>".$c['bairro']."</dd>
                    </dl>
                ";
            }
//                foreach($cidade->relatorioEstado() as $e){
//                    echo "<h2>" . $e['nomeEstado']. " - " .$e['sigla']. "</h2>";
//                    foreach ($cidade->relatorioCidade() as $c){
//                        if($e['idEstado'] == $c['idEstado']){
//                            echo "<p>" . $c['nomeCidade']. "</p>";
//                        }
//                    }
//                    echo '<br /><br />';
//                }
            ?>
        </div>
    </body>
</html>
