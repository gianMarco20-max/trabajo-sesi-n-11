<?php
require_once __DIR__ . "/../Controllers/cursoController.php";
$cursos = listarCursos();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consultar Cursos</title>
    <style>
        body { font-family: Arial; margin: 30px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #999; padding: 8px; text-align: left; }
        th { background: #eee; }
        .msg { color: green; margin-bottom: 10px; }
    </style>
</head>
<body>
    <h2>Cursos</h2>
    <?php if (!empty($_GET["msg"])) echo "<p class='msg'>" . htmlspecialchars($_GET["msg"]) . "</p>"; ?>
    <p><a href="frmInsertar.php">+ Nuevo curso</a> | <a href="../index.php">Inicio</a></p>

    <table>
        <tr><th>Codigo</th><th>Nombre</th><th>Creditos</th><th>Ciclo</th><th>Acciones</th></tr>
        <?php foreach ($cursos as $c): ?>
        <tr>
            <td><?= htmlspecialchars($c["Codigo"]) ?></td>
            <td><?= htmlspecialchars($c["Nombre"]) ?></td>
            <td><?= $c["Creditos"] ?></td>
            <td><?= $c["Ciclo"] ?></td>
            <td>
                <a href="frmModificar.php?id=<?= $c["IdCurso"] ?>">Modificar</a> |
                <a href="../Controllers/cursoController.php?accion=eliminar&id=<?= $c["IdCurso"] ?>"
                   onclick="return confirm('Eliminar este curso?')">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
