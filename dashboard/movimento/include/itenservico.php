<?php
//adicionar produto
    if(isset($_GET['acao'])){
        //adicionar carrinho
        if($_GET['acao'] == 'addservico'){
            $idservico = $_GET['idservico'];
            
            
            $_SESSION['servico'][$idservico] = $idservico;
        }
        
        //remover carrinho
        if($_GET['acao'] == 'del'){
            $id = intval($_GET['id']);
            if(isset($_SESSION['servico'][$id])){
                unset($_SESSION['servico'][$id]);
            }
        }
    }
    
    function listaItenServico(){
        if(count($_SESSION['servico']) == 0){
            echo '<tr><td colspan="6">Não há serviço na lista</td></tr>';
        }else{
            foreach ($_SESSION['servico'] as $id){
                $sql = "SELECT * FROM servico WHERE idServico = '$id'";
                $consulta   = mysql_query($sql);
                $s  = mysql_fetch_assoc($consulta);
                
                
                if(empty($s)){
                    unset($_SESSION['servico'][$id]);
                } else {
                    $total += $s['precoServico'];
                    echo "<tr>"
                            . "<td>".$s['idServico']."</td>"
                            . "<td>".$s['nomeServico']."</td>"
                            . "<td>".$s['tempoReparo']."</td>"
                            . "<td>R$ ".number_format($s['precoServico'], '2',',','.')."</td>"
                            . "<td><a href='?acao=del&id=".$id."'><img src='../../img/icon/remove.gif' /></a></td>"
                       . "</tr>";
                }
            }
            return $total;
        }
    }