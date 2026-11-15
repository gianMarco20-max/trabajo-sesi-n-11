<?php
require_once __DIR__ . "/../Controllers/cursoController.php";
$c = obtenerCurso((int)($_GET["id"] ?? 0));
if (!$c) { header("Location: frmConsultar.php?msg=" . urlencode("Curso no encontrado")); exit; }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Modificar Curso</title>
    <style>
        body { font-family: Arial; margin: 30px; }
        label { display: block; margin-top: 10px; }
        input { padding: 5px; width: 250px; }
        button { margin-top: 15px; padding: 6px 14px; }
    </style>
</head>
<body>
    <h2>Modificar curso</h2>
    <form action="../Controllers/cursoController.php" method="post">
        <input type="hidden" name="accion" value="modificar">
        <input type="hidden" name="id" value="<?= $c["IdCurso"] ?>">

        <label>Codigo</label>
        <input type="text" name="codigo" maxlength="10" value="<?= htmlspecialchars($c["Codigo"]) ?>" required>

        <label>Nombre</label>
        <input type="text" name="nombre" maxlength="100" value="<?= htmlspecialchars($c["Nombre"]) ?>" required>

        <label>Creditos</label>
        <input type="number" name="creditos" min="1" max="10" value="<?= $c["Creditos"] ?>" required>

        <label>Ciclo</label>
        <input type="number" name="ciclo" min="1" max="10" value="<?= $c["Ciclo"] ?>" required>

        <button type="submit">Actualizar</button>
        <a href="frmConsultar.php">Cancelar</a>
    </form>
</body>
</html>
