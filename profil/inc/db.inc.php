<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/conf/conf.inc.php');
    function dbConn(){
        $db = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASSWORD);
        return $db;
    }

    function findAll($tableName){
        $db = dbConn();
        $sql = "SELECT * FROM " . $tableName;
        $query = $db->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function findOne($tableName, $elName, $value){
        $db = dbConn();
        $sql = "SELECT * FROM " . $tableName . " WHERE $elName = :val";
        $query = $db->prepare($sql);
        $query->bindParam(':val', $value);
        $query->execute();
        return $query->fetch();
    }
    function findUser($search){
        $db = dbConn();
        $sql = "SELECT * FROM users WHERE user_name = :val1 OR user_email = :val2";
        $query = $db->prepare($sql);
        $query->bindParam(':val1', $search);
        $query->bindParam(':val2', $search);
        $query->execute();
        return $query->fetch();
    }

    function getUserName($userId){
        $db = dbConn();
        $sql = "SELECT * FROM users WHERE user_id = :val";
        $query = $db->prepare($sql);
        $query->bindParam(':val', $userId);
        $query->execute();
        $res = $query->fetch();

        $displayName = $res["user_displayName"];
        $userName = $res["user_name"];
        return "$displayName ($userName)";
    }