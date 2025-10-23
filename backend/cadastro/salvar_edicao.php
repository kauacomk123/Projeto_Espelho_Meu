<?php
require_once '../../conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = isset($_POST['id']) ? intval($_POST['id']) : 0; 
    
    $nome_cliente = $conn->real_escape_string($_POST['nome_clinte']);
    $telefone = $conn->real_escape_string($_POST['telefone']);
    
    // O nome da coluna é 'servicos' (o que você adicionou no MySQL)
    $servico = $conn->real_escape_string($_POST['servico']); 
    
    $data_agendamento = $conn->real_escape_string($_POST['data_agendamento']);
    $observacoes = $conn->real_escape_string($_POST['observacoes']);

    // Verifica se o ID é válido antes de prosseguir
    if ($id > 0) {
        
        // 3. Monta e executa o comando SQL UPDATE
        $sql_update = "UPDATE agendamentos SET 
                        nome_cliente = '$nome_cliente', 
                        telefone = '$telefone', 
                        servico = '$servico', 
                        data_agendamento = '$data_agendamento', 
                        observacoes = '$observacoes' 
                        WHERE id = $id";

        if ($conn->query($sql_update) === TRUE) {
            // Sucesso na atualização: Redireciona o usuário de volta para a lista ou para o formulário
            // Adicionamos 'sucesso=1' para que a página 'carregar.php' possa exibir uma mensagem
            header("Location: carregar.php?sucesso=1"); 
            exit();
        } else {
            // Erro na atualização
            die("Erro ao atualizar o registro: " . $conn->error);
        }
    } else {
        die("ID do cliente inválido ou ausente.");
    }

} else {
    // Se a página foi acessada diretamente, sem submissão do formulário
    header("Location: carregar.php");
    exit();
}

$conn->close();
?>