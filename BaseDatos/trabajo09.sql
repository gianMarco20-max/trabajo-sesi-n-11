IF DB_ID('trabajo09') IS NULL
    CREATE DATABASE trabajo09;
GO

USE trabajo09;
GO


IF OBJECT_ID('dbo.Cursos') IS NULL
CREATE TABLE dbo.Cursos (
    IdCurso  INT IDENTITY(1,1) PRIMARY KEY,   -- identificador automatico
    Codigo   VARCHAR(10)  NOT NULL UNIQUE,    -- codigo del curso 
    Nombre   VARCHAR(100) NOT NULL,           -- nombre del curso
    Creditos INT          NOT NULL,           -- creditos
    Ciclo    INT          NOT NULL            -- ciclo academico 
);
GO


IF NOT EXISTS (SELECT 1 FROM dbo.Cursos)
INSERT INTO dbo.Cursos (Codigo, Nombre, Creditos, Ciclo) VALUES
('IS601', 'Ingenieria de Software', 4, 6),
('IS602', 'Base de Datos II',        4, 6),
('IS603', 'Redes de Computadoras',   3, 6);
GO

SELECT * FROM dbo.Cursos;
GO
