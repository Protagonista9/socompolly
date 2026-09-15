<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

require_once 'header.php';
require_once 'config.php';
require_once 'Sala.php';

echo "<div style='padding: 20px;'>";
echo "<h2>Salas Cadastradas</h2>";
echo "<a href='cadastrar_sala.php' style='display: inline-block; margin-bottom: 15px; padding: 8px 12px; background: #28a745; color: white; text-decoration: none; border-radius: 4px;'>+ Cadastrar Nova Sala</a>";

try {
    $sql = "SELECT s.nome AS sala_nome, s.numero, o.descricao, o.referencia 
            FROM sala s 
            LEFT JOIN objetos o ON o.sala_id = s.id";
    
    $stmt = $pdo->query($sql);
    $registros = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($registros)) {
        echo "<div style='display: flex; flex-wrap: wrap; gap: 15px;'>";
        
        foreach ($registros as $row) {
            $sala = new Sala($row['sala_nome'], $row['numero'], $row['descricao'] ?? '', $row['referencia'] ?? '');

            echo "<div style='border: 1px solid #ddd; border-radius: 8px; padding: 15px; width: 280px; background: #f9f9f9;'>";
            echo "<h3 style='margin-top:0;'>" . htmlspecialchars($sala->getNome()) . " (Nº " . htmlspecialchars($sala->getNumero()) . ")</h3>";
            echo "<p><b>Descrição:</b> " . htmlspecialchars($sala->getDescricao()) . "</p>";
            
            if (!empty($sala->getReferencia())) {
                echo "<p><a href='" . htmlspecialchars($sala->getReferencia()) . "' target='_blank' style='display: inline-block; padding: 8px 12px; background: #007bff; color: white; text-decoration: none; border-radius: 4px;'>📄 Abrir Manual (PDF)</a></p>";
            } else {
                echo "<p style='color: #666;'><i>Sem manual cadastrado</i></p>";
            }
            
            echo "</div>";
        }
        
        echo "</div>";
    } else {
        echo "<p>Nenhuma sala cadastrada no momento.</p>";
    }
} catch (PDOException $e) {
    echo "<p style='color:red;'>Erro ao buscar salas: " . $e->getMessage() . "</p>";
}

echo "</div>";
?>