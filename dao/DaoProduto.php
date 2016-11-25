<?php

require_once 'Conexao.php';
require_once 'model/Produto.php';

class DaoProduto {

    public static $instance;

    private function __construct() {
        //
    }

    public static function getInstance() {
        if (!isset(self::$instance))
            self::$instance = new DaoProduto();
        return self::$instance;
    }

    public function inserir(Produto $produto) {
        try {
            $sql = "INSERT INTO produto "
                    . " (descricao,"
                    . " marca_id,"
                    . " preco,"
                    . " imagem,"
                    . " destaque) "
                    . " VALUES "
                    . " (:descricao,"
                    . " :marca_id,"
                    . " :preco,"
                    . " :imagem,"
                    . " :destaque)";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(":descricao", $produto->getDescricao());
            $p_sql->bindValue(":marca_id", $produto->getMarca());
            $p_sql->bindValue(":preco", $produto->getPreco());
            $p_sql->bindValue(":imagem", $produto->getImagem());
            $p_sql->bindValue(":destaque", $produto->getDestaque());
            return $p_sql->execute();
        } catch (PDOException $exc) {
            return $exc->getMessage();
        }
    }

    public function listar() {
        $sql = "SELECT produto.id,"
                . " produto.descricao,"
                . " produto.preco,"
                . " produto.destaque,"
                . " produto.imagem,"
                . " marca.descricao as marca"
                . " FROM produto, marca"
                . " WHERE produto.marca_id = marca.id "
                . " ORDER BY produto.descricao";

        $p_sql = Conexao::getInstance()->prepare($sql);
        $p_sql->execute();
        return $p_sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deletar($id) {
        $sql = "DELETE FROM produto WHERE id =:id";
        try {
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(":id", $id);
            return $p_sql->execute();
        } catch (PDOException $exc) {
            return $exc->getMessage();
        }
    }

    public function getProduto($id) {
        $sql = "SELECT * FROM produto WHERE id=:id";

        $p_sql = Conexao::getInstance()->prepare($sql);
        $p_sql->bindValue(":id", $id);
        $p_sql->execute();
        return $p_sql->fetch(PDO::FETCH_ASSOC);
    }
    
    
    public function getLogin($login,$senha) {
        $sql = "SELECT * FROM produto WHERE login=:login and senha=:senha";

        $p_sql = Conexao::getInstance()->prepare($sql);
        $p_sql->bindValue(":login", $login);
        $p_sql->bindValue(":senha", $senha);
        $p_sql->execute();
        return $p_sql->rowCount();
    }

    public function atualizar(Produto $produto) {
        try {
            $sql = "UPDATE produto set descricao =:descricao, preco=:preco, marca_id=:marca,imagem=:imagem,destaque=:destaque"
                    . " WHERE id=:id";
            $p_sql = Conexao::getInstance()->prepare($sql);
            $p_sql->bindValue(":id", $produto->getId());
            $p_sql->bindValue(":descricao", $produto->getDescricao());
            $p_sql->bindValue(":preco", $produto->getPreco());
            $p_sql->bindValue(":marca", $produto->getMarca());
            $p_sql->bindValue(":imagem", $produto->getImagem());
            $p_sql->bindValue(":destaque", $produto->getDestaque());
            return $p_sql->execute();
        } catch (PDOException $exc) {
            return $exc->getMessage();
        }
    }

}
