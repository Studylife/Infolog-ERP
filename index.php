<?php
    include './conn/conexao.php';
    include './controle/loginControle.php';
    
    $banco = new Banco();
    $banco->conectaBanco();

    $login = $_POST['login'];
    $senha = $_POST['senha'];
    
    $l = new loginControle();
    $logar = $l->verificaUsuario($login, $senha);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Acessar sua conta</title>
        <link rel="stylesheet" type="text/css" href="css/pagina.css" />
    </head>
    <body>
        <div id="login">
            <img src="img/logomaior.png" />
            <div class="form-login">
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                    <h1>Acessar Conta:</h1>
                    <label id="inputmedio">
                        <p>Login:</p>
                        <input type="text" name="login" placeholder="Informe seu Login" autocomplete="off" autofocus required/>
                    </label>
                    <label id="inputmedio">
                        <p>Senha:</p>
                        <input type="password" name="senha" placeholder="Informe sua Senha" required/>
                    </label>
                    <input type="submit" value="Fazer Login"/>
                </form>
            </div>
        </div>
    </body>
</html>
