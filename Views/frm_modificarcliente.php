<?php
require_once __DIR__ . "/../Controllers/clienteController.php";
try {
    $c = obtenerCliente((int)($_GET["id"] ?? 0));
} catch (Throwable $e) {
    header("Location: frmListarcliente.php?msg=" . urlencode("Error: " . $e->getMessage()));
    exit;
}
if (!$c) { header("Location: frmListarcliente.php?msg=" . urlencode("Cliente no encontrado")); exit; }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Cliente</title>
    <style>
        body { font-family: Arial; margin: 30px; }
        label { display: block; margin-top: 10px; }
        input { padding: 5px; width: 250px; }
        button { margin-top: 15px; padding: 6px 14px; }
    </style>
</head>
<body>
    <h2>Modificar cliente</h2>
    <form action="../Controllers/clienteController.php" method="post">
        <input type="hidden" name="accion" value="modificar">
        <input type="hidden" name="id" value="<?= $c["IdCliente"] ?>">

        <label>DNI</label>
        <input type="text" name="dni" maxlength="8" pattern="\d{8}" title="8 digitos" value="<?= htmlspecialchars($c["Dni"]) ?>" required>

        <label>Nombres</label>
        <input type="text" name="nombres" maxlength="60" value="<?= htmlspecialchars($c["Nombres"]) ?>" required>

        <label>Apellidos</label>
        <input type="text" name="apellidos" maxlength="60" value="<?= htmlspecialchars($c["Apellidos"]) ?>" required>

        <label>Telefono</label>
        <input type="text" name="telefono" maxlength="15" value="<?= htmlspecialchars($c["Telefono"] ?? "") ?>">

        <label>Email</label>
        <input type="email" name="email" maxlength="80" value="<?= htmlspecialchars($c["Email"] ?? "") ?>">

        <label>Direccion</label>
        <input type="text" name="direccion" maxlength="120" value="<?= htmlspecialchars($c["Direccion"] ?? "") ?>">

        <button type="submit">Actualizar</button>
        <a href="frmListarcliente.php">Cancelar</a>
    </form>
</body>
</html>
