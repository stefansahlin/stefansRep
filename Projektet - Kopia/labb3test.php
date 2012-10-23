<?php

require_once("Database.php");

session_start();
require_once('LoginView.php');
require_once('LoginHandler.php');


echo"Testar deletefunktionen";

$db = new mysqli("localhost", "root", "krokodil", "members");
//Okej det här fungerar uppenbarligen inte. 
var_dump($db);
$name = "hejsan";
$password = "hejsan1";
$members2 = "members2";
$stmt = $db->query("DELETE FROM ". $members2 . " WHERE username = ?"); 
$stmt->bind_param("ss", $name, $password); 
$stmt->execute();
$stmt->close();

echo"Testar insertfunktionen";
var_dump($db);
$name = "hejsan2";
$password = "hejsan2";
$sql = "INSERT INTO " . $members2 . "(Username, Password) VALUES(?, ?)"; 
$stmt->bind_param("ss", $name, $password); 
$stmt->execute();
$stmt->close();
