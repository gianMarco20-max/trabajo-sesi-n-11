<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Curso</title>
    <style>
        body { font-family: Arial; margin: 30px; }
        label { display: block; margin-top: 10px; }
        input { padding: 5px; width: 250px; }
        button { margin-top: 15px; padding: 6px 14px; }
    </style>
</head>
<body>
    <h2>Registrar curso</h2>
    <form action="../Controllers/cursoController.php" method="post">
        <input type="hidden" name="accion" value="insertar">

        <label>Codigo</label>
        <input type="text" name="codigo" maxlength="10" required>

        <label>Nombre</label>
        <input type="text" name="nombre" maxlength="100" required>

        <label>Creditos</label>
        <input type="number" name="creditos" min="1" max="10" required>

        <label>Ciclo</label>
        <input type="number" name="ciclo" min="1" max="10" required>

        <button type="submit">Guardar</button>
        <a href="frmConsultar.php">Cancelar</a>
    </form>
</body>
</html>
