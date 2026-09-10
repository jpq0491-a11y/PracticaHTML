<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado del Formulario</title>
</head>
<body>
    <?php 
        
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            $nombre = test_input($_POST['nombre']);
            $correo = test_input($_POST['correo']);
            $fecha_nacimiento = test_input($_POST['fecha_nacimiento']);

            echo "<h2>Datos Recibidos:</h2>";
            echo "<p><strong>Nombre:</strong> " . $nombre . "</p>";
            echo "<p><strong>Correo:</strong> " . $correo . "</p>";
            echo "<p><strong>Fecha de Nacimiento:</strong> " . $fecha_nacimiento . "</p>";
            
        } else {
            echo "<h2>Acceso denegado.</h2>";
            echo "<p>Por favor envía el formulario desde la página principal.</p>";
        }
    ?>
</body>
</html>