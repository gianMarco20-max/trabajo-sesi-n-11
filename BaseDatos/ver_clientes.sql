
USE trabajo09;
GO

PRINT '==============================================';
PRINT ' SISTEMA DE GESTION DE CLIENTES';
PRINT ' Base de datos: trabajo09';
PRINT ' Servidor     : ' + @@SERVERNAME;
PRINT '==============================================';
GO

PRINT '';
PRINT '--- TABLA dbo.Clientes ---';
SELECT c.COLUMN_NAME AS Columna, c.DATA_TYPE AS Tipo,
       c.CHARACTER_MAXIMUM_LENGTH AS Largo, c.IS_NULLABLE AS Nulo
FROM INFORMATION_SCHEMA.COLUMNS c
WHERE c.TABLE_NAME = 'Clientes'
ORDER BY c.ORDINAL_POSITION;
GO

PRINT '';
PRINT '--- RESTRICCIONES ---';
SELECT tc.CONSTRAINT_TYPE AS Tipo, tc.CONSTRAINT_NAME AS Nombre,
       ku.COLUMN_NAME AS Columna
FROM INFORMATION_SCHEMA.TABLE_CONSTRAINTS tc
JOIN INFORMATION_SCHEMA.KEY_COLUMN_USAGE ku
  ON ku.CONSTRAINT_NAME = tc.CONSTRAINT_NAME
WHERE tc.TABLE_NAME = 'Clientes'
ORDER BY tc.CONSTRAINT_TYPE;
GO

PRINT '';
PRINT '--- DATOS ---';
SELECT IdCliente, Dni, Nombres, Apellidos, Telefono, Email, Direccion
FROM dbo.Clientes
ORDER BY Apellidos, Nombres;
GO

PRINT '';
PRINT '--- TOTAL DE CLIENTES ---';
SELECT COUNT(*) AS TotalClientes FROM dbo.Clientes;
GO
