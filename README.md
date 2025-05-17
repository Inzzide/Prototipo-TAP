# 🏭 Sistema de Control de Producción

Este prototipo fue desarrollado como parte de un trabajo práctico para gestionar y controlar de forma local los procesos clave de una pequeña planta o centro de producción. Implementado con PHP, MySQL, HTML y CSS siguiendo el patrón MVC.

---

## 🧩 Funcionalidades principales

### 👤 Inicio de Sesión

- Permite diferenciar entre usuarios con rol **administrador** y **trabajador**.
- Redirige a la vista correspondiente tras autenticarse.

### 🔐 Roles

| Rol                    | Acceso permitido |
|------------------|------------------|
| Administrador | Acceso total a todos los formularios, crear, editar, eliminar y consultar registros. |
| Trabajador       | Registrar su entrada/salida, ver tareas asignadas, reportar mermas, y emitir informes. 

---

## 📋 Módulos del sistema

### 🔄 Registro de Entradas

- Dividido en:

  - **Productos**: tipo, cantidad y fecha/hora de ingreso.
  - **Trabajadores**: registro de asistencia (entrada/salida por día).

### 📌 Asignación de Trabajos

- Los administradores pueden asignar tareas a trabajadores con fecha definida.

### 🔍 Consultar Registros

- Permite al administrador revisar listas de entradas, asistencias, informes y mermas.

### 🧾 Informes

- Creados por trabajadores o administradores.
- Se pueden consultar por nombre del trabajador.

### 📉 Mermas

- Registro de productos deteriorados o no utilizables.
- No requiere identificación del trabajador, pero sí usuario registrado.

---

## 🗂 Estructura de carpetas

Control_Produccion/
├── app/
│ ├── controllers/
│ ├── models/
│ ├── views/
│ │ ├── home/
│ │ ├── login/
│ │ ├── entrada/
│ │ ├── informes/
│ │ ├── mermas/
│ │ └── templates/
│ ├── config/
│ │ └── db.php
│ └── core/
│ └── App.php
├── public/
│ ├── css/
│ │ └── estilo.css
│ └── index.php
├── .htaccess
└── README.txt


---

## 💾 Base de datos

Nombre: `produccion_db`

Tablas principales:
- `trabajadores`
- `entradas`
- `asistencias`
- `informes`
- `mermas`
- `asignaciones`

> 💡 Las claves foráneas y estructuras se adaptan para que trabajadores y sus actividades se vinculen correctamente.

---

## 🛠 Requisitos

- PHP 8.x
- MySQL/MariaDB
- Servidor local: XAMPP o similar
- Navegador moderno

---

## 🚀 Cómo usar

1. Clonar o copiar la carpeta `Control_Produccion` en `htdocs`.
2. Importar el archivo SQL con la estructura de `produccion_db`.
3. Iniciar Apache y MySQL en XAMPP.
4. Ingresar en el navegador a:  http://localhost/Control_Produccion/public/

5. Iniciar sesión como:
- Administrador: `admin@correo.com` / `admin123`
- Trabajador: `juan@correo.com` / `trabajador123`

---

## 🧪 Estado actual

✅ Totalmente funcional en entorno local  
✅ Módulos separados y protegidos por rol  
✅ CSS personalizado para vistas limpias  
🧩 Prototipo listo para ser expandido a producción real con mejoras como cifrado, validación avanzada y logs

---

## 👨‍💻 Desarrollado por

Matías Rebeco Ojeda  
Trabajo de Aplicación Práctica – 2025  
Institución: Instituto Profesional AIEP.# Prototipo-TAP
Prototipo de Sistema de Gestión Web
