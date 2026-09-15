<?php
session_start();

// Se não estiver logado, manda de volta para o login
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

require_once 'header.php';
?>

<div class="container" style="max-width: 600px; margin: 50px auto; text-align: center;">
    <h1>Bem-vindo, <?= htmlspecialchars($_SESSION['nome'] ?? 'Usuário') ?>!</h1>
    <p>Você está logado no sistema.</p>

    <a href="logout.php" style="color: red; text-decoration: none; font-weight: bold;">Sair da conta (Logout)</a>
</div>