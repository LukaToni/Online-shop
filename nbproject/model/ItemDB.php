<?php

require_once 'model/AbstractDB.php';

class ItemDB extends AbstractDB {

    public static function insert(array $params) {
        return parent::modify("INSERT INTO item (title, description, price) "
                        . " VALUES (::title, :description, :price)", $params);
    }

    public static function update(array $params) {
        return parent::modify("UPDATE item SET title = :title, "
                        . "description = :description, price = :price"
                        . " WHERE id = :id", $params);
    }

    public static function delete(array $id) {
        return parent::modify("DELETE FROM item WHERE id = :id", $id);
    }

    public static function get(array $id) {
        $items = parent::query("SELECT id, title, description, price"
                        . " FROM item"
                        . " WHERE id = :id", $id);

        if (count($items) == 1) {
            return $items[0];
        } else {
            throw new InvalidArgumentException("No such item");
        }
    }

    public static function getAll() {
        return parent::query("SELECT id, title, price, description"
                        . " FROM item"
                        . " ORDER BY id ASC");
    }

    public static function getAllwithURI(array $prefix) {
        return parent::query("SELECT id, title, price, "
                        . "          CONCAT(:prefix, id) as uri "
                        . "FROM item "
                        . "ORDER BY id ASC", $prefix);
    }

}
