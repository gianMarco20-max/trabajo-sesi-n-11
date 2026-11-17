-- ============================================================
--  LABORAT-09 - Script para que los clientes salgan en la BD
--  Base de datos: trabajo09   |  Tabla: dbo.Clientes
--  Se puede ejecutar varias veces: no duplica (valida por DNI)
-- ============================================================

IF DB_ID('trabajo09') IS NULL
    CREATE DATABASE trabajo09;
GO

USE trabajo09;
GO

IF OBJECT_ID('dbo.Clientes') IS NULL
CREATE TABLE dbo.Clientes (
    IdCliente INT IDENTITY(1,1) PRIMARY KEY,
    Dni       VARCHAR(8)   NOT NULL UNIQUE,
    Nombres   VARCHAR(60)  NOT NULL,
    Apellidos VARCHAR(60)  NOT NULL,
    Telefono  VARCHAR(15)  NULL,
    Email     VARCHAR(80)  NULL,
    Direccion VARCHAR(120) NULL
);
GO

-- Inserta cada cliente solo si su DNI aun no existe
INSERT INTO dbo.Clientes (Dni, Nombres, Apellidos, Telefono, Email, Direccion)
SELECT v.Dni, v.Nombres, v.Apellidos, v.Telefono, v.Email, v.Direccion
FROM (VALUES
    ('70123456', 'gian marco',   'peña carranza',   '987654321', 'gipe.@correo.com',           'Av. Los Alamos 123'),
    ('71234567', 'Maria Elena',  'Torres Rojas',    '912345678', 'maria.torres@correo.com',    'Jr. Las Flores 456'),
    ('72345678', 'vanesa',       'julca',           '956781234', 'lvanejulca@correo.com',      'Calle San Martin 789'),
    ('71566574', 'dari vanessa', 'julca vela',      '962672738', 'vasena.dari@gamil.com',      'jr. hallame si puedes'),
    ('01112323', 'marco',        'pena',            '234235235', 'marco.carran@gamil.com',     'valle verde 789'),
    ('72893832', 'yamilet',      'peña carranza',   '971216123', 'yamilyercarranza@gamil.com', 'reisquerra'),
    ('71234566', 'Carlos',       'Pérez Ruiz',      '987654321', 'juan.perez@gmail.com',       'Av. Grau 450, Moyobamba')
) AS v (Dni, Nombres, Apellidos, Telefono, Email, Direccion)
WHERE NOT EXISTS (SELECT 1 FROM dbo.Clientes c WHERE c.Dni = v.Dni);
GO

-- Muestra los clientes que quedaron en la base de datos
SELECT IdCliente, Dni, Nombres, Apellidos, Telefono, Email, Direccion
FROM dbo.Clientes
ORDER BY Apellidos, Nombres;
GO

SELECT COUNT(*) AS TotalClientes FROM dbo.Clientes;
GO
