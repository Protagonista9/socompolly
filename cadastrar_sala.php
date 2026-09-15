<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

require_once 'config.php';
require_once 'Sala.php';

$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
    $numero = filter_input(INPUT_POST, 'numero', FILTER_SANITIZE_SPECIAL_CHARS);
    $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_SPECIAL_CHARS);
    $referencia = filter_input(INPUT_POST, 'referencia', FILTER_SANITIZE_URL);

    if (!empty($nome) && !empty($numero)) {
        $sala = new Sala($nome, $numero, $descricao, $referencia);

        try {
            // 1. Cadastra a sala
            $stmt1 = $pdo->prepare("INSERT INTO sala (nome, numero) VALUES (:nome, :numero)");
            $stmt1->bindValue(':nome', $sala->getNome());
            $stmt1->bindValue(':numero', $sala->getNumero());
            $stmt1->execute();

            $sala_id = $pdo->lastInsertId();

            // 2. Cadastra o objeto vinculado a essa sala
            $stmt2 = $pdo->prepare("INSERT INTO objetos (nome, descricao, referencia, sala_id) VALUES (:nome, :descricao, :referencia, :sala_id)");
            $stmt2->bindValue(':nome', $sala->getNome());
            $stmt2->bindValue(':descricao', $sala->getDescricao());
            $stmt2->bindValue(':referencia', $sala->getReferencia());
            $stmt2->bindValue(':sala_id', $sala_id);
            $stmt2->execute();

            header("Location: salas.php");
            exit;
        } catch (PDOException $e) {
            $mensagem = "Erro ao cadastrar: " . $e->getMessage();
        }
    } else {
        $mensagem = "Preencha o nome e o número da sala.";
    }
}

require_once 'header.php';
?>

<div style="max-width: 400px; margin: 30px auto; padding: 20px; border: 1px solid #ccc; border-radius: 8px;">
    <h2>Cadastrar Sala</h2>

    <?php if (!empty($mensagem)): ?>
        <p style="color: red;"><?php echo htmlspecialchars($mensagem); ?></p>
    <?php endif; ?>

    <form method="POST" action="cadastrar_sala.php">
        <div style="margin-bottom: 12px;">
            <label for="nome">Nome da Sala:</label><br>
            <input type="text" name="nome" id="nome" style="width: 100%; padding: 8px;" required>
        </div>

        <div style="margin-bottom: 12px;">
            <label for="numero">Número da Sala:</label><br>
            <input type="text" name="numero" id="numero" style="width: 100%; padding: 8px;" required>
        </div>

        <div style="margin-bottom: 12px;">
            <label for="descricao">Descrição do Objeto:</label><br>
            <textarea name="descricao" id="descricao" style="width: 100%; padding: 8px;" rows="3"></textarea>
        </div>

        <div style="margin-bottom: 12px;">
            <label for="referencia">Manual/Referência (URL do PDF):</label><br>
            <input type="text" name="referencia" id="referencia" style="width: 100%; padding: 8px;" placeholder="http://exemplo.com/manual.pdf">
        </div>

        <button type="submit" style="width: 100%; padding: 10px; background: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer;">Cadastrar</button>
    </form>
</div>