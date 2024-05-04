<?php
// Připojení k databázi s použitím zadaných údajů
$servername = "localhost";
$username = "";
$password = "";
$dbname = "rezervace";

$conn = mysqli_connect($servername, $username, $password, $dbname);
$conn->set_charset("utf8"); // Nastavení kódování UTF-8 pro správné zpracování diakritiky

// Kontrola spojení s databází
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Funkce pro získání asociativního pole výsledků z databáze
function fetchAssoc($sql, $conn) {
    $result = mysqli_query($conn, $sql);
    $pole = mysqli_fetch_array($result, MYSQLI_ASSOC);
    return $pole;
}

// Funkce pro získání indexovaného pole výsledků z databáze
function fetch($sql, $conn) {
    $result = mysqli_query($conn, $sql);
    $pole = mysqli_fetch_array($result, MYSQLI_NUM);
    return $pole;
}

// Funkce pro získání všech výsledků jako asociativního pole z databáze
function fetchAll($sql, $conn) {
    $result = mysqli_query($conn, $sql);
    $pole = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $pole;
}

// Funkce pro provedení akce v databázi (např. INSERT, UPDATE, DELETE)
function akce($sql, $conn) {
    if (mysqli_query($conn, $sql)) {
        return true; // Vrací true, pokud akce proběhla úspěšně
    } else {
        return false; // Vrací false, pokud došlo k chybě při provedení akce
    }
}
?>
