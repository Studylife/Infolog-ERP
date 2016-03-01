<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Estoque por Periodo</title>
        <link rel="stylesheet" type="text/css" href="../../css/pagina.css" />
    </head>
    <body>
        <h1>Selecione o periodo do Estoque</h1>
        <form action="relatorioestoque.php" method="POST" target="_blank">
            <label id="inputpequeno" class="float">
                <p>Periodo Inicial</p>
                <input type="date" name="inicio" autofocus/>
            </label>
            <label id="inputpequeno" class="float">
                <p>Periodo Final</p>
                <input type="date" name="fim" />
            </label>
            <input type="submit" id="botaoinput" />
        </form>
    </body>
</html>
