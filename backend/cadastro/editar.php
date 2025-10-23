<?php
require_once '../../conexao.php';

if (!isset($_GET['id'])) {
    die("ID do cliente nao informado!");
}

$id = intval($_GET['id']);
$sql = "SELECT * FROM agendamentos WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    die("cliente nao encontrado!");
}

$evento = $result->fetch_assoc();
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../frontend/agendamento.css">
    <title>Editar dados cliente</title>
</head>
<body>

     <section class="form-agenda">
    <div class="container">
    <h2>Editar cliente</h2>
    <form method="POST" action="salvar_edicao.php">
        <input type="hidden" name="id" value="<?= $evento['id'] ?>">

        <label>Nome do cliente:</label>
        <input type="text" name="nome_clinte" value="<?= $evento['nome_cliente'] ?>" required>

        <label>telefone do cliente:</label>
        <input type="text" name="telefone" value="<?= $evento['telefone'] ?>" required>

       <label for="servico">Serviço Solicitado</label>
        <select name="servico" id="servico"  value="<?= $evento ['servico'] ?>">
           <option value="">-- Selecione um Serviço --</option>
            <option value="Corte de Cabelo">Corte de Cabelo</option>
            <option value="Manicure e Pedicure">Manicure e Pedicure</option>
            <option value="Maquiagem">Maquiagem</option>
            <option value="hidratação">hidratação</option>
            <option value="designer">designer de sobracelha</option>
            <option value="Outro">Outro</option>
        </select>

        <label>data de agendamento:</label>
        <input type="datetime-local" name="data_agendamento" value="<?= $evento['data_agendamento'] ?>" required>

         <label>observacoes:</label>
        <input type="text" name="observacoes" value="<?= $evento['observacoes'] ?>" required>

    
        <button type="submit">Salvar Alterações</button><br>
        <br><a class="voltar" href="carregar.php">voltar</a>
    </form>
</div>
</section>

</body>
</html>