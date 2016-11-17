<?php 
    $id = $_GET["id"];
    require_once 'dao/DaoMarca.php';
    $DaoMarca = DaoMarca::getInstance();  
    $atualizar = $DaoMarca->getMarca($id);
?>
<h1>Editar Marca</h1>
<a href="?pg=marcas">Voltar</a>
<br/>
<br/>
<form method="post">
    <label>Descrição:</label>
    <input type="hidden" name="id" value="<?=$atualizar["id"]?>"/>
    <input type="text" name="descricao" value="<?=$atualizar["descricao"]?>" required/>
    <br/>
    <button type="submit" name="botao">Confirmar</button>
    <button type="reset">Limpar</button>    
</form>
<?php
require_once './dao/DaoMarca.php';
require_once './model/Marca.php';
if (isset($_POST["botao"])) {    
    $marca = new Marca();
    $marca->setId($_POST["id"]);
    $marca->setDescricao($_POST["descricao"]);

    $DaoMarca = DaoMarca::getInstance();  
    $exe = $DaoMarca->atualizar($marca);
    if ($exe) {
        echo "<script type='text/javascript'>"
        . " alert('Atualizado com Sucesso!');"
                . "location.href='?pg=marcas';"
        . "</script>";
    } else {
        echo "<script type='text/javascript'>"
        . " alert('Não foi possível atualizar!');"
        . "</script>";
    }
}