<?php

require_once("model/ItemDB.php");
require_once("ViewHelper.php");

class ItemsController {

    public static function get($id) {
        echo ViewHelper::render("view/item-detail.php", ItemDB::get(["id" => $id]));
    }

    public static function index() {
        echo ViewHelper::render("view/item-list.php", [
            "articles" => ItemDB::getAll()
        ]);
    }
    
    public static function addForm($values = [
        "name" => "",
        "price" => "",
        "description" => ""
    ]) {
        echo ViewHelper::render("view/item-add.php", $values);
    }
    
    public static function add() {
        $data = filter_input_array(INPUT_POST, self::getRules());

        if (self::checkValues($data)) {
            $id = ItemDB::insert($data);
            echo ViewHelper::redirect(BASE_URL . "articles/" . $id);
        } else {
            self::addForm($data);
        }
    }
    
    public static function editForm($params) {
        if (is_array($params)) {
            $values = $params;
        } else if (is_numeric($params)) {
            $values = ItemDB::get(["id" => $params]);
        } else {
            throw new InvalidArgumentException("Cannot show form.");
        }

        echo ViewHelper::render("view/item-edit.php", $values);
    }

    public static function edit($id) {
        $data = filter_input_array(INPUT_POST, self::getRules());

        if (self::checkValues($data)) {
            $data["id"] = $id;
            ItemDB::update($data);
            ViewHelper::redirect(BASE_URL . "articles/" . $data["id"]);
        } else {
            self::editForm($data);
        }
    }

    public static function delete($id) {
        $data = filter_input_array(INPUT_POST, [
            'delete_confirmation' => FILTER_REQUIRE_SCALAR
        ]);

        if (self::checkValues($data)) {
            BookDB::delete(["id" => $id]);
            $url = BASE_URL . "books";
        } else {
            $url = BASE_URL . "books/edit/" . $id;
        }

        ViewHelper::redirect($url);
    }
    /**
     * Returns TRUE if given $input array contains no FALSE values
     * @param type $input
     * @return type
     */
    public static function checkValues($input) {
        if (empty($input)) {
            return FALSE;
        }

        $result = TRUE;
        foreach ($input as $value) {
            $result = $result && $value != false;
        }

        return $result;
    }
    
    /**
     * Returns an array of filtering rules for manipulation items
     * @return type
     */
    public static function getRules() {
        return [
            'name' => FILTER_SANITIZE_SPECIAL_CHARS,
            'price' => FILTER_VALIDATE_FLOAT,
            'description' => FILTER_SANITIZE_SPECIAL_CHARS,
        ];
    }

}
