<?php

require_once __DIR__ . "/../Models/ClienteDAO.php";


function listarClientes()
{
    return (new ClienteDAO())->listar();
}

function obtenerCliente($id)
{
    return (new ClienteDAO())->obtener($id);
}

// Acciones de escritura: solo se ejecutan si llega "accion" desde un formulario/enlace
$accion = $_REQUEST["accion"] ?? "";
if ($accion === "") {
    return;
}

try {
    $dao = new ClienteDAO();
    switch ($accion) {
        case "insertar":
            $dao->insertar(
                trim($_POST["dni"]),
                trim($_POST["nombres"]),
                trim($_POST["apellidos"]),
                trim($_POST["telefono"] ?? ""),
                trim($_POST["email"] ?? ""),
                trim($_POST["direccion"] ?? "")
            );
            $msg = "Cliente registrado";
            break;

        case "modificar":
            $dao->modificar(
                (int)$_POST["id"],
                trim($_POST["dni"]),
                trim($_POST["nombres"]),
                trim($_POST["apellidos"]),
                trim($_POST["telefono"] ?? ""),
                trim($_POST["email"] ?? ""),
                trim($_POST["direccion"] ?? "")
            );
            $msg = "Cliente modificado";
            break;

        case "eliminar":
            $dao->eliminar((int)$_GET["id"]);
            $msg = "Cliente eliminado";
            break;

        default:
            $msg = "Accion no valida";
    }
} catch (Throwable $e) {
    // DNI repetido (restriccion UNIQUE) -> mensaje entendible
    if (str_contains($e->getMessage(), "UNIQUE") || str_contains($e->getMessage(), "23000")) {
        $msg = "Error: Código ya existe";
    } else {
        $msg = "Error: " . $e->getMessage();
    }
}

header("Location: ../Views/frmListarcliente.php?msg=" . urlencode($msg));
exit;