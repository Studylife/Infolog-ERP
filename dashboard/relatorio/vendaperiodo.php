<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Venda por Periodo</title>
        <link rel="stylesheet" type="text/css" href="../../css/pagina.css" />
    </head>
    <body>
        <h1>Selecione o periodo da Venda</h1>
        <form action="relatoriovenda.php" method="POST" target="_blank">
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
