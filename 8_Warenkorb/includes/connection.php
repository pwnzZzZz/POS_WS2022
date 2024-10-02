<?php

$dbName = 'warenkorb';
$dbHost = 'localhost';
$dbUsername = 'root';
$dbUserPassword = '';

/**
 * Verbindung zur DB aufbauen
 * @return PDO (Verbindungsobjekt)
 */
function connect() {
    global $dbName, $dbHost, $dbUsername, $dbUserPassword;
    try {
        $conn = new PDO("mysql:host=" . $dbHost . ";" . "dbname=" . $dbName, $dbUsername, $dbUserPassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

/**
 * Auslesen aller Daten (als assoziatives Array)
 * @return array
 */
function getAllData()
{
    $db = connect();
    $sql = 'SELECT * FROM warenkorb ORDER BY id';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $data;
}

/**
 * filter data on firstname, lastname or email
 *
 * @param $filter string
 * @return array
 */
function getFilteredData($filter)
{
    $db = connect();
    $sql = "SELECT * FROM warenkorb WHERE title LIKE :title OR price LIKE :price OR stock LIKE :stock ORDER BY id";
    $stmt = $db->prepare($sql);
    $filter = "%$filter%";
    $stmt->bindValue(':title', $filter);
    $stmt->bindValue(':price', $filter);
    $stmt->bindValue(':stock', $filter);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $data;
}

/**
 * filter data based on id
 * @param $id
 * @return array or null
 */
function getDataPerId($id)
{
    $db = connect();
    $sql = 'SELECT * FROM warenkorb WHERE id = ?';
    $stmt = $db->prepare($sql);
    $stmt->execute([$id]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    return $data;
}

?>