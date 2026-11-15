<?php

require_once __DIR__ . "/conexion.php";

class ClienteDAO
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = conectar();
    }

    // LISTAR: devuelve todos los clientes
    public function listar()
    {
        $st = $this->pdo->query("SELECT IdCliente, Dni, Nombres, Apellidos, Telefono, Email, Direccion FROM Clientes ORDER BY Apellidos, Nombres");
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }

    // OBTENER: devuelve un cliente por su id (para llenar el formulario de modificar)
    public function obtener($id)
    {
        $st = $this->pdo->prepare("SELECT IdCliente, Dni, Nombres, Apellidos, Telefono, Email, Direccion FROM Clientes WHERE IdCliente = ?");
        $st->execute([$id]);
        return $st->fetch(PDO::FETCH_ASSOC);
    }

    // REGISTRAR: inserta un cliente nuevo
    public function insertar($dni, $nombres, $apellidos, $telefono, $email, $direccion)
    {
        $st = $this->pdo->prepare("INSERT INTO Clientes (Dni, Nombres, Apellidos, Telefono, Email, Direccion) VALUES (?, ?, ?, ?, ?, ?)");
        return $st->execute([$dni, $nombres, $apellidos, $telefono, $email, $direccion]);
    }

    // MODIFICAR: actualiza un cliente existente
    public function modificar($id, $dni, $nombres, $apellidos, $telefono, $email, $direccion)
    {
        $st = $this->pdo->prepare("UPDATE Clientes SET Dni = ?, Nombres = ?, Apellidos = ?, Telefono = ?, Email = ?, Direccion = ? WHERE IdCliente = ?");
        return $st->execute([$dni, $nombres, $apellidos, $telefono, $email, $direccion, $id]);
    }

    // ELIMINAR: borra un cliente por id
    public function eliminar($id)
    {
        $st = $this->pdo->prepare("DELETE FROM Clientes WHERE IdCliente = ?");
        return $st->execute([$id]);
    }
}
