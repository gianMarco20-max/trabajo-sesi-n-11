<?php
require_once __DIR__ . "/../Controllers/clienteController.php";
$error = "";
try {
    $clientes = listarClientes();
} catch (Throwable $e) {
    $clientes = [];
    $error = $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listar Clientes</title>
    <style>
        body { font-family: Arial; margin: 30px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #999; padding: 8px; text-align: left; }
        th { background: #eee; }
        .msg { color: green; margin-bottom: 10px; }
        .err { color: #b00020; margin-bottom: 10px; }
    </style>
</head>
<body>
    <h2>Clientes</h2>
    <?php if ($error !== ""): ?>
        <p class="err">Error: <?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <?php if (!empty($_GET["msg"])): ?>
        <p class="<?= strpos($_GET["msg"], 'Error') === 0 ? 'err' : 'msg' ?>"><?= htmlspecialchars($_GET["msg"]) ?></p>
    <?php endif; ?>
    <p><a href="frmRegistrarcliente.php">+ Nuevo cliente</a> | <a href="../index.php">Inicio</a></p>

    <table>
        <tr><th>DNI</th><th>Nombres</th><th>Apellidos</th><th>Telefono</th><th>Email</th><th>Direccion</th><th>Acciones</th></tr>
        <?php foreach ($clientes as $c): ?>
        <tr>
            <td><?= htmlspecialchars($c["Dni"]) ?></td>
            <td><?= htmlspecialchars($c["Nombres"]) ?></td>
            <td><?= htmlspecialchars($c["Apellidos"]) ?></td>
            <td><?= htmlspecialchars($c["Telefono"] ?? "") ?></td>
            <td><?= htmlspecialchars($c["Email"] ?? "") ?></td>
            <td><?= htmlspecialchars($c["Direccion"] ?? "") ?></td>
            <td>
                <a href="frm_modificarcliente.php?id=<?= $c["IdCliente"] ?>">Modificar</a> |
                <a href="../Controllers/clienteController.php?accion=eliminar&id=<?= $c["IdCliente"] ?>"
                   onclick="return confirm('Eliminar este cliente?')">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
