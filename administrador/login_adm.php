<?php

require_once '../conexao.php';


// Pegando dados do formulário
$administrador = $_POST['administrador'];
$senha_adm = $_POST['senha_adm'];

// Consulta ao banco
$sql = "SELECT * FROM administrador WHERE administrador = ? AND senha_adm = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $administrador, $senha_adm);
$stmt->execute();
$result = $stmt->get_result();

// Verifica se encontrou usuário
if ($result->num_rows > 0) {
    $usuario = $result->fetch_assoc();

   // Use este caminho se carregar.php estiver um nível acima do seu script de login
header("Location: ../frontend/agendamento.php");
   
} else {
    echo "Administrador ou senha incorretos.";
}

$conn->close();
?>