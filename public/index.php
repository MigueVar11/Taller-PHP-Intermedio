<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversor de Monedas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1 class="mt-5" style="color: blue;">Conversor de Monedas</h1>
        <form action="index.php" method="POST" class="mt-4">
    <div class="form-group mb-3">
        <label for="cantidad">Cantidad en Pesos Colombianos (COP):</label>
        <input type="number" class="form-control" id="cantidad" name="cantidad" required>
    </div>
    <div class="form-group mb-3">
        <label for="moneda">Moneda de conversión:</label>
        <select class="form-control" id="moneda" name="moneda" required>
            <option value="USD">Dólares (USD)</option>
            <option value="EUR">Euros (EUR)</option>
            <option value="GBP">Libras Esterlinas (GBP)</option>
            <option value="JPY">Yen Japonés (JPY)</option>
        </select>
    </div>
    <div class="form-group mb-3">
                <label for="email">Email para recibir el resultado:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary" name="accion" value="convertirMoneda">Convertir y Enviar PDF</button>
        </form>

</form>
        <br>
        <h1 class="mt-5" style="color:lightseagreen;">Calcular el área de un círculo</h1>
        <form action="index.php" method="POST" class="mt-4">
            <div class="form-group mb-3">
                <label for="radio">Radio del círculo:</label>
                <input type="number" class="form-control" id="radio" name="radio" required>
            </div>
            <div class="form-group mb-3">
                <label for="email">Email para recibir el resultado:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <button type="submit" class="btn btn-info" name="accion" value="calcularArea">Calcular Área y Enviar PDF</button>
        </form>

        <?php
        // PHP code
        require '../vendor/autoload.php';

        use App\Controllers\ControladorPrincipal;

        $controlador = new ControladorPrincipal();

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion'])) {
            $email = $_POST['email'];  // Correo electrónico del usuario
            $contenido = '';

            // Proceso de conversión de monedas
            if ($_POST['accion'] === 'convertirMoneda') {
        $cantidad = $_POST['cantidad'];
        $moneda = $_POST['moneda'];
        $cantidadConvertida = $controlador->convertirMoneda($cantidad, $moneda);
        $contenido = "Resultado: $cantidad pesos colombianos es igual a $cantidadConvertida $moneda.";
        echo "<div class='alert alert-success mt-3'>$contenido</div>";

        // Enviar el correo con PDF adjunto
        $controlador->enviarCorreo($email, $contenido);
    }

            // Proceso de cálculo del área de un círculo
            if ($_POST['accion'] === 'calcularArea') {
                $radio = $_POST['radio'];
                $area = $controlador->calcularAreaCirculo($radio);
                $contenido = "Resultado: El area de un circulo con radio $radio es $area.";
                echo "<div class='alert alert-info mt-3'>";
                echo $contenido;
                echo "</div>";

                // Enviar el correo con PDF adjunto
                $controlador->enviarCorreo($email, $contenido);
            }
        }
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>