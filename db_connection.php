<?php

// Configurações do banco de dados
define('DB_HOST', 'localhost'); // Altere se necessário
define('DB_NAME', 'radius'); // Substitua pelo nome do seu banco
define('DB_USER', 'radius'); // Usuário do banco de dados
define('DB_PASS', 'SENHADB'); // Senha do banco de dados

try {
    // Criar conexão PDO
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão com o banco de dados: " . $e->getMessage());
}

?>
