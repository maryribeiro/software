<div class="box_titulo_interno">
    <H2><i class="fa fa-registered fa-1x"></i> Adicionar Funcionario</H2>
</div>
<br>
<div class="box_link">
    <a href="?pg=funcionarios">Voltar</a>
</div>
<br>
<hr>
<br>
<div class="formulario">
    <form method="post">
        <label>Nome Completo:</label>
        <input type="text" name="nome" required/>
        <br/>
        <label>Login:</label>
        <input type="text" name="login" required/>
        <br/>
        <label>Senha:</label>
        <input type="password" name="senha" required/>
        <br/>
        <input type="submit" name="botao" value="Confirmar"/>    
    </form>
</div>
<?php
require_once './dao/DaoFuncionario.php';
require_once './model/Funcionario.php';
if (isset($_POST["botao"])) {
    $funcionario = new Funcionario();
    $funcionario->setNome($_POST["nome"]);
    $funcionario->setLogin($_POST["login"]);
    $funcionario->setSenha($_POST["senha"]);
    
    $DaoFuncionario = DaoFuncionario::getInstance();
    $exe = $DaoFuncionario->inserir($funcionario);
    if ($exe) {
        echo "<script type='text/javascript'>"
        . " alert('Cadastrado com Sucesso!');"
        . "location.href='?pg=funcionarios';"
        . "</script>";
    } else {
        echo "<script type='text/javascript'>"
        . " alert('Não foi possível cadastrar!');"
        . "</script>";
    }
}