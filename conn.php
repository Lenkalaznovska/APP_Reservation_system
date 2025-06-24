<?php
$servername = "sql5.webzdarma.cz";
$username = "rezervacnisy1460";
$password = "UQ4aJ6bnv3owCHaJnO-e";
$dbname = "rezervacnisy1460";

$conn = mysqli_connect($servername, $username, $password, $dbname);
$conn->set_charset("utf8");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

function fetchAssoc($sql, $conn) {
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $pole = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return $pole;
    } else {
        return null; // or handle the error appropriately
    }
}

function fetch($sql, $conn) {
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $pole = mysqli_fetch_array($result, MYSQLI_NUM);
        return $pole;
    } else {
        return null; // or handle the error appropriately
    }
}

function fetchAll($sql, $conn) {
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $pole = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $pole;
    } else {
        return null; // or handle the error appropriately
    }
}

function akce($sql, $conn) {
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        return false;
    }
}
?>
