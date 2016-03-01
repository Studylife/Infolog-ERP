<?php
    //CARRINHO DE COMPRAS IMPROVISADO
    session_start();
    
    if(!isset($_SESSION['carrinho'])){
        $_SESSION['carrinho'] = array();
    }
    
    function codigoBarras($codBarras){
        $sql = "SELECT idProduto FROM produto WHERE codBarras = '$codBarras'";
        $consulta = mysql_query($sql);
        $resultado = mysql_fetch_assoc($consulta);
        return $resultado;
    }
    
    //adicionar produto
    if(isset($_GET['acao'])){
        //adicionar carrinho
        if($_GET['acao'] == 'add'){
            $id = codigoBarras($_GET['codbarras'])['idProduto'] != null ? codigoBarras($_GET['codbarras'])['idProduto'] : $_GET['id'];
            
            
            if(!isset($_SESSION['carrinho'][$id])){
                $_SESSION['carrinho'][$id] = $_GET['quantidade'];
            } else {
                $_SESSION['carrinho'][$id] += empty($_GET['quantidade'])? 1 : $_GET['quantidade'];
            }
        }
        
        //remover carrinho
        if($_GET['acao'] == 'del'){
            $id = intval($_GET['id']);
            if(isset($_SESSION['carrinho'][$id])){
                unset($_SESSION['carrinho'][$id]);
            }
        }
    }
    
    function listaItensCarrinho1(){
        if(count($_SESSION['carrinho']) == 0){
            echo '<tr><td colspan="6">Não há produto na lista</td></tr>';
        }else{
            foreach ($_SESSION['carrinho'] as $id => $qnt){
                $sql = "SELECT * FROM produto WHERE idProduto = '$id'";
                $consulta   = mysql_query($sql);
                $r  = mysql_fetch_assoc($consulta);

                if(empty($r)){
                    unset($_SESSION['carrinho'][$id]);
                } else {
                    $total += $r['valorVenda'] * $qnt;
                    echo "<tr>"
                            . "<td>".$r['codBarras']."</td>"
                            . "<td>".$r['descProduto']."</td>"
                            . "<td>PC</td>"
                            . "<td>".$qnt."</td>"
                            . "<td>R$ ".number_format($r['valorVenda'], '2',',','.')."</td>"
                            . "<td>R$ ".number_format($r['valorVenda'] = $r['valorVenda'] * $qnt, '2',',','.')."</td>"
                            . "<td><a href='?acao=del&id=".$id."'><img src='../../img/icon/remove.gif' /></a></td>"
                       . "</tr>";
                }
            }
            return $total;
        }
    }
    
    function listaItenscarrinho2($lp){
        foreach ($lp as $l){
            echo "<tr>"
                    . "<td>".$l['codBarras']."</td>"
                    . "<td>".$l['descProduto']."</td>"
                    . "<td>nada</td>"
                    . "<td>".$l['quantidade']."</td>"
                    . "<td>R$ ".number_format($l['valorUn'], '2',',','.')."</td>"
                    . "<td>R$ ".number_format($l['valorUn'] = $l['valorUn'] * $l['quantidade'], '2',',','.')."</td>"
                    . "<td><a href=''></a></td>"
               . "</tr>";
        }
    }