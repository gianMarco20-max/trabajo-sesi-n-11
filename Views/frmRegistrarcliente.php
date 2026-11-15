<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Cliente</title>
    <style>
        body { font-family: Arial; margin: 30px; }
        label { display: block; margin-top: 10px; }
        input { padding: 5px; width: 250px; }
        button { margin-top: 15px; padding: 6px 14px; }
        .error-field { border: 2px solid #ff9800; background: #fff3e0; }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const requiredFields = ['dni', 'nombres', 'apellidos'];

            form.addEventListener('submit', function(e) {
                let hayVacios = false;
                let primerVacio = null;

                // Limpiar estilos previos
                requiredFields.forEach(name => {
                    const input = form.querySelector('input[name="' + name + '"]');
                    input.classList.remove('error-field');
                });

                // Verificar campos requeridos
                requiredFields.forEach(name => {
                    const input = form.querySelector('input[name="' + name + '"]');
                    if (!input.value.trim()) {
                        hayVacios = true;
                        input.classList.add('error-field');
                        if (!primerVacio) primerVacio = input;
                    }
                });

                if (hayVacios) {
                    e.preventDefault(); // NO envía al servidor
                    alert('Datos incompletos'); // Alert naranja (caja naranja)
                    if (primerVacio) {
                        primerVacio.focus(); // Flecha naranja: regresa al usuario
                    }
                    return false;
                }
                // Si pasa, se envía al servidor normalmente
            });
        });
    </script>
</head>
<body>
    <h2>Registrar cliente</h2>
    <form action="../Controllers/clienteController.php" method="post">
        <input type="hidden" name="accion" value="insertar">

        <label>DNI</label>
        <input type="text" name="dni" maxlength="8" pattern="\d{8}" title="8 digitos" required>

        <label>Nombres</label>
        <input type="text" name="nombres" maxlength="60" required>

        <label>Apellidos</label>
        <input type="text" name="apellidos" maxlength="60" required>

        <label>Telefono</label>
        <input type="text" name="telefono" maxlength="15">

        <label>Email</label>
        <input type="email" name="email" maxlength="80">

        <label>Direccion</label>
        <input type="text" name="direccion" maxlength="120">

        <button type="submit">Guardar</button>
        <a href="frmListarcliente.php">Cancelar</a>
    </form>
</body>
</html>