<h1>Adicionar Marca</h1>
<a href="?pg=marcas">Voltar</a>
<br/>
<br/>
<form method="post">
    <label>Descrição:</label>
    <input type="text" name="descricao" required/>
    <br/>
    <button type="submit" name="botao">Confirmar</button>
    <button type="reset">Limpar</button>    
</form>
<?php
require_once './dao/DaoMarca.php';
require_once './model/Marca.php';
if (isset($_POST["botao"])) {    
    $marca = new Marca();
    $marca->setDescricao($_POST["descricao"]);

    $DaoMarca = DaoMarca::getInstance();  
    $exe = $DaoMarca->inserir($marca);
    if ($exe) {
        echo "<script type='text/javascript'>"
        . " alert('Cadastrado com Sucesso!');"
                . "location.href='?pg=marcas';"
        . "</script>";
    } else {
        echo "<script type='text/javascript'>"
        . " alert('Não foi possível cadastrar!');"
        . "</script>";
    }
}