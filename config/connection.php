<?php

$hostname = "localhost";
$user = "senac";
$password = "senac";
$database = "aularevisao";

$chave = "zXW3x14WYB"; // SELECT MD5 (CONCAT ('SENHADOUSUARIO', 'zXW3x14WYB')) AS md5_string;


$pdo = new PDO("mysql:host=$hostname;dbname=$database", $user, $password);