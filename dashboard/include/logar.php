<?php
    session_start();
    
    if(empty($_SESSION['idLogin'])){
        header("location: ../index.php");
        session_destroy();
    }
    
    $pessoa = new loginControle();
    $p = $pessoa->retornaUsuario($_SESSION['idLogin']);
    