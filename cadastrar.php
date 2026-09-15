<?php
require_once 'config.php'; 
require_once 'Usuario.php'; //eu tava apanhando aqui 

// Verifica se a requisição foi feita via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitização e validação dos dados recebidos do formulário
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $senha = $_POST['senha'] ?? '';

    if (!$nome || !$email || empty($senha)) {
        die("Por favor, preencha todos os campos corretamente.");
    }

    // Instancia o objeto Usuario com os dados fornecidos
    $usuario = new Usuario($nome, $email, $senha);

    // Gera o hash seguro da senha
    $senhaHash = password_hash($usuario->getSenha(), PASSWORD_DEFAULT);
    $emailHash = password_hash($usuario->getEmail(), PASSWORD_DEFAULT);


    try {
        // Prepara a instrução SQL utilizando a conexão $pdo
        $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)";
        $stmt = $pdo->prepare($sql);
        
        $stmt->bindValue(':nome', $usuario->getNome());
        $stmt->bindValue(':email', $emailHash);
        $stmt->bindValue(':senha', $senhaHash);

        if ($stmt->execute()) {
            echo "Usuário cadastrado com sucesso!";
        }
    } catch (PDOException $e) {
        // Trata duplicidade de e-mail ou erros de banco
        if ($e->getCode() == 23000) {
            echo "Erro: Este e-mail já está cadastrado.";
        } else {
            echo "Erro ao cadastrar: " . $e->getMessage();
        }
    }
} else {
    // Redireciona de volta para o formulário caso o acesso não seja via POST
    header("Location: cadastro.php");
    exit;
}