<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Sistema Pollyana</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .nav-bar {
            background-color: #333;
            padding: 12px 20px;
        }
        .nav-bar a {
            color: white;
            margin-right: 15px;
            text-decoration: none;
            font-weight: bold;
        }
        .nav-bar a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="nav-bar">
    <a href="index.php">Início</a>
    
    <?php if (isset($_SESSION['id'])): ?>
        <!-- Opções exibidas apenas quando está logado -->
        <a href="salas.php">Salas</a>
        <a href="logout.php">Sair</a>
    <?php else: ?>
        <!-- Opções para quem não está logado -->
        <a href="login.php">Login</a>
        <a href="cadastrar.php">Cadastrar</a>
    <?php endif; ?>
</div>