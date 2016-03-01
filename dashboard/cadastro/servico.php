<?php
    include '../../conn/conexao.php';
    include '../../controle/servicoControle.php';
    
    $banco = new Banco();
    $banco->conectaBanco();
    
    //AÇÃO
    $remove = (int)$_GET['remover'];
    $editar = (int)$_GET['editar'];
    $update = $_GET['acao'];
    
    
    
    $s = new servicoControle();
    
    
    if(!empty($_POST)){
        $servico['servico']     = $_POST['servico'];
        $servico['valor']       = str_replace(',', '.', str_replace('.', '', $_POST['valor']));
        $servico['tempo']       = $_POST['tempo'];
        $servico['descricao']   = $_POST['descricao'];
        if($update != 'salvar'){
            $s->salvarServico($servico);
        } else {
            $s->editarServico($servico, $editar);
        }
    }
    
    //RECUPERA AS INFORMAÇÕES DO SERVICO
    if(!empty($editar)){
        $serv = $s->recuperaServico($editar);
    }
    //REMOVER SERVIÇO
    if(!empty($remove)){
        $s->excluirServico($remove);
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
        <title>Cadastro de Serviço</title>
        <link rel="stylesheet" type="text/css" href="../../css/pagina.css" />
        <script src="../../js/jquery-1.11.3.min.js"></script>
        <script src="../../js/menu.js"></script>
        <script src="../../js/mask.js"></script>
        <script src="../../js/formulario.js"></script>
        <script>
        jQuery(document).ready(function() {
            jQuery('a.confirma').click(function(event) {
                event.preventDefault();
                var url = $(this).attr('href');
                var confirm_box = confirm('Deseja realmente excluir?');
                if (confirm_box) {
                   window.location = url;
                }
            });
            var edit = <?php echo $_GET['editar'] ?>;
            if(edit > 0){
                $('#formulario').show();
            }
        });
        </script>
    </head>
    <body>
        <?php include '../header.php'; ?>
        <?php include '../menu.html'; ?>
        <div id="formulario">
            <p class="fechar">X</p>
            <div class="conteudo-form">
                <form method="post" action="<?php  echo !empty($editar) ? $_SERVER['PHP_SELF'].'?acao=salvar&editar='.$serv['idServico'] : $_SERVER['PHP_SELF'] ?>">
                    <!------------------------------------------>
                    <!-------- INICIA FORMULARIO --------------->
                    <h1>Cadastrar Serviço</h1>
                    <label id="inputgrande">
                        <p>Nome do Serviço:</p>
                        <input value="<?php echo $serv['nomeServico'] ?>" class="focus" type="text" name="servico" autocomplete="off"/>
                    </label>
                    <label id="inputpequeno">
                        <p>Preço:</p>
                        <input value="<?php echo $serv['precoServico'] ?>" class="dinheiro" type="text" name="valor" autocomplete="off"/>
                    </label>
                    <label id="inputmedio">
                        <p>Tempo para reparo:</p>
                        <select name="tempo">
                            <option disabled selected>Selecione o tempo</option>
                            <option valeu="30 min" <?php echo $serv['tempoReparo'] == '30 min' ? 'selected' : ''; ?>>30 min</option>
                            <option valeu="1 Hora" <?php echo $serv['tempoReparo'] == '1 Hora' ? 'selected' : ''; ?>>1 Hora</option>
                            <option valeu="2 Horas" <?php echo $serv['tempoReparo'] == '2 Horas' ? 'selected' : ''; ?>>2 Horas</option>
                            <option valeu="3 Horas" <?php echo $serv['tempoReparo'] == '3 Horas' ? 'selected' : ''; ?>>3 Horas</option>
                            <option valeu="4 Horas" <?php echo $serv['tempoReparo'] == '4 Horas' ? 'selected' : ''; ?>>4 Horas</option>
                            <option valeu="5 Horas" <?php echo $serv['tempoReparo'] == '5 Horas' ? 'selected' : ''; ?>>5 Horas</option>
                            <option valeu="6 Horas" <?php echo $serv['tempoReparo'] == '6 Horas' ? 'selected' : ''; ?>>6 Horas</option>
                            <option valeu="1 Dia" <?php echo $serv['tempoReparo'] == '1 Dia' ? 'selected' : ''; ?>>1 Dia</option>
                            <option valeu="2 Dias" <?php echo $serv['tempoReparo'] == '2 Dias' ? 'selected' : ''; ?>>2 Dias</option>
                            <option valeu="3 Dias" <?php echo $serv['tempoReparo'] == '3 Dias' ? 'selected' : ''; ?>>3 Dias</option>
                        </select>
                    </label>
                    <label id="inputfull">
                        <p>Descrição do Serviço:</p>
                        <textarea name="descricao"><?php echo $serv['descrServico'] ?></textarea>
                    </label>
                    <input id="botaoinput" type="submit" value="Cadastrar" />
                    <!--------  FECHA FORMULARIO --------------->
                    <!------------------------------------------>
                </form>
            </div>
        </div>
        <div id="conteudo">
            <p class="migalha">Dashboard > Cadastro Serviço</p>
            <h1>Cadastro de Serviço</h1>
            <p id="botao1" class="botaoregistro">Novo Serviço</p>
            <table cellspacing="0" cellpadding="0">
                <thead>
                        <tr>
                                <th>Codigo</th>
                                <th>Nome Serviço</th>
                                <th>Tempo de Reparo</th>
                                <th>Preço do serviço</th>
                                <th></th>
                                <th></th>
                        </tr>
                </thead>
                <tbody>
                <?php
                if(count($s->listarServico())){
                    foreach($s->listarServico() as $e){
                        echo "<tr>";
                        echo "<td><a href=".'?codigo='.$e['idServico'].">".$e['idServico']."</a></td>";
                        echo "<td><a href=".'?codigo='.$e['idServico'].">".$e['nomeServico']."</a></td>";
                        echo "<td><a href=".'?codigo='.$e['idServico'].">".$e['tempoReparo']."</a></td>";
                        echo "<td><a href=".'?codigo='.$e['idServico'].">R$ ".$e['precoServico']."</a></td>";
                            echo "<td width='5%'><a href=".'?editar='.$e['idServico']." ><img src='../../img/icon/edit.gif' /></a></td>";
                            echo "<td width='5%'><a href=".'?remover='.$e['idServico']." class='confirma'><img src='../../img/icon/remove.gif' /></a></td>";
                        echo "</tr>";
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </body>
</html>
