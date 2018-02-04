<?php

$host = "localhost";
$user = "root";
$password = "";
$schema = "spletna_trgovina";

$config = "mysql:host=" . $host
        . ";dbname=" . $schema;
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_PERSISTENT => true,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
);

$db = new PDO($config, $user, $password, $options);
      


function executeQuery($query){
    global $db;
    $statement = $db->prepare($query);
    return $statement->execute();
}

function countResults($query){
    global $db;
    $statement = $db->prepare($query);
    return $statement->execute()->fetchColumn();
}

function getUserData($query){
    global $db;
    return $db->query($query)->fetch();
}

function fetchRows($query){
    global $db;
    return $db->query($query);
}

?>