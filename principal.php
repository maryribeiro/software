<?php
    session_start();
    if(empty($_SESSION["login"])&&$_SESSION["validou"]!=true) {
        header("Location:index.php");
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
    </head>
    <body>
        <ul>
            <li><a href="?pg=marcas">Marcas</a></li>
            <li><a href="logout.php">Sair</a></li>
        </ul>
        <div>
            <?php
                $pg = $_GET["pg"];
                if(isset($pg)) {
                    include_once $pg.'.php';
                }
            ?>
        </div>
    </body>
</html>
