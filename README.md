# LABORAT-09 - Gestion de Cursos (PHP + SQL Server)

## Requisitos

- PHP 8.x con extension `pdo_sqlsrv` activada (+ Microsoft ODBC Driver 17/18)
- SQL Server (Express sirve)
- Visual Studio Code

## Pasos

1. Ejecutar `BaseDatos/trabajo09.sql` (crea la base `trabajo09` y la tabla `Cursos`).
   - Opcion A: abrirlo en SSMS y pulsar Ejecutar.
   - Opcion B: `sqlcmd -S localhost\SQLEXPRESS -E -C -i BaseDatos\trabajo09.sql`
2. `Models/conexion.php` ya apunta a `trabajo09` con autenticacion de Windows (sin usuario ni clave).
3. En la terminal de VS Code, dentro de esta carpeta: `php -S localhost:8000`
4. Abrir <http://localhost:8000>

## Conexion en VS Code

- Extension instalada: `ms-mssql.mssql` (panel **SQL Server**).
- Perfil guardado: `trabajo09 (SQLEXPRESS - Windows)`
  - Servidor: `localhost\SQLEXPRESS`
  - Base de datos: `trabajo09`
  - Autenticacion: Windows (sin contrasena)
