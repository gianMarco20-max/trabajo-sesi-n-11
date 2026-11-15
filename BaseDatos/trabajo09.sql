IF DB_ID('trabajo09') IS NULL
    CREATE DATABASE trabajo09;
GO

USE trabajo09;
GO

IF OBJECT_ID('dbo.Clientes') IS NULL
CREATE TABLE dbo.Clientes (
    IdCliente INT IDENTITY(1,1) PRIMARY KEY,  -- identificador automatico
    Dni       VARCHAR(8)   NOT NULL UNIQUE,   -- documento del cliente
    Nombres   VARCHAR(60)  NOT NULL,          -- nombres
    Apellidos VARCHAR(60)  NOT NULL,          -- apellidos
    Telefono  VARCHAR(15)  NULL,              -- telefono de contacto
    Email     VARCHAR(80)  NULL,              -- correo electronico
    Direccion VARCHAR(120) NULL               -- direccion
);
GO

IF NOT EXISTS (SELECT 1 FROM dbo.Clientes)
INSERT INTO dbo.Clientes (Dni, Nombres, Apellidos, Telefono, Email, Direccion) VALUES
('70123456', 'Juan Carlos', 'Perez Gomez',   '987654321', 'juan.perez@correo.com',  'Av. Los Alamos 123'),
('71234567', 'Maria Elena', 'Torres Rojas',  '912345678', 'maria.torres@correo.com', 'Jr. Las Flores 456'),
('72345678', 'Luis Alberto','Ramirez Diaz',  '956781234', 'luis.ramirez@correo.com', 'Calle San Martin 789');
GO

SELECT * FROM dbo.Clientes;
GO
