<?php
$id = $_GET["id"];
require_once 'dao/DaoProduto.php';
$DaoProduto = DaoProduto::getInstance();
$atualizar = $DaoProduto->getProduto($id);
?>
<div class="box_titulo_interno">
    <h2><i class="fa fa-pencil fa-1x"></i> Editar Produto</h2>
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
        <input type="hidden" name="id" value="<?= $atualizar["id"] ?>"/>  
        <label>Descrição do Produto:</label>
        <input type="text" name="descricao" required value="<?= $atualizar["descricao"] ?>"/>
        <br/>
        <label>Marca:</label>
        <select name="marca" required>
            <option value="">Selecione a Marca</option>
            <?php
            require_once 'dao/DaoMarca.php';
            $DaoMarca = DaoMarca::getInstance();
            $dadosMarca = $DaoMarca->listar();
            foreach ($dadosMarca as $rowMarca) {
                if ($rowMarca["id"] == $atualizar["marca_id"]) {
                    echo "<option value='{$rowMarca["id"]}' selected>{$rowMarca["descricao"]}</option>";
                } else {
                    echo "<option value='{$rowMarca["id"]}'>{$rowMarca["descricao"]}</option>";
                }
            }
            ?>
        </select>
        <br/>
        <label>Preço:</label>
        <input type="text" name="preco" required value="<?= $atualizar["preco"] ?>"/>
        <br/>
        <label>Imagem Atual:</label><br>
        <input type="image" name="imagem_atuaa" src="fotos/<?= $atualizar["imagem"] ?>" width="200">
        <br/>
        <br/>
        <label>Nova Imagem:</label>
        <input type="file" name="imagem" />
        <br/>
        <label>Destaque:</label>
        <select name="destaque">
            <option value="0" <?= ($atualizar["destaque"]==0)?"selected":""; ?>>Não</option>
            <option value="1" <?= ($atualizar["destaque"]==1)?"selected":""; ?>>Sim</option>
        </select>
        <br/>
        <input type="submit" name="botao" value="Confirmar"/>    
    </form>
</div>
<?php
require_once './dao/DaoProduto.php';
require_once './model/Produto.php';
if (isset($_POST["botao"])) {
    $produto = new Produto();
    $produto->setId($_POST["id"]);
    $produto->setDescricao($_POST["descricao"]);
    $produto->setMarca($_POST["marca"]);
    $produto->setPreco($_POST["preco"]);    
    $produto->setDestaque($_POST["destaque"]);    

    /*     * *upload de imagem* */
    if ($atualizar["imagem"] != $_FILES["imagem"]["name"] && !empty($_FILES["imagem"]["name"])) {        
        $pastaDestino = "fotos/";
        $arquivoDestino = $pastaDestino . basename($_FILES["imagem"]["name"]);
        //apaga imagem atual para trocar pela nova
        chown($arquivoDestino, 777);  
        unlink($pastaDestino.$atualizar["imagem"]);
        //envia a nova imagem para a pasta
        move_uploaded_file($_FILES["imagem"]["tmp_name"], $arquivoDestino);                  
        $produto->setImagem($_FILES["imagem"]["name"]);
    } else {
        $produto->setImagem($atualizar["imagem"]);
    }
    /*     * *fim do upload** */

    $DaoProduto = DaoProduto::getInstance();
    $exe = $DaoProduto->atualizar($produto);
    if ($exe) {
        echo "<script type='text/javascript'>"
        . " alert('Atualizado com Sucesso!');"
        . "location.href='?pg=produto';"
        . "</script>";
    } else {
        echo "<script type='text/javascript'>"
        . " alert('Não foi possível atualizar!');"
        . "</script>";
    }
}