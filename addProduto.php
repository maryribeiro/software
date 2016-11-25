<div class="box_titulo_interno">
    <H2><i class="fa fa-shopping-cart fa-1x"></i> Adicionar Produto</H2>
</div>
<br>
<div class="box_link">
    <a href="?pg=produto">Voltar</a>
</div>
<br>
<hr>
<br>
<div class="formulario">
    <form method="post" enctype="multipart/form-data">
        <label>Descrição do Produto:</label>
        <input type="text" name="descricao" required/>
        <br/>
        <label>Marca:</label>
        <select name="marca" required>
            <option value="">Selecione a Marca</option>
            <?php
            require_once 'dao/DaoMarca.php';
            $DaoMarca = DaoMarca::getInstance();
            $dadosMarca = $DaoMarca->listar();
            foreach ($dadosMarca as $rowMarca) {
                echo "<option value='{$rowMarca["id"]}'>{$rowMarca["descricao"]}</option>";
            }
            ?>
        </select>
        <br/>
        <label>Preço:</label>
        <input type="text" name="preco" required/>
        <br/>
        <label>Imagem:</label>
        <input type="file" name="imagem" required/>
        <br/>
        <label>Destaque:</label>
        <select name="destaque">
            <option value="0" selected>Não</option>
            <option value="1">Sim</option>
        </select>
        <br/>
        <input type="submit" name="botao" value="Confirmar"/>    
    </form>
</div>
<?php
require_once './dao/DaoProduto.php';
require_once './model/Produto.php';
if (isset($_POST["botao"])) {
    $produto = new Produto ();
    $produto->setDescricao($_POST["descricao"]);
    $produto->setMarca($_POST["marca"]);
    $produto->setPreco($_POST["preco"]);
    $produto->setImagem($_FILES["imagem"]["name"]);
    $produto->setDestaque($_POST["destaque"]);
    
    /***upload de imagem**/
    $pastaDestino = "fotos/";
    $arquivoDestino = $pastaDestino.basename($_FILES["imagem"]["name"]);  
    move_uploaded_file($_FILES["imagem"]["tmp_name"], $arquivoDestino);
    chown($arquivoDestino, 777);    
    /***fim do upload***/

    $DaoVeiculo = DaoProduto::getInstance();
    $exe = $DaoVeiculo->inserir($produto);
    if ($exe) {
        echo "<script type='text/javascript'>"
        . " alert('Cadastrado com Sucesso!');"
        . "location.href='?pg=produto';"
        . "</script>";
    } else {
        echo "<script type='text/javascript'>"
        . " alert('Não foi possível cadastrar!');"
        . "</script>";
    }
}