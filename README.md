# Casa Taller Cachagua - Instrucciones de Instalación

## Requisitos Previos

- XAMPP con PHP 7.4 o superior
- MySQL corriendo en puerto 3307
- Navegador web moderno

## Instalación Paso a Paso

### 1. Preparar el Entorno

1. Asegúrate de que XAMPP esté instalado y funcionando
2. Verifica que MySQL esté corriendo en el puerto 3307
3. Abre phpMyAdmin en `http://localhost:8080/phpmyadmin/`

### 2. Crear la Estructura de Carpetas

Crea la siguiente estructura en `C:\xampp\htdocs\`:

```
htdocs/
└── casa-taller-cachagua/
    ├── admin/
    │   ├── css/
    │   ├── login.php
    │   ├── register.php
    │   ├── dashboard.php
    │   ├── productos.php
    │   └── logout.php
    ├── config/
    │   └── database.php
    ├── css/
    │   └── styles.css
    ├── img/
    │   ├── productos/
    │   ├── banners/
    │   └── general/
    ├── includes/
    │   └── functions.php
    ├── js/
    │   └── main.js
    ├── mail/
    │   └── send_contact.php
    ├── sql/
    │   └── database.sql
    └── index.php
```

### 3. Configurar la Base de Datos

1. Abre phpMyAdmin
2. Crea una nueva base de datos llamada `casa_taller_cachagua`
3. Importa el archivo `sql/database.sql`

### 4. Configurar la Conexión

Edita el archivo `config/database.php`:

```php
<?php
define('DB_HOST', 'localhost:3307');
define('DB_USER', 'root');
define('DB_PASS', ''); // Tu contraseña de MySQL
define('DB_NAME', 'casa_taller_cachagua');
```

### 5. Permisos de Carpetas

Asegúrate de que la carpeta `img/productos/` tenga permisos de escritura.

### 6. Crear Usuario Administrador

1. Navega a `http://localhost/casa-taller-cachagua/admin/register.php`
2. Registra un nuevo usuario administrador
3. Guarda las credenciales en un lugar seguro

## Uso del Sistema

### Acceso al Sitio Web
- URL Principal: `http://localhost/casa-taller-cachagua/`
- Aquí los visitantes pueden ver productos, información y contactar

### Acceso al Panel de Administración
- URL Admin: `http://localhost/casa-taller-cachagua/admin/`
- Inicia sesión con las credenciales creadas

### Gestión de Productos
1. Desde el panel admin, ve a "Productos"
2. Puedes agregar, editar o eliminar productos
3. Sube imágenes (JPG, PNG, GIF)
4. Agrega enlaces de Instagram opcionales

### Mensajes de Contacto
- Los mensajes se guardan en la base de datos
- Puedes verlos desde el Dashboard del admin

## Solución de Problemas

### Error de Conexión a Base de Datos
- Verifica que MySQL esté corriendo en puerto 3307
- Confirma las credenciales en `config/database.php`

### No se Suben las Imágenes
- Verifica permisos de la carpeta `img/productos/`
- Asegúrate de que el tamaño del archivo no exceda el límite de PHP

### Página en Blanco
- Activa la visualización de errores en PHP
- Revisa el log de errores de Apache

## Personalización

### Cambiar Colores
Edita las variables CSS en `css/styles.css`:
```css
:root {
    --primary-color: #2c3e50;
    --secondary-color: #e74c3c;
    --accent-color: #3498db;
}
```

### Modificar Categorías
Las categorías se pueden modificar en:
- `index.php` (filtros del frontend)
- `admin/productos.php` (select del formulario)

### Configurar Email
Para emails reales, configura SMTP en `mail/send_contact.php`

## Seguridad

- Cambia las credenciales por defecto de MySQL
- Usa contraseñas fuertes para administradores
- Mantén actualizado XAMPP y PHP
- Realiza copias de seguridad regulares

## Soporte

Para problemas o consultas sobre el proyecto, contacta a los desarrolladores:
- Christofer Cárcamo
- Sergio Oyarzo
- Proyecto: Landing page - Casa Taller Cachagua
