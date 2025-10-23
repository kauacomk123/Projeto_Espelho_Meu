<?php
require_once '../../conexao.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // MUDANÇA PRINCIPAL: Usa UPDATE em vez de DELETE para fazer o Soft Delete
    $sql = "UPDATE agendamentos SET ativo = 0 WHERE id = $id"; 
    
    if ($conn->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "Erro ao desativar agendamento: " . $conn->error;
    }
} else {
    echo "ID inválido";
}

$conn->close();
?>