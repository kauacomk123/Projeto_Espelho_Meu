<?php

$host = "localhost";
$user = "root"; // usuário padrão do XAMPP
$password = "password"; // sua senha
$database = "espelho_meu"; // nome do seu banco

// Criar conexão
$conn = new mysqli($host, $user, $password, $database);

// Verificar se conectou
if ($conn->connect_error) {
    die("❌ Falha na conexão: " . $conn->connect_error);
}

?>
