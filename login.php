<?php
session_start();

if (isset($_SESSION['id'])) {
    header("Location: index.php");
    exit;
}

require_once 'config.php';
require_once 'Usuario.php';

$erro = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $senha = $_POST['senha'] ?? '';

    if (!empty($email) && !empty($senha)) {
        // Instancia a classe Usuario com os 3 parâmetros exigidos
        $u = new Usuario("", $email, $senha);

        // Busca todos os registros do banco
        $sql = "SELECT * FROM usuarios";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $usuarioEncontrado = null;

        // Percorre os registros buscando pelo hash do email de forma segura
        foreach ($usuarios as $usr) {
            // Tenta localizar a chave do e-mail independente do nome no banco
            $emailBanco = $usr['email'] ?? $usr['EMAIL'] ?? $usr['email_usuario'] ?? reset($usr);

            if (password_verify($u->getEmail(), $emailBanco)) {
                $usuarioEncontrado = $usr;
                break;
            }
        }

        if ($usuarioEncontrado) {
            // Tenta localizar a chave da senha no array retornado
            $senhaBanco = $usuarioEncontrado['senha'] ?? $usuarioEncontrado['SENHA'] ?? $usuarioEncontrado['senha_usuario'] ?? '';

            if (password_verify($u->getSenha(), $senhaBanco)) {
                // Salva os dados na sessão (ajuste as chaves se necessário)
                $_SESSION['id'] = $usuarioEncontrado['id'] ?? $usuarioEncontrado['ID'] ?? 1;
                $_SESSION['nome'] = $usuarioEncontrado['nome'] ?? $usuarioEncontrado['NOME'] ?? '';

                header("Location: index.php");
                exit;
            } else {
                $erro = "E-mail e/ou senha incorretos!";
            }
        } else {
            $erro = "E-mail e/ou senha incorretos!";
        }
    } else {
        $erro = "Preencha todos os campos!";
    }
}

require_once 'header.php';
?>

<div class="container" style="max-width: 400px; margin: 50px auto;">
    <h2>Acessar Conta</h2>

    <?php if (!empty($erro)): ?>
        <div class="alert alert-danger" style="color: red; margin-bottom: 15px;">
            <?php echo htmlspecialchars($erro); ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="login.php">
        <div class="form-group" style="margin-bottom: 15px;">
            <label for="email">E-mail:</label>
            <input type="email" name="email" id="email" class="form-control" style="width: 100%; padding: 8px;" required>
        </div>

        <div class="form-group" style="margin-bottom: 15px;">
            <label for="senha">Senha:</label>
            <input type="password" name="senha" id="senha" class="form-control" style="width: 100%; padding: 8px;" required>
        </div>

        <button type="submit" class="btn btn-primary" style="width: 100%; padding: 10px; cursor: pointer;">Entrar</button>
    </form>

    <p style="margin-top: 15px;">
        <a href="cadastrar.php">Não tem uma conta? Cadastre-se aqui</a>
    </p>
</div>