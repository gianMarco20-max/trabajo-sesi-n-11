<?php

require_once __DIR__ . "/conexion.php";

class CursoDAO
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = conectar();
    }

    // CONSULTAR: devuelve todos los cursos
    public function listar()
    {
        $st = $this->pdo->query("SELECT IdCurso, Codigo, Nombre, Creditos, Ciclo FROM Cursos ORDER BY Ciclo, Codigo");
        return $st->fetchAll(PDO::FETCH_ASSOC);
    }

    // CONSULTAR: devuelve un curso por su id (para llenar el formulario de modificar)
    public function obtener($id)
    {
        $st = $this->pdo->prepare("SELECT IdCurso, Codigo, Nombre, Creditos, Ciclo FROM Cursos WHERE IdCurso = ?");
        $st->execute([$id]);
        return $st->fetch(PDO::FETCH_ASSOC);
    }

    // REGISTRAR: inserta un curso nuevo
    public function insertar($codigo, $nombre, $creditos, $ciclo)
    {
        $st = $this->pdo->prepare("INSERT INTO Cursos (Codigo, Nombre, Creditos, Ciclo) VALUES (?, ?, ?, ?)");
        return $st->execute([$codigo, $nombre, $creditos, $ciclo]);
    }

    // MODIFICAR: actualiza un curso existente
    public function modificar($id, $codigo, $nombre, $creditos, $ciclo)
    {
        $st = $this->pdo->prepare("UPDATE Cursos SET Codigo = ?, Nombre = ?, Creditos = ?, Ciclo = ? WHERE IdCurso = ?");
        return $st->execute([$codigo, $nombre, $creditos, $ciclo, $id]);
    }

    // ELIMINAR: borra un curso por id
    public function eliminar($id)
    {
        $st = $this->pdo->prepare("DELETE FROM Cursos WHERE IdCurso = ?");
        return $st->execute([$id]);
    }
}
