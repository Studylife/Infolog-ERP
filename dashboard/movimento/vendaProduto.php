<!doctype html>
<?php
    include '../../conn/conexao.php';
    include '../../controle/vendaControle.php';
    include '../../classe/Produto.php';
    include '../../controle/produtoControle.php';
    include '../../controle/servicoControle.php';
    
    print_r($_SESSION['servico']);
    
    
    $banco = new Banco();
    $banco->conectaBanco();

    
    
    //ESTANCIA A CLASSE VENDA
    $v = new vendaControle();
    $selecionaServico = new servicoControle();

    include '../../controle/carrinhoControle.php';
    include './include/itenservico.php';
    
    //VERIFICA SE O PRODUTO ESTÁ NO ESTOQUE ANTES DE ADICIONAR NA LISTA
    if($_GET['acao'] == 'add'){
        $v->verificaEstoqueCarrinho($id, $_SESSION['carrinho'][$id]);
    }
    //SALVANDO A VENDA
    //RECEBE AS INFORMAÇÕES DA VENDA
    $venda['idPessoa']      = $_POST['idPessoa'];
    $venda['dataVenda']     = $_POST['dataVenda'];
    $venda['valorTotal']    = $_POST['valorTotal'];
    $venda['parcela']       = $_POST['parcela'];
    $venda['desconto']      = $_POST['desconto'];


    //SALVA A VENDA
    //VERIFICA SE O POST ESTÁ CHEIO E SALVA A VENDA
    if(!empty($_POST)){
        //SALVA A FUNÇAO DE VENDA
        $venda['idVenda'] 	= $v->salvarVenda($venda);
        
        //SALVA OS ITENS DA VENDA
        foreach($_SESSION['carrinho'] as $produto => $quant){
            

            //VERIFICA VALOR DO PRODUTO
            $sql = "SELECT * FROM produto WHERE idProduto = '$produto'";
            $consulta   = mysql_query($sql);
            $r  = mysql_fetch_assoc($consulta);

            $venda['idProduto']         = $produto;
            $venda['quantidade']	= $quant;
            $venda['valorUnProd']	= $r['valorVenda'];

            $v->salvarItensVenda($venda);
        }
        foreach($_SESSION['servico'] as $serv){
            
            
            //VERIFICA VALOR DO servico
            $servs = $selecionaServico->recuperaServico($serv);
            
            $venda['idServico']  = $serv;
            $venda['precoServico']  = $servs['precoServico'];
            
            $v->salvarItensServico($venda);
        }
    }
    //LISTA COD COMPRA
    $idVenda    = $_GET['cod'];
    $acao       = $_GET['acao'];
    
    
    //LISTA AS INFORMAÇÕES DA VENDA A PARTIR DE SEU CÓDIGO
    if($acao == 'listar'){
        $lv = $v->listarVendaCod($idVenda);
        $iv = $v->listaItensVenda($idVenda);
        $is = $v->listaItensServico($idVenda);
    }
    
    //FUNÇÃO QUE SELECIONA OS ITENS DO COMBO DE FORNECEDORES
    function selecionaCombo($id, $id2){
        if($id == $id2){
            return "selected";
        }
    }
    
?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Venda de Mercadorias</title>
        <link rel="stylesheet" type="text/css" href="../../css/pagina.css" />
        <script src="../../js/jquery-1.11.3.min.js"></script>
        <script src="../../js/mask.js"></script>
        <script src="../../js/menu.js"></script>
        <script>
            $(document).ready(function(){
                var acao        = '<?php echo $_GET['acao'] ?>';
                var cod         = '<?php echo $idVenda ?>'; 
                
                if(acao === 'add' || acao === 'del' || acao === 'addservico' || cod > 0){
                    $('#formulario').show();
                }
                if(cod > 0){
                    $('#botaoinput').hide();
                } else {
                    $('#botaoinput').show();
                }
                
                if(acao === 'listar'){
                    $('input, select').attr("disabled","disabled");
                    $('.additem').hide();
                } else {
                    $('input, select').removeAttr();
                    $('.additem').show();
                }
                
                var valorTotal  = $(".valortotal").text();
                var porcentagem = valorTotal*0.1;
                
                $("input").keyup(function(){
                    var desconto    = $("input[name='desconto']").val();
                    var total       = valorTotal - desconto.replace('.','').replace(',','.');
                    $(".valortotal").text(total.toFixed(2));
                    //verifica se o desconto atribuido é maior do que é permitido
                    if(desconto.replace('.','').replace(',','.') >= porcentagem){
                        $("input[name='desconto']").val('');
                        $(".valortotal").text(valorTotal.toFixed(2));
                        alert('O Desconto atribuido é maior do que o permitido');
                    }
                    //outras informações
                    var datacompra      = $("input[name='dataVenda']").val();
                    var datavencimento  = $("input[name='vencimento']").val();
                    var parcela         = $("select[name='parcela'] option:selected").text();
                    $('.datacompra').text(datacompra);
                    $('.vencimento').text(datavencimento);
                    $('.parcela').text(parcela);
                    $('.desconto').text(desconto);
                });
                
                $('.servico').hide();
                $('.menu-lista li').click(function(){
                    var cl = $(this).attr("class");
                    
                    //alert(cl);
                    if(cl === 'menu-produto'){
                        $('.produto').show();
                        $('.servico').hide();
                    }
                    if(cl === 'menu-servico'){
                        $('.servico').show();
                        $('.produto').hide();
                    }
                    
                });
                
            });
        </script>
        <script src="../../js/formulario.js"></script>
    </head>
    <body>
        <?php include '../header.php'; ?>
        <?php include '../menu.html'; ?>
        <div id="formulario">
            <div class="conteudo-form">
                <a href="vendaProduto.php"><p class="fechar">X</p></a>
                <!------------------------------------------>
                <!--          ITENS DO CARRINHO           -->
                <h1>Venda de Mercadorias</h1>
                <div id="menu-venda">
                    <ul class="menu-lista">
                        <li class="menu-produto">Produtos</li>
                        <li class="menu-servico">Serviços</li>
                    </ul>
                </div>
                <form method="GET" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                    <div class="produto">
                        <div class="additem">
                            <input type="hidden" name="acao" value="add" />
                            <label id="inputpequeno" class="float">
                                <p>Cod. de barras:</p>
                                <input class="focus" type="text" name="codbarras" autocomplete="off" autofocus/>
                            </label>
                            <label id="inputmedio" class="float">
                                <p>Produto:</p>
                                <?php 
                                $selecionaProduto = new produtoControle();
                                if(!empty($selecionaProduto->listaProduto())){
                                    echo "<select name='id'>";
                                    echo "<option disabled selected>Selecione um Produto</option>";
                                    foreach ($selecionaProduto->listaProduto() as $p){
                                        echo "<option value='".$p['idProduto']."'>".$p['nomeProduto']."</option>";
                                    }
                                    echo "</select>";
                                }
                                ?>
                            </label>
                            <label id="inputmini" class="float">
                                <p>Quantidade:</p>
                                <input type="text" value="1" name="quantidade" autocomplete="off"/>
                            </label>
                            <input id="botaoinput" class="float botaoadicionar" type="submit" value="Adicionar" />
                        </div>
                        <!--      FINALIZA ITENS DO CARRINHO      -->
                        <!------------------------------------------>
                        <!--      INICIA FORMULÁRIO DA COMPRA     -->
                        <fieldset>
                            <legend>Serviços realizados</legend>
                            <table cellpadding="0" cellspacing="0">
                                <thead>
                                    <tr>
                                        <tr>
                                            <th>Cod. Barras</th>
                                            <th>Descrição Produto</th>
                                            <th>Un</th>
                                            <th>Quant.</th>
                                            <th>Valor Un</th>
                                            <th>Valor total</th>
                                            <th></th>
                                        </tr>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if(empty($iv)){
                                        //INICIA LISTA DE PRODUTOS
                                        $total += listaItensCarrinho1();
                                        //FINALIZA LISTA DE PRODUTOS
                                    } else {
                                        //INICIA LISTA DE PRODUTOS
                                            foreach ($iv as $l){
                                                echo "<tr>"
                                                        . "<td>".$l['codBarras']."</td>"
                                                        . "<td>".$l['descProduto']."</td>"
                                                        . "<td>PC</td>"
                                                        . "<td>".$l['quantidade']."</td>"
                                                        . "<td>R$ ".number_format($l['valorUnProd'], '2',',','.')."</td>"
                                                        . "<td>R$ ".number_format($l['valorUnProd'] = $l['valorUnProd'] * $l['quantidade'], '2',',','.')."</td>"
                                                        . "<td><a href=''></a></td>"
                                                   . "</tr>";
                                            }
                                        //FINALIZA LISTA DE PRODUTOS
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </fieldset>
                    </div>
                </form>
                <!--      FINALIZA ITENS DO CARRINHO      -->
                <!------------------------------------------>
                <!--   INICIA FORMULÁRIO DE ITENS SERVIÇO -->
                <form method="GET" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                    <div class="servico">
                        <div class="addservico">
                            <input type="hidden" name="acao" value="addservico" />
                            <label id="inputfull" class="float">
                                <p>Serviço:</p>
                                <?php 
                                if(!empty($selecionaServico->listarServico())){
                                    echo "<select name='idservico'>";
                                    echo "<option disabled selected>Selecione um Produto</option>";
                                    foreach ($selecionaServico->listarServico() as $s){
                                        echo "<option value='".$s['idServico']."'>".$s['nomeServico']."</option>";
                                    }
                                    echo "</select>";
                                }
                                ?>
                            </label>
                            <input id="botaoinput" class="float botaoadicionar" type="submit" value="Adicionar" />
                        </div>
                        <fieldset>
                            <legend>Itens da compra</legend>
                            <table cellpadding="0" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th width="20%">Codigo</th>
                                        <th width="45%">Nome do serviço</th>
                                        <th width="15%">T. de Reparo</th>
                                        <th width="15%">Preço</th>
                                        <th width="5%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if(empty($is)){
                                            $total += listaItenServico();
                                        } else {
                                            foreach ($is as $ss){
                                                echo "<tr>"
                                                        . "<td>".$ss['idServico']."</td>"
                                                        . "<td>".$ss['nomeServico']."</td>"
                                                        . "<td>".$ss['tempoReparo']."</td>"
                                                        . "<td>R$ ".number_format($ss['precoServico'], 2,',','.')."</td>"
                                                        . "<td><a href=''></a></td>"
                                                   . "</tr>";
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </fieldset>
                    </div>
                </form>
                <form  method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                    <label id="inputpequeno" class="float">
                        <p>Data Venda</p>
                        <input value="<?php echo $lv['dataVenda'] ?>" type="date" name="dataVenda" required/>
                    </label>
                    <label id="inputgrande" class="float">
                        <p>Cliente:</p>
                        <select name="idPessoa">
                            <option disabled selected>Selecione um Cliente</option>
                                <?php 
                                foreach($v->listaPessoa() as $pessoa){
                                    echo "<option value='".$pessoa['idPessoa']."' ". selecionaCombo($lv['idPessoa'], $pessoa['idPessoa']).">".$pessoa['nome']."</option>";
                                }
                                ?>
                        </select>
                    </label>
                    <div class="dividetela">
                        <label id="inputpequeno">
                            <p>Desconto:</p>
                            <input value="<?php echo $lv['desconto'] ?>" type="text" class="desconto dinheiro" name="desconto" maxlength="7" autocomplete="off"/>
                        </label>
                        <label id="inputmini" class="float">
                            <p>Parcelas:</p>
                            <select name="parcela" required>
                                <option value="1" selected>01</option>
                            </select>
                        </label>
                        <label id="inputpequeno" class="float">
                            <p>Vencimento:</p>
                            <input value="<?php echo $lv['vencimento'] ?>" type="date" name="vencimento" value="" autocomplete="off" required/>
                        </label>
                    </div>
                    <div class="infocompra">
                        <h3>informações da Venda</h3>
                        <p>Operador: Jefferson Miranda</p>
                        <p>Data da Venda: <span class="datacompra"><?php echo date_format(date_create($lv['dataVenda']), 'd/m/Y'); ?></span></p>
                        <p>Parcelas: <span class="parcela"><?php echo $lv['numeroParcelas']; ?></span></p>
                        <p>Vencimento: <span class="vencimento"><?php echo date("d-m-Y") ?></span></p>
                        <p>Desconto: R$ <span class="desconto"><?php echo $lv['desconto']; ?></span></p>
                        <h2>Total da fatura: R$ <span class="valortotal"><?php echo empty($total) ? $lv['valorTotal'] : $total; ?></span></h2>
                    </div>
                    <input type="hidden" value="<?php echo $total ?>" name="valorTotal"/>
                    <input id="botaoinput" class="additem" type="submit" value="Cadastrar" />
                </form>
                <!--      FINALIZA FORMULÁRIO DA COMPRA   -->
                <!------------------------------------------>
            </div>
        </div>
        <div id="conteudo">
            <p class="migalha">Dashboard > Cadastro Produto</p>
            <h1>Venda de Mercadorias</h1>
            <p id="botao1" class="botaoregistro">Novo Venda</p>
            <table cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Data Venda</th>
                        <th>Cliente</th>
                        <th>Valor Venda</th>
                        <th>Desconto</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    foreach($v->listaVenda() as $v){
                        echo "<tr>";
                        echo "<td><a href='?cod=".$v['idVenda']."&acao=listar'>".$v['idVenda']."</a></td>";
                        echo "<td><a href='?cod=".$v['idVenda']."&acao=listar'>".date_format(date_create($v['dataVenda']), 'd/m/Y')."</a></td>";
                        echo "<td><a href='?cod=".$v['idVenda']."&acao=listar'>".$v['nome']."</a></td>";
                        echo "<td><a href='?cod=".$v['idVenda']."&acao=listar'>R$: ".number_format($v['valorTotal'], 2, ',', '.')."</a></td>";
                        echo "<td><a href='?cod=".$v['idVenda']."&acao=listar'>R$: ".number_format($v['desconto'], 2, ',', '.')."</a></td>";
                        echo "<td><a href='?cod=".$v['idVenda']."&acao=listar'></a></td>";
                        echo "</tr>";
                    }
                ?>
                </tbody>
            </table>
        </div>
    </body>
</html>