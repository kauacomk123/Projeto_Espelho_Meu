<?php
require_once '../../conexao.php';

// Inicia a variável de busca
$termo_busca = '';
$clausula_where_busca = '';

// Verifica se o formulário de busca foi enviado
if (isset($_GET['busca']) && !empty($_GET['busca'])) {
    $termo_busca = $conn->real_escape_string($_GET['busca']);
    
    // Constrói a cláusula WHERE para buscar no nome, data, ou hora.
    // O LIKE %...% permite buscar partes do nome ou da data/hora.
    $clausula_where_busca = " AND (nome_cliente LIKE '%$termo_busca%' OR data_agendamento LIKE '%$termo_busca%')";
}

// A consulta principal agora inclui o filtro 'ativo = 1' E o termo de busca (se houver)
$sql = "SELECT id, nome_cliente, telefone, servico, data_agendamento, observacoes, data_registro 
        FROM agendamentos 
        WHERE ativo = 1 " // Esta cláusula WHERE é a base
        . $clausula_where_busca . " 
        ORDER BY data_agendamento ASC";
        
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>agendamentos cadastrados</title>
    <link rel="stylesheet" href="css/stylecarregar.css">
</head>



    <form method="GET" action="carregar.php">
    <input type="text" name="busca" placeholder="Buscar por Nome ou Data/Hora" value="<?php echo htmlspecialchars($_GET['busca'] ?? ''); ?>">
    <button type="submit">Buscar</button>
    
    <?php if (!empty($_GET['busca'])): ?>
        <a href="carregar.php">Limpar Busca</a>
    <?php endif; ?>
</form>
<body>
    <div class="link-voltar">
    <a href="../../frontend/agendamento.php">Voltar para a Tela de Cadastro</a>
</div>
<hr>
    
<h1>Agendamentos Cadastrados</h1>
<?php
echo "<div class='cards-container'>";
if ($result->num_rows > 0) {
    
    while ($row = $result->fetch_assoc()) {
        echo "
       
        <div class='card' id='agendamento-" . $row['id'] . "'> 
            <h3><strong>Nome: </strong>". htmlspecialchars($row['nome_cliente']) . "</h3>
            <p><strong>telefone:</strong> " . htmlspecialchars($row['telefone']) . "</p>
            <p><strong>servico:</strong> " . htmlspecialchars($row['servico']) . "</p>
            <p><strong>data de agendamento:</strong> " . htmlspecialchars($row['data_agendamento']) . "</p>
            <p><strong>observaçoes:</strong> " . htmlspecialchars($row['observacoes']) . "</p>
            <p><strong>data de registro:</strong> " . htmlspecialchars($row['data_registro']) . "</p>

            <button onclick=\"window.location.href='editar.php?id=" . $row['id'] . "'\">Editar</button>
            
            <button onclick=\"excluirAgendamento(" . $row['id'] . ")\" style='color: red;'>Excluir</button>

        </div>
        
        ";
    }
} else {
    echo "<p>Nenhum cliente cadastrado ainda.</p>";
}
echo "</div>";
$conn->close();
?>

<script>
        // Renomeei de 'excluirEvento' para 'excluirAgendamento' para ser mais claro
        function excluirAgendamento(id) {
            // Verifica se o usuário confirma a exclusão
            if (confirm("Tem certeza que deseja excluir este agendamento?")) {
                
                // Se sim, faz a requisição assíncrona para o script PHP
                // AJUSTE O CAMINHO 'excluir_agendamento.php' SE NECESSÁRIO!
                fetch("excluir_agendamento.php?id=" + id)
                    .then(response => response.text())
                    .then(data => {
                        // O PHP deve retornar apenas a palavra 'success'
                        if (data.trim() === "success") { 
                            alert("Agendamento excluído com sucesso!");
                            
                            // Remove o elemento visualmente da lista sem recarregar a página
                            // Usa o ID único que definimos na DIV
                            const card = document.getElementById('agendamento-' + id);
                            if (card) {
                                card.remove();
                            }
                        } else {
                            alert("Erro ao excluir: " + data);
                        }
                    })
                    .catch(error => {
                        alert("Erro de comunicação com o servidor.");
                        console.error('Fetch error:', error);
                    });
            }
        }
</script>
</body>
</html>