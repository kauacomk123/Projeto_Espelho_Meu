<?php

$host = "localhost";
$user = "root"; // usuário padrão do XAMPP
$password = "*****"; // sua senha
$database = "********"; // nome do seu banco

// Criar conexão
$conn = new mysqli($host, $user, $password, $database);

// Verificar se conectou
if ($conn->connect_error) {
    die("❌ Falha na conexão: " . $conn->connect_error);
}

?>

