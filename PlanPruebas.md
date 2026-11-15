# Plan de Pruebas — Sistema de Gestion de Clientes

## 1. Objetivo
Verificar que el sistema permita registrar, modificar, listar y eliminar clientes
correctamente, aplicando la arquitectura por capas (Modelo, Vista, Controlador).

## 2. Alcance
- Capa Modelo: `conexion.php`, `ClienteDAO.php`
- Capa Vista: `frmListarcliente.php`, `frmRegistrarcliente.php`, `frm_modificarcliente.php`
- Capa Controlador: `clienteController.php`
- Base de datos: `trabajo09.dbo.Clientes`

## 3. Entorno de pruebas
| Elemento | Valor |
|----------|-------|
| Sistema operativo | Windows 11 Pro |
| Servidor web | PHP 8.4 Development Server (`php -S 0.0.0.0:8000`) |
| Motor de BD | SQL Server Express (`DESKTOP-HK3IGUQ\SQLEXPRESS`) |
| Base de datos | trabajo09 |
| Autenticacion BD | Windows (Integrated Security) |

## 4. Estrategia
Se aplican pruebas funcionales de caja negra sobre los formularios y el controlador,
verificando el resultado en la pagina y directamente en la base de datos.

## 5. Casos de prueba

| ID | Caso | Datos de entrada | Resultado esperado |
|----|------|------------------|--------------------|
| CP-01 | Registrar cliente valido | DNI 73000001, Nombres Ana, Apellidos Lopez Ruiz, Tel 999888777, Email ana@correo.com, Dir Av. Peru 100 | Mensaje "Cliente registrado" y fila nueva en `Clientes` |
| CP-02 | Registrar con DNI duplicado | DNI 70123456 (ya existente) | Mensaje de error UNIQUE, no inserta |
| CP-03 | Registrar con campos obligatorios vacios | DNI/Nombres/Apellidos vacios | El navegador bloquea el envio (validacion HTML5) |
| CP-04 | Listar clientes | — | Tabla con todos los clientes ordenados por Apellidos, Nombres |
| CP-05 | Modificar cliente existente | id valido + nuevos datos | Mensaje "Cliente modificado" y datos actualizados en BD |
| CP-06 | Modificar cliente inexistente | id=999999 | Redirige con mensaje "Cliente no encontrado" |
| CP-07 | Eliminar cliente | id valido | Mensaje "Cliente eliminado" y fila borrada |
| CP-08 | Accion no valida | accion=xxx | Redirige con mensaje "Accion no valida" |
| CP-09 | Conexion a BD caida | Servicio SQL detenido | La pagina muestra "Error de conexion: ..." |

## 6. Criterios de aceptacion
- Todos los casos CP-01 a CP-08 deben pasar.
- La base de datos debe quedar consistente (sin registros de prueba al finalizar).
- No deben existir warnings ni errores PHP en el log del servidor.

## 7. Resultado de la ejecucion

| ID | Resultado | Evidencia |
|----|-----------|-----------|
| CP-01 | PASS | HTTP 302 → "Cliente registrado"; fila id=4 creada en `Clientes` |
| CP-02 | PASS | HTTP 302 → error UNIQUE `UQ_Clientes_Dni`; no se inserto duplicado |
| CP-03 | PASS | Validacion `required`/`pattern` de HTML5 impide el envio |
| CP-04 | PASS | `frmListarcliente.php` HTTP 200, 3 clientes listados, sin errores |
| CP-05 | PASS | HTTP 302 → "Cliente modificado"; datos actualizados en BD |
| CP-06 | PASS | HTTP 302 → "Cliente no encontrado" |
| CP-07 | PASS | HTTP 302 → "Cliente eliminado"; fila borrada, BD vuelve a 3 filas |
| CP-08 | PASS | HTTP 302 → "Accion no valida" |
| CP-09 | N/A | No se detuvo el servicio para no afectar otros trabajos |

Conclusion: los casos CP-01 a CP-08 pasan. Base de datos consistente (3 clientes
de ejemplo, sin registros de prueba). Sin warnings ni errores en el log de PHP.

