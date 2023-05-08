<?php

$config = require 'database.php';

try {
    $pdo = new PDO(
        "{$config['driver']}:host={$config['host']};dbname={$config['database']};charset={$config['charset']}",
        $config['username'],
        $config['password']
    );

    // Habilitar el modo de errores PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $pdo;
} catch (PDOException $e) {
    echo 'Error al conectar con la base de datos: ' . $e->getMessage();
    exit;
}

?>