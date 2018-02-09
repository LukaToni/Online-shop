<?php

require_once 'model/AbstractDB.php';

class ItemDB extends AbstractDB {

    public static function insert(array $params) {
        return parent::modify("INSERT INTO articles (name, price, description) "
                        . " VALUES (:name, :price, :description)", $params);
    }
    
    public static function update(array $params) {
        return parent::modify("UPDATE articles SET name = :name, "
                        . "price = :price"
                        . "description = :description"
                        . " WHERE id = :id", $params);
    }
    public static function delete(array $id) {
        return parent::modify("DELETE FROM articles WHERE id = :id", $id);
    }
    
    public static function get(array $id) {
        $articles = parent::query("SELECT id, name, price, description"
                        . " FROM articles"
                        . " WHERE id = :id", $id);

        if (count($articles) == 1) {
            return $articles[0];
        } else {
            throw new InvalidArgumentException("No such article");
        }
    }

    public static function getAll() {
        return parent::query("SELECT id, name, price, description"
                        . " FROM articles"
                        . " ORDER BY id ASC");
    }

    public static function getAllwithURI(array $prefix) {
        return parent::query("SELECT id, name, price, "
                        . "          CONCAT(:prefix, id) as uri "
                        . "FROM articles "
                        . "ORDER BY id ASC", $prefix);
    }

}
