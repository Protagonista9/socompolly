<?php

require_once 'header.php';
?>

<!DOCTYPE html>
<!-- Marca o início de um documento HTML5 -->

<html lang="pt-BR">
<!-- Define o idioma principal do documento como português do Brasil -->

<head>
    <!-- Início do cabeçalho do documento -->

    <meta charset="UTF-8">
    <!-- Define o padrão de caracteres utilizado pelo documento -->

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Faz a página se adaptar à largura da tela do dispositivo -->

    <title>Cadastro</title>
    <!-- Define o nome que aparece na aba do navegador -->

</head>
<!-- Fim do cabeçalho do documento -->

<body>
    <!-- Início do corpo do documento -->

    <h1>Cadastro</h1>
    <!-- Título principal da página -->

    <form action="cadastrar.php" method="post">
        <!-- Envia os dados do formulário para cadastrar.php usando POST -->
        <!-- POST não coloca os dados na URL; GET coloca os dados na URL -->

        <label for="nome">Nome:</label>
        <!-- Label associado ao campo cujo id é "nome" -->

        <input type="text" id="nome" name="nome" required>
        <!-- type define o tipo do campo -->
        <!-- id identifica o elemento na página -->
        <!-- name define o nome da informação enviada pelo formulário -->
        <!-- required torna o preenchimento obrigatório -->

        <label for="email">E-mail:</label>
        <!-- Label associado ao campo cujo id é "email" -->

        <input type="email" id="email" name="email" required>
        <!-- type="email" permite ao navegador validar o formato básico de e-mail -->

        <label for="senha">Senha:</label>
        <!-- Label associado ao campo cujo id é "senha" -->

        <input type="password" id="senha" name="senha" required>
        <!-- password oculta os caracteres digitados -->
        <!-- required torna o preenchimento obrigatório -->

        <button type="submit">Cadastrar</button>
        <!-- Envia o formulário -->

    </form>

</body>
<!-- Fim do corpo do documento -->

</html>
<!-- Fim do documento HTML -->