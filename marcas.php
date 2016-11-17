<H1>Lista de Marcas</H1>
<a href="?pg=addMarca">Adicionar</a>
<hr>
<?php
require_once 'dao/DaoMarca.php';
$DaoMarca = DaoMarca::getInstance();
$dados = $DaoMarca->listar();
?>
<table>
    <tr>
        <th>Código</th>
        <th>Descrição</th>
        <th>Ações</th>
    </tr>
    <?php
    foreach ($dados as $row) {
        $id = $row["id"];
        echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["descricao"] . "</td>";
            echo "<td><a href='?pg=editMarca&id=$id' title='Editar'><i class='fa fa-pencil'></i></a>"
            . " <a href='?pg=delMarca&id=$id' title='Excluir' onclick='return confirm(\"Deseja excluir?\")'><i class='fa fa-trash'></i></a></td>";
        echo "</tr>";
    }
    ?>
</table>