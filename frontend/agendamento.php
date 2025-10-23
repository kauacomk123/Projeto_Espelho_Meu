<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="agendamento.css">
    <title>Espelho Meu</title>
</head>
<body>
    <header class="logo-login2">
         <section class="menu">
        <a href="../backend/cadastro/carregar.php ">
            <img src="imagens/Lista.png" alt="Lista de Agendamento">
        </a>
        <a href="../administrador/adm.php">
            <img src="imagens/Porta.png" alt="Desconectar">
        </a>
        </section>
        <img src="imagens/LOGO_PRETA.png" alt="Logo Espelho Meu" height="100px" height="300px">
        <h2>Realce sua beleza natural</h2>
    </header>
    <section class="tela_bem-vindo">
        <h1>Bem-vindos ao Seu Momento</h1>
        <p>No Espelho Meu, cada cliente é único. Oferecemos serviços personalizados de beleza em um ambiente acolhedor e sofisticado</p>
    </section>
    <?php
    // O bloco PHP deve ser colocado AQUI para exibir a mensagem
    // Se a URL contém ?erro=conflito, ele mostrará o alerta.
    if (isset($_GET['erro']) && $_GET['erro'] == 'conflito') {
        echo '<p style="color: red; font-weight: bold; border: 1px solid red; padding: 10px;">
                  ERRO: Este horário já está reservado. Por favor, escolha outra data ou hora.
              </p>';
    }
    ?>
    <section class="form-agenda">
        <div class="container">
            <h2>AGENDE SEU HORÁRIO</h2>
            <form method="POST" action="../backend/cadastro/processar_agendamento.php">

                <label>Nome do cliente:</label>
                <input type="text" id="nome_cliente" name="nome_cliente" required>

                <label>Telefone do cliente:</label>
                <input type="text" name="telefone" id="telefone" required>

                <label for="servico">Serviço solicitado:</label>
                <select name="servico" id="servico" required>
                    <option value=""> Selecione um Serviço </option>
                    <option value="Corte de Cabelo">Corte de Cabelo</option>
                    <option value="Manicure e Pedicure">Manicure e Pedicure</option>
                    <option value="Maquiagem">Maquiagem</option>
                    <option value="Hidratação">Hidratação</option>
                    <option value="Designer de Sobrancelha">Designer de Sobrancelha</option>
                    <option value="Outro">Outro</option>
                </select>

                <label for="data_agendamento">Data e Horário do Agendamento:</label>
                <input type="datetime-local" name="data_agendamento" value="" name="data_agendamento" required>

                 <label for="observacoes">Observações:</label>
                <input type="text" name="observacoes" id="observacoes" >

                <button type="submit">Confirmar Agendamento</button>
            </form>
        </div>
    </section>
    <section class="contatos">
    <h3>Informações de Contato</h3>
    <div class="contato-container">
        <div class="contato-item">
            <img src="imagens/phone-call.png" alt="Telefone">
            <h4>Telefone</h4>
            <p>(11) 99999-9999</p>
        </div>
        <div class="contato-item">
            <img src="imagens/location-pin.png" alt="Localização">
            <h4>Localização</h4>
            <p>Rua da Beleza, 123<br>São Paulo - SP</p>
        </div>
        <div class="contato-item">
            <img src="imagens/instagram.png" alt="Instagram">
            <h4>Instagram</h4>
            <p>@espelho.meu</p>
        </div>
    </div>
</section>

<footer class="rodape">
    <img src="imagens/LOGO_ROSA.png" alt="Logo Espelho Meu" height="60px">
    <p>Segunda a Sábado<br>9h às 19h</p>
</footer>
</body>
</html>