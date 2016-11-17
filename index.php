<?php
    session_start();
    if(!empty($_SESSION["login"])&&$_SESSION["validou"]==true) {
        header("Location:principal.php");
    }
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Software</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
    </head>
    <body>
        <form method="post" action="login.php">
            <label>Login: </label>
            <input type="text" name="login"/>   
            <br/>
            <label>Senha: </label>
            <input type="password" name="senha"/>
            <br/>
            <button type="submit" name="entrar">Entrar</button>            
        </form>
    </body>
</html>
