<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado del Formulario</title>
</head>
<body>
    <?php
        require('conexion.php');

        function escapar(string $dato): string {
            return htmlspecialchars($dato, ENT_QUOTES, 'UTF-8');
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $nombre = trim($_POST['nombre'] ?? '');
            $correo = trim($_POST['correo'] ?? '');
            $fecha_nacimiento = $_POST['fecha_nacimiento'] ?? '';

            $fecha = DateTime::createFromFormat('Y-m-d', $fecha_nacimiento);
            $fechaValida = $fecha && $fecha->format('Y-m-d') === $fecha_nacimiento;

            if ($nombre === '' || !filter_var($correo, FILTER_VALIDATE_EMAIL) || !$fechaValida) {
                echo "<h3 style='color: red;'>Revisa los datos ingresados.</h3>";
                exit;
            }

            try {
                $stmt = $conn->prepare(
                    'INSERT INTO formulario1 (nombre, correo, fechanacimiento) VALUES (:nombre, :correo, :fecha)'
                );
                $stmt->execute([
                    ':nombre' => $nombre,
                    ':correo' => $correo,
                    ':fecha' => $fecha_nacimiento,
                ]);

                echo "<h3 style='color: green;'>Datos guardados correctamente.</h3>";
            } catch (PDOException $e) {
                if ($e->getCode() === '23000') {
                    echo "<h3 style='color: red;'>Ese correo ya está registrado.</h3>";
                } else {
                    echo "<h3 style='color: red;'>No se pudieron guardar los datos.</h3>";
                }
                exit;
            }

            echo "<h2>Datos Recibidos:</h2>";
            echo "<p><strong>Nombre:</strong> " . escapar($nombre) . "</p>";
            echo "<p><strong>Correo:</strong> " . escapar($correo) . "</p>";
            echo "<p><strong>Fecha de Nacimiento:</strong> " . escapar($fecha_nacimiento) . "</p>";
            
        } else {
            echo "<h2>Acceso denegado.</h2>";
            echo "<p>Por favor envía el formulario desde la página principal.</p>";
        }
    ?>
</body>
</html>
