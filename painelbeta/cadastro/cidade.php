<!DOCTYPE html>
//<?php
//    include '../../conn/conexao.php';
//    include '../../classe/Estado.php';
//    include '../../classe/Cidade.php';
//    include '../../controle/estadoControle.php';
//    include '../../controle/cidadeControle.php';
//    
//    $banco = new Banco();
//    $banco->conectaBanco();
//    
//    if(!empty($_POST)){
//        $cidade['nome']     = $_POST['cidade'];
//        $cidade['estado']   = $_POST['estado'];
//        
//        $salvaCidade = new cidadeControle($cidade);
//    }
//?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Cadastro de Cidade</title>
        <link type="text/css" rel="stylesheet" href="../../css/geral.css" />
        <script src="../../js/jquery-1.11.3.min.js"></script>
        <script src="../../js/menu.js"></script>
        <script src="../../js/formulario.js"></script>
    </head>
    <body>
        <div id="header">
            <p class="botao-menu">Menu</p>
            <p class="logo">InfoLog</p>
        </div>
        <div id="formulario">
            <p class="fechar">X</p>
            <div>
            <h1>Cadastraraaa Cidade</h1>
            <h4>Preencha o formulário abaixo para cadastrar uma nova Cidade</h4>
                <form>
                    <label id="inputpequeno">
                        <p>Nome Cidade:</p>
                        <input type="text"/>
                    </label>
                    <label>
                        <p>Estado:</p>
                        <select>
                            <option>Selecione para qual estado esta cidade pertence</option>
                            <option>Paraná</option>
                            <option>São Paulo</option>
                        </select>
                    </label>
                    <div class="botoes">
                    <input id="botaosalvar" type="submit" value="Salvar" />
                    </div>
                </form>
            </div>
        </div>
        <div id="menu">
            <p class="fechar">X</p>
            <div>
                <h1>Menu</h1>
            </div>
            <ul>
                <li><a href="#">Teste 1</a></li>
                <li><a href="#">Teste 1</a></li>
                <li><a href="#">Teste 1</a></li>
                <li><a href="#">Teste 1</a></li>
                <li><a href="#">Teste 1</a></li>
                <li><a href="#">Teste 1</a></li>
            </ul>
        </div>
        <div id="conteudo">
            <div class="lista">
                <h1>Cadastro de Cidade</h1>
                <p id="botao1" class="botaoregistro">Cadastro</p>
                <div class="filtro"></div>
                <table class="tabela" cellspacing="0" cellpadding="0">
			<thead>
				<tr>
					<th>Cidade</th>
					<th>Estado</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
            <?php
//            $selecionaCidade = new cidadeControle();
//                if(count($selecionaCidade->listaCidades())){
//                    foreach($selecionaCidade->listaCidades() as $c){
//                        echo "<tr>";
//                        echo "<td>".$c['nomeCidade']."</td>";
//                        echo "<td>".$c['sigla']."</td>";
//                        echo "<td>Editar</td>";
//                        echo "<td>Excluir</td>";
//                        echo "</tr>";
//                    }
//                }
            ?>
			</tbody>
                </table>
            </div>
        </div>
        <div id="foot"></div>
    </body>
</html>
