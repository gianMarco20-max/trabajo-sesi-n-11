<?php

function conectar()
{
    $servidor = "localhost\\SQLEXPRESS";   // instancia de SQL Server Express
    $baseDatos = "trabajo09";              // base de datos del trabajo

    try {
        // Autenticacion de Windows: sin usuario ni clave
        $pdo = new PDO(
            "sqlsrv:Server=$servidor;Database=$baseDatos;TrustServerCertificate=1"
        );
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Error de conexion: " . $e->getMessage());
    }
}
