<?php


require 'dbconn.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class DB_ST {

    public static function getAll() {
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT id, joke_text, joke_date FROM jokes");
        $statement->execute();

        return $statement->fetchAll();
    }

    public static function delete($id) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("DELETE FROM jokes WHERE id = :id");
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();
    }

    public static function get($id) {
        // TODO
        // Namig: Ker vračate le en rezultat (in ne vseh) pri vračanju 
        // uporabite funkcijo $statement->fetch(); in ne $statement->fetchAll();
    }

    public static function insert($joke_date, $joke_text) {
        $db = DBInit::getInstance();

        $statement = $db->prepare("INSERT INTO jokes (joke_date, joke_text) VALUES (:joke_date, :joke_text)");
        $statement->bindParam(":joke_date", $joke_date);
        $statement->bindParam(":joke_text", $joke_text);
        $statement->execute();
    }
    
    #Funckija, ki nastavi dolocen atribute vloge z emalom na value
    public static function set_XAttributeToRole($vloga, $email, $atribute, $value){
        $db = DBInit::getInstance();
 
        $statement = $db->prepare("UPDATE :vloga SET :atribute = :value WHERE email = :email");
        $statement->bindParam(":vloga", $vloga);
        $statement->bindParam(":atribute", $atribute);
        $statemtn->bindParam(":email", $email);
        $statement->bindParam(":value", $value);
        $statement->execute();
    }
    
    
    public static function insert_prodajalec($ime, $priimek, $email, $geslo){
        $db = DBInit::getInstance();
 
        $statement = $db->prepare("INSERT INTO Prodajalec (ime, priimek, email, geslo, aktiviran_racun) VALUES"
                . "(:ime, :priimek, :email, :geslo, 'False')");
        $statement->bindParam(":ime", $ime);
        $statement->bindParam(":priimek", $priimek);
        $statemtn->bindParam(":email", $email);
        $statement->bindParam(":geslo", $geslo);
        $statement->execute();
        
        
    }
    
    #Brisi prodajalca s tem emailom
    public static function delete_prodajalec($email){
        $db = DBInit::getInstance();
 
        $statement = $db->prepare("DELETE FROM Prodajalec where email = :email");
        $statement->bindParam(":email", $email);
        $statement->execute();
    }
    
    #Brisi stranko s tem emailom
    public static function delete_stranka($email){
        $db = DBInit::getInstance();
 
        $statement = $db->prepare("DELETE FROM Stranka where email = :email");
        $statement->bindParam(":email", $email);
        $statement->execute();
    }
    
    public static function insert_stranka($ime, $priimek, $email, $naslov, $telefon, $geslo){
        $db = DBInit::getInstance();
 
        $statement = $db->prepare("INSERT INTO Stranka (ime, priimek, email, geslo, naslov, telefonska_st, aktiviran_racun) VALUES"
                . "(:ime, :priimek, :email, :geslo, :naslov, :telefon 'False')");
        $statement->bindParam(":ime", $ime);
        $statement->bindParam(":priimek", $priimek);
        $statemtn->bindParam(":naslov", $naslov);
        $statemtn->bindParam(":telefon", $telefon);
        $statemtn->bindParam(":email", $email);
        $statement->bindParam(":geslo", $geslo);
        $statement->execute();
        
        
    }
    
    #Funkcija ki posobodi atribute izdelka s tem imenom in ceno
    public static function set_ItemsAtributes($ime, $cena, $atribute, $value){
        $db = DBInit::getInstance();
 
        $statement = $db->prepare("UPDATE Artikel SET :atribute = :value WHERE ime = :ime AND cena = :cena");
        $statement->bindParam(":value", $value);
        $statement->bindParam(":atribute", $atribute);
        $statemtn->bindParam(":ime", $ime);
         $statemtn->bindParam(":cena", $cena);
        $statement->execute();
        
    }
    
    public static function insert_artikel($ime, $cena){
        $db = DBInit::getInstance();
 
        $statement = $db->prepare("INSERT INTO Artikel (ime, cena, aktiviran) VALUES"
                . "(:ime, :cena,'True')");
        $statement->bindParam(":ime", $ime);
        $statement->bindParam(":cena", $cena);
        $statement->execute();
        
    }
    
    #Brisi artikel s tem imenom in ceno
    public static function delete_artikel($ime, $cena){
         $db = DBInit::getInstance();
 
        $statement = $db->prepare("DELETE FROM Artikel where ime = :ime AND cena = :cena");
        $statement->bindParam(":ime", $ime);
        $statement->bindParam(":geslo", $cena);
        $statement->execute();
    }
    
    public static function get_All_Artikel(){
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT * FROM Artikel");
        $statement->execute();

        return $statement->fetchAll();    
    }
    
    public static function get_All_Stranke(){
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT * FROM Stranka");
        $statement->execute();

        return $statement->fetchAll();    
    }
    
    public static function get_All_Prodajalec(){
        $db = DBInit::getInstance();

        $statement = $db->prepare("SELECT * FROM Stranka");
        $statement->execute();

        return $statement->fetchAll();    
    }
   

}

