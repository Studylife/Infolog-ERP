<label id="inputpequeno" class="float">
    <p>Cod. de barras:</p>
    <input class="focus" type="text" name="codbarras" autocomplete="off" autofocus/>
</label>
<input type="hidden" name="acao" value="add" />
<label id="inputmedio" class="float">
    <p>Produto:</p>
    <?php 
    $selecionaProduto = new produtoControle();
    if(!empty($selecionaProduto->listaProduto())){
        echo "<select name='id'>";
        echo "<option disabled selected>Selecione um Produto</option>";
        foreach ($selecionaProduto->listaProduto() as $p){
            echo "<option value='".$p['idProduto']."'>".$p['descProduto']."</option>";
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