
## Enunciado

Sistema que permita **registrar, modificar y eliminar clientes** de una empresa,
aplicando **programación por capas**.

## Arquitectura por capas

| Capa | Archivos |
|------|----------|
| Modelo | `Models/conexion.php`, `Models/ClienteDAO.php` |
| Vista | `Views/frmListarcliente.php`, `Views/frmRegistrarcliente.php`, `Views/frm_modificarcliente.php` |
| Controlador | `Controllers/clienteController.php` |

## Requisitos

- PHP 8.x con extension `pdo_sqlsrv` activada (+ Microsoft ODBC Driver 17/18)
- SQL Server (Express sirve)
- Visual Studio Code

## Pasos

1. Ejecutar `BaseDatos/trabajo09.sql` (crea la base `trabajo09` y la tabla `Clientes`).
   - Opcion A: abrirlo en SSMS y pulsar Ejecutar.
   - Opcion B: `sqlcmd -S localhost\SQLEXPRESS -E -C -i BaseDatos\trabajo09.sql`
2. `Models/conexion.php` apunta a `trabajo09` con autenticacion de Windows (sin usuario ni clave).
3. En la terminal de VS Code, dentro de esta carpeta: `php -S 0.0.0.0:8000`
4. Abrir <http://localhost:8000>

## Modelo de datos: dbo.Clientes

| Columna | Tipo | Restriccion |
|---------|------|-------------|
| IdCliente | INT IDENTITY | PK |
| Dni | VARCHAR(8) | NOT NULL, UNIQUE |
| Nombres | VARCHAR(60) | NOT NULL |
| Apellidos | VARCHAR(60) | NOT NULL |
| Telefono | VARCHAR(15) | NULL |
| Email | VARCHAR(80) | NULL |
| Direccion | VARCHAR(120) | NULL |

## Conexion en VS Code

- Extension instalada: `ms-mssql.mssql` (panel **SQL Server**).
- Perfil guardado: `trabajo09 (SQLEXPRESS - Windows)`
  - Servidor: `localhost\SQLEXPRESS`
  - Base de datos: `trabajo09`
  - Autenticacion: Windows (sin contrasena)
