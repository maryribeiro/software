<?php
require_once 'dao/DaoFuncionario.php';
if (isset($_POST["entrar"])) {
    $login = $_POST["login"];
    $senha = $_POST["senha"];
    $DaoFuncionario = DaoFuncionario::getInstance();
    $validou = $DaoFuncionario->getLogin($login,$senha);
    if ($validou > 0) {
        session_start();
        $_SESSION["login"]=$login;
        $_SESSION["validou"]=true;        
        header("Location:principal.php");
    } else {
        echo "<script type='text/javascript'>"
    . "alert('Usuário ou Senha inválidos!');"
    . "location.href='index.php';"
    . "</script>";
    }
}
