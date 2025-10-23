<?php
// Inicie a sessão se necessário para este fluxo
session_start(); 

require_once '../../conexao.php'; // Inclua a conexão

// 1. Pegando dados do formulário e limpando
$nome_cliente = $conn->real_escape_string($_POST['nome_cliente']);
$telefone = $conn->real_escape_string($_POST['telefone']);
$servico = $conn->real_escape_string($_POST['servico']);
$data_agendamento = $conn->real_escape_string($_POST['data_agendamento']); // Variável crucial para validação
$observacoes = $conn->real_escape_string($_POST['observacoes']);

// ==================================================================
// NOVO BLOCO: Validação de Conflito de Agendamento
// ==================================================================

// Consulta para verificar se já existe um agendamento ATIVO (ativo = 1) no mesmo horário
$sql_check = "SELECT id FROM agendamentos WHERE data_agendamento = ? AND ativo = 1";

// Usa Prepared Statement para segurança
$stmt_check = $conn->prepare($sql_check);

// O tipo é 's' (string) porque data_agendamento é uma string de data/hora
$stmt_check->bind_param("s", $data_agendamento); 
$stmt_check->execute();
$result_check = $stmt_check->get_result();

if ($result_check->num_rows > 0) {
    // Conflito Encontrado!
    $stmt_check->close();
    $conn->close();
    
    // Redireciona de volta ao formulário de agendamento com um erro
    // AJUSTE O CAMINHO PARA SEU FORMULÁRIO DE CADASTRO! (Ex: ../cadastro_cliente.php)
    header("Location: ../../frontend/agendamento.php?erro=conflito"); 
    exit();
}

$stmt_check->close();

// ==================================================================
// FIM DA VALIDAÇÃO
// ==================================================================


// 2. Se não há conflito, prossegue com a inserção

// Comando SQL para INSERT (incluindo 'ativo = 1' por padrão)
$sql_insert = "INSERT INTO agendamentos (nome_cliente, telefone, servico, data_agendamento, observacoes, ativo) 
               VALUES (?, ?, ?, ?, ?, 1)";

$stmt_insert = $conn->prepare($sql_insert);

// O tipo é 'sssss' para 5 campos string (VARCHAR)
$stmt_insert->bind_param("sssss", $nome_cliente, $telefone, $servico, $data_agendamento, $observacoes);

if ($stmt_insert->execute()) {
    // Sucesso: Redireciona para uma página de sucesso ou de listagem
    header("Location: carregar.php"); 
    exit();
} else {
    // Erro na inserção
    echo "Erro ao cadastrar agendamento: " . $stmt_insert->error;
}

$stmt_insert->close();
$conn->close();
?>