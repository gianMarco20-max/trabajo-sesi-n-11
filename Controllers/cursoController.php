<?php

require_once __DIR__ . "/../Models/CursoDAO.php";


function listarCursos()
{
    return (new CursoDAO())->listar();
}

function obtenerCurso($id)
{
    return (new CursoDAO())->obtener($id);
}

// Acciones de escritura: solo se ejecutan si llega "accion" desde un formulario/enlace
$accion = $_REQUEST["accion"] ?? "";
if ($accion === "") {
    return;   
}

$dao = new CursoDAO();

try {
    switch ($accion) {
        case "insertar":
            $dao->insertar(trim($_POST["codigo"]), trim($_POST["nombre"]), (int)$_POST["creditos"], (int)$_POST["ciclo"]);
            $msg = "Curso registrado";
            break;

        case "modificar":
            $dao->modificar((int)$_POST["id"], trim($_POST["codigo"]), trim($_POST["nombre"]), (int)$_POST["creditos"], (int)$_POST["ciclo"]);
            $msg = "Curso modificado";
            break;

        case "eliminar":
            $dao->eliminar((int)$_GET["id"]);
            $msg = "Curso eliminado";
            break;

        default:
            $msg = "Accion no valida";
    }
} catch (PDOException $e) {
    // Ejemplo: codigo repetido (UNIQUE)
    $msg = "Error: " . $e->getMessage();
}

header("Location: ../Views/frmConsultar.php?msg=" . urlencode($msg));
exit;
