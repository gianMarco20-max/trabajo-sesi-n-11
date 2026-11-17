<?php

function conectar()
{
    $baseDatos = "trabajo09";

    // 1) TCP directo al puerto fijo de SQLEXPRESS: no pasa por SQL Browser,
    //    por eso conecta al instante (antes se colgaba y daba el error de 30 s).
    // 2) Respaldo por instancia nombrada por si el puerto llegara a cambiar.
    $dsns = [
        "sqlsrv:Server=127.0.0.1,53322;Database=$baseDatos;TrustServerCertificate=1;LoginTimeout=5",
        "sqlsrv:Server=localhost\\SQLEXPRESS;Database=$baseDatos;TrustServerCertificate=1;LoginTimeout=5",
    ];

    $ultimoError = null;

    foreach ($dsns as $dsn) {
        try {
            $pdo = new PDO($dsn);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            if (defined("PDO::SQLSRV_ATTR_QUERY_TIMEOUT")) {
                $pdo->setAttribute(PDO::SQLSRV_ATTR_QUERY_TIMEOUT, 10);
            }
            return $pdo;
        } catch (PDOException $e) {
            $ultimoError = $e;
        }
    }

    // El detalle tecnico solo va al log del servidor, nunca a la pagina
    error_log("trabajo09: " . ($ultimoError ? $ultimoError->getMessage() : "sin detalle"));

    throw new RuntimeException(
        "No se pudo conectar a la base de datos. " .
        "Verifique que el servicio SQL Server (SQLEXPRESS) este iniciado."
    );
}
