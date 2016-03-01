<?php
    include '../../conn/conexao.php';
    include '../../classe/Produto.php';
    include '../../controle/produtoControle.php';
    include '../../controle/pessoaControle.php';
    include '../../classe/PessoaJuridica.php';
    include '../../controle/pessoaJuridicaControle.php';
    include '../../classe/Compra.php';
    include '../../controle/compraControle.php';
    include '../../classe/ItensCompra.php';
    include '../../controle/itensCompraControle.php';
    
    $banco = new Banco();
    $banco->conectaBanco();
    
    
    
    
    
    //CADASTRAR COMPRA
    $compra['dataCompra']   = $_POST['datacompra'];
    $compra['fornecedor']   = $_POST['fornecedor'];
    $compra['totalCompra']   = $_POST['totalCompra'];
    $compra['desconto']     = $_POST['desconto'];
    $compra['parcela']      = $_POST['parcela'];
    $compra['vencimento']   = $_POST['vencimento'];
    
    
    //SALVANDO A COMPRA
    $comprar = new compraControle($compra);
    
    //INCLUI O CARRINHO DE COMPRAS
    include '../../controle/carrinhoControle.php';
    
    //RECUPERA O ID DA COMPRA
    $compra['idcompra'] = mysql_insert_id();
    
    //SALVA ITENS COMPRA
    foreach($_SESSION['carrinho'] as $iditens => $quant){
        $sql = "SELECT * FROM produto WHERE idProduto = '$iditens'";
        $consulta   = mysql_query($sql);
        $r  = mysql_fetch_assoc($consulta);
        
        $compra['idItem']   = $iditens;
        $compra['valorUn']  = $r['valorVenda'];
        $compra['quant']    = $quant;
        
        $itenscompra = new itensCompraControle($compra);
    }
    
    
    
    //LISTA COD COMPRA
    $idCompra   = $_GET['cod'];
    $acao       = $_GET['acao'];
    
    if($acao == 'listar'){
        $lc = $comprar->listarCompraCod($idCompra);
        $lp = $comprar->listaItensCompra($idCompra);
    }
    
    //FUNÇÃO QUE SELECIONA OS ITENS DO COMBO DE FORNECEDORES
    function selecionaCombo($id, $id2){
        if($id == $id2){
            return "selected";
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Compra de Mercadorias</title>
        <link rel="stylesheet" type="text/css" href="../../css/pagina.css" />
        <script src="../../js/jquery-1.11.3.min.js"></script>
        <script src="../../js/mask.js"></script>
        <script src="../../js/menu.js"></script>
        <script>
            $(document).ready(function(){
                var acao        = '<?php echo $_GET['acao'] ?>';
                var cod         = '<?php echo $idCompra ?>'; 
                
                if(acao === 'add' || acao === 'del' || cod > 0){
                    $('#formulario').show();
                }
                if(cod > 0){
                    $('#botaoinput').hide();
                } else {
                    $('#botaoinput').show();
                }
                
                if(acao === 'listar'){
                    $('input, select').attr("disabled","disabled");
                } else {
                    $('input, select').removeAttr();
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
                    var datacompra      = $("input[name='datacompra']").val();
                    var datavencimento  = $("input[name='vencimento']").val();
                    var parcela         = $("select[name='parcela'] option:selected").text();
                    $('.datacompra').text(datacompra);
                    $('.vencimento').text(datavencimento);
                    $('.parcela').text(parcela);
                    $('.desconto').text(desconto);
                    
                });
            });
        </script>
        <script src="../../js/formulario.js"></script>
    </head>
    <body>
        <?php include '../header.php'; ?>
        <?php include '../menu.html'; ?>
        <div id="formulario">
            <a href="compraProduto.php"><p class="fechar">X</p></a>
            <div class="conteudo-form">
                <form method="GET" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                    <h1>Compra de Mercadorias</h1>
                    <?php 
                    //INCLUI A OPÇÃO DE ADICIONAR ITENS SE FOR UM NOVO ITEM
                    if(empty($lp)){include './include/additemcarrinho.php';}     
                    ?>
                </form>
                <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                    <input type="hidden" name="acao" value="salvar"/>
                    <fieldset>
                        <legend>Itens da compra</legend>
                        <table cellpadding="0" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Cod. Barras</th>
                                    <th>Descrição Produto</th>
                                    <th>Un</th>
                                    <th>Quant.</th>
                                    <th>Valor Un</th>
                                    <th>Valor total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if(empty($lp)){
                                    //INICIA LISTA DE PRODUTOS
                                    $total = listaItensCarrinho1();
                                    //FINALIZA LISTA DE PRODUTOS
                                } else {
                                    //INICIA LISTA DE PRODUTOS
                                    listaItenscarrinho2($lp);
                                    //FINALIZA LISTA DE PRODUTOS
                                }
                                ?>
                            </tbody>
                        </table>
                    </fieldset>
                    <label id="inputpequeno" class="float">
                        <p>Data Compra:</p>
                        <input type="date" name="datacompra" value="<?php echo $lc['dataCompra']; ?>" autocomplete="off" <?php echo $acao == 'listar' ? 'disabled' : '' ; ?> required/>
                    </label>
                    <label id="inputgrande" class="float">
                        <p>Fornecedor:</p>
                        <?php
                            //INICIA LISTA COMBO PESSOA JURIDICA
                            $selecionaEmpresa = new pessoaJuridicaControle();
                            echo "<select name='fornecedor'>";
                            echo "<option disabled selected>Selecione uma Empresa</option>";
                            foreach ($selecionaEmpresa->listaPessoaJuridica() as $e){
                                echo "<option value='".$e['idPJuridica']."' ".  selecionaCombo($lc['idPJuridica'], $e['idPJuridica']).">".$e['nomeFantasia']."</option>";
                            }
                            echo "</select>";
                            //FINALIZA LISTA COMBO PESSOA JURIDICA
                        ?>
                    </label>
                    <div class="dividetela">
                        <label id="inputpequeno">
                            <p>Desconto:</p>
                            <input type="text" class="desconto dinheiro" name="desconto" maxlength="7" value="<?php echo $lc['desconto']; ?>" autocomplete="off" <?php echo $acao == 'listar' ? 'disabled' : '' ; ?> required/>
                        </label>
                        <label id="inputmini" class="float">
                            <p>Parcelas:</p>
                            <select name="parcela" <?php echo $acao == 'listar' ? 'disabled' : '' ; ?>  required>
                                <option value="1" <?php echo $lc['numeroParcelas'] == 1? 'selected' : '' ; ?>>01</option>
                            </select>
                        </label>
                        <label id="inputpequeno" class="float">
                            <p>Vencimento:</p>
                            <input type="date" name="vencimento" value="<?php echo $lc['vencimento']; ?>" autocomplete="off" <?php echo $acao == 'listar'? 'disabled' : '' ; ?> required/>
                        </label>
                    </div>
                    <div class="infocompra">
                        <h3>informações da compra</h3>
                        <p>Operador: Jefferson Miranda</p>
                        <p>Data da Compra: <span class="datacompra"><?php echo date_format(date_create($lc['dataCompra']), 'd/m/Y'); ?></span></p>
                        <p>Parcelas: <span class="parcela"><?php echo $lc['numeroParcelas']; ?></span></p>
                        <p>Vencimento: <span class="vencimento"><?php echo date_format(date_create($lc['vencimento']), 'd/m/Y'); ?></span></p>
                        <p>Desconto: R$ <span class="desconto"><?php echo $lc['desconto']; ?></span></p>
                        <h2>Total da fatura: R$ <span class="valortotal"><?php echo empty($total) ? $lc['valorCompra'] : $total; ?></span></h2>
                    </div>
                    <input type="hidden" value="<?php echo $total ?>" name="totalCompra"/>
                    <input id="botaoinput" type="submit" value="Cadastrar" />
                </form>
            </div>
        </div>
        <div id="conteudo">
            <p class="migalha">Dashboard > Cadastro Produto</p>
            <h1>Compra de Mercadorias</h1>
            <p id="botao1" class="botaoregistro">Novo Compra</p>
            <table cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Data Compra</th>
                        <th>Fornecedor</th>
                        <th>Valor Compra</th>
                        <th>Desconto</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    foreach($comprar->listarCompra() as $c){
                        echo "<tr>";
                        echo "<td><a href='?cod=".$c['idCompra']."&acao=listar'>".$c['idCompra']."</a></td>";
                        echo "<td><a href='?cod=".$c['idCompra']."&acao=listar'>". date_format(date_create($c['dataCompra']), 'd/m/Y') ."</a></td>";
                        echo "<td><a href='?cod=".$c['idCompra']."&acao=listar'>".$c['nomeFantasia']."</a></td>";
                        echo "<td><a href='?cod=".$c['idCompra']."&acao=listar'>R$: ".number_format($c['valorCompra'], 2, ',', '.')."</a></td>";
                        echo "<td><a href='?cod=".$c['idCompra']."&acao=listar'>R$: ".number_format($c['desconto'], 2, ',', '.')."</a></td>";
                        echo "<td><a href='?cod=".$c['idCompra']."&acao=listar'></a></td>";
                        echo "</tr>";
                    }
                ?>
                </tbody>
            </table>
        </div>
    </body>
</html>
