<?php
declare(strict_types=1);

/* Conexión local de Laragon a la base de datos del formulario. */
$dsn = 'mysql:host=127.0.0.1;port=3306;dbname=formulario;charset=utf8mb4';

try {
    $conn = new PDO($dsn, 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    exit('No fue posible conectar con la base de datos.');
}
