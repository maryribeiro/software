<?php
session_start();
if (!empty($_SESSION["login"]) && $_SESSION["validou"] == true) {
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
        <title></title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/estilo_login.css" type="text/css" media="all"/>
    </head>
    <body>
        <div>
            <center> <h2> <img src="img/info.png" width="200" height="100" alt="info"/>
                    </center>
            <hr>
            <br/>
            <form method="post" action="login.php">
                <label>Login: </label>
                <input type="text" name="login" required/>   
                <br/>
                <label>Senha: </label>
                <input type="password" name="senha" required/>
                <br/>
                <input type="submit" name="entrar" value="Entrar"/>  
                <h2> 
            </form>
        </div>
    </body>
</html>
