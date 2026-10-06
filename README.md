# 🍽️ The Royale Palace

Sistema web de reservaciones y gestión multi-sede para restaurante, desarrollado como **Proyecto Final** de la materia **Desarrollo de Páginas Web** — Ciclo I 2026.

---

## 📖 Descripción

**The Royale Palace** es una aplicación web construida con el patrón **MVC de Laravel** que permite gestionar reservaciones, sedes, mesas, platos y usuarios de un restaurante con múltiples sucursales.

El sistema cuenta con dos roles principales:

- **Administrador:** acceso al panel completo de gestión.
- **Usuario:** acceso a reservaciones, favoritos y cuenta personal.

El proyecto incluye autenticación, roles y permisos, gestión de imágenes, generación de reportes en PDF mediante DomPDF y una interfaz responsiva construida con Bootstrap.

---

## 🎓 Información académica

| Campo                | Información                                     |
| -------------------- | ----------------------------------------------- |
| **Institución**      | Escuela Especializada en Ingeniería ITCA-FEPADE |
| **Sede**             | Central Santa Tecla — Escuela de Computación    |
| **Carrera**          | Técnico en Ingeniería de Desarrollo de Software |
| **Materia**          | Desarrollo de Aplicaciones Web                  |
| **Ciclo**            | I - 2026                                        |
| **Tipo de proyecto** | Proyecto Final                                  |

---

## 👥 Equipo de desarrollo

| Integrante        | Rol             |
| ----------------- | --------------- |
| **Alan Orellana** | Líder de equipo |
| Karla Rivas       | Desarrolladora  |
| Yony Rodríguez    | Desarrollador   |
| Samuel Cornejo    | Desarrollador   |
| Danilo Chicas     | Desarrollador   |

---

## ✨ Funcionalidades principales

### 👤 Panel de usuario

- Registro e inicio de sesión
- Exploración del menú por sede
- Creación y gestión de reservaciones
- Lista de platos favoritos
- Edición de perfil y cuenta

### 🛠️ Panel de administrador

- Dashboard de control general
- Gestión de mesas
- Gestión de platos
- Gestión de categorías
- Gestión de sedes y sucursales
- Administración de reservaciones
- Gestión de usuarios y roles
- Generación de reportes de reservaciones en PDF con DomPDF

---

## 🧱 Tecnologías utilizadas

- **Backend:** Laravel 12
- **PHP:** 8.2+
- **Base de datos:** MySQL
- **Frontend:** Blade Templates, Bootstrap, CSS y JavaScript
- **Build tool:** Vite
- **Reportes PDF:** barryvdh/laravel-dompdf
- **Roles y permisos:** Spatie Laravel Permission
- **Entorno local recomendado:** XAMPP o equivalente
- **Control de versiones:** Git y GitHub

---

## 📂 Estructura del proyecto

```text
royale-palace/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/
│   │   │   └── Auth/
│   │   ├── Middleware/
│   │   └── Requests/
│   ├── Models/
│   ├── Providers/
│   └── View/
│       └── Components/
├── bootstrap/
│   └── cache/
├── database/
│   ├── migrations/
│   └── seeders/
├── public/
│   ├── images/
│   └── storage/
├── resources/
│   └── views/
│       ├── admin/
│       ├── auth/
│       ├── cuenta/
│       ├── favoritos/
│       ├── menu/
│       ├── profile/
│       ├── reservaciones/
│       └── layouts/
├── routes/
│   ├── web.php
│   └── auth.php
├── storage/
│   └── framework/
│       ├── cache/
│       ├── sessions/
│       ├── testing/
│       └── views/
├── .env.example
├── composer.json
└── package.json
```

---

## ⚙️ Instalación y configuración local

### Requisitos previos

Antes de comenzar asegúrate de tener instalado:

- PHP >= 8.2
- Composer
- Node.js >= 18
- npm
- MySQL
- XAMPP, Laragon o un entorno equivalente

### 1. Clonar el repositorio

```bash
git clone https://github.com/alanorellanaA503/royale-palace.git
cd royale-palace
```

### 2. Instalar dependencias de PHP

```bash
composer install
```

### 3. Instalar dependencias frontend

```bash
npm install
```

### 4. Crear el archivo de entorno

En Windows PowerShell:

```powershell
Copy-Item .env.example .env
```

En Linux o macOS:

```bash
cp .env.example .env
```

Luego genera la clave de la aplicación:

```bash
php artisan key:generate
```

### 5. Crear la base de datos

Crea una base de datos MySQL llamada:

```text
royale_palace
```

Por ejemplo, desde phpMyAdmin.

Después configura las credenciales de conexión en `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=royale_palace
DB_USERNAME=root
DB_PASSWORD=
```

> La contraseña puede variar según la configuración local de MySQL.

### 6. Limpiar la configuración de Laravel

```bash
php artisan optimize:clear
```

### 7. Ejecutar migraciones y seeders

```bash
php artisan migrate --seed
```

Los seeders generan automáticamente la información base requerida por el sistema, incluyendo:

- Sedes
- Categorías
- Mesas
- Platos
- Roles y permisos
- Usuario administrador

### 8. Crear el enlace simbólico de almacenamiento

```bash
php artisan storage:link
```

Esto permite acceder desde `public/storage` a los archivos almacenados en `storage/app/public`.

### 9. Iniciar Vite

```bash
npm run dev
```

### 10. Iniciar Laravel

En otra terminal:

```bash
php artisan serve
```

El sitio estará disponible normalmente en:

```text
http://127.0.0.1:8000
```

---

## 🚀 Inicio rápido del entorno de desarrollo

El proyecto incluye un comando de desarrollo que permite levantar varios servicios al mismo tiempo:

```bash
composer run dev
```

Este comando inicia:

- Servidor de Laravel
- Queue listener
- Laravel Pail
- Vite

Puede utilizarse una vez que el proyecto ya se encuentre correctamente configurado.

---

## 🔑 Roles del sistema

| Rol               | Acceso                                     |
| ----------------- | ------------------------------------------ |
| **Administrador** | Panel completo de gestión                  |
| **Usuario**       | Reservaciones, favoritos y perfil personal |

Los seeders incluidos crean automáticamente los roles base al ejecutar:

```bash
php artisan migrate --seed
```

---

## 🗄️ Base de datos

La estructura de la base de datos se genera mediante las migraciones incluidas en:

```text
database/migrations
```

No es necesario importar manualmente una base de datos SQL para comenzar a utilizar el proyecto.

Los datos iniciales se cargan mediante:

```text
database/seeders
```

Esto permite clonar el proyecto y reconstruir su entorno desde cero.

---

## 🧹 Archivos generados y carpetas de Laravel

El repositorio conserva mediante archivos `.gitignore` las carpetas necesarias para el funcionamiento de Laravel, entre ellas:

```text
bootstrap/cache
storage/framework/cache
storage/framework/cache/data
storage/framework/sessions
storage/framework/testing
storage/framework/views
```

El contenido generado dentro de estas carpetas no se versiona.

---

## 📦 Dependencias

Las dependencias PHP se administran con Composer:

```bash
composer install
```

Las dependencias frontend se administran con npm:

```bash
npm install
```

Los archivos `composer.lock` y `package-lock.json` permiten mantener versiones consistentes entre diferentes instalaciones del proyecto.

---

## 🔐 Archivo `.env`

El archivo `.env` contiene configuraciones locales y datos sensibles, por lo que no se incluye en el repositorio.

Cada desarrollador debe crear el suyo a partir de:

```text
.env.example
```

Nunca debe subirse `.env` a GitHub.

---

## 📄 Reportes PDF

El sistema utiliza:

```text
barryvdh/laravel-dompdf
```

para generar reportes de reservaciones en formato PDF.

---

## 🛡️ Roles y permisos

La gestión de roles y permisos se realiza utilizando:

```text
spatie/laravel-permission
```

Actualmente se utilizan los roles base:

```text
admin
usuario
```

---

## 📌 Estado del proyecto

El proyecto se encuentra actualmente en proceso de mantenimiento y mejora.

Entre los objetivos de esta nueva etapa se encuentran:

- Mejorar la instalación inicial
- Actualizar dependencias
- Mejorar la interfaz y experiencia de usuario
- Renovar la identidad visual
- Optimizar la estructura interna
- Mejorar documentación
- Reforzar seguridad y mantenimiento
- Preparar el proyecto como sistema sólido de portafolio

---

## 📄 Licencia

Este proyecto fue desarrollado originalmente con fines académicos para la materia **Desarrollo de Páginas Web**, ITCA-FEPADE, Ciclo I - 2026.

Actualmente continúa como proyecto de práctica, mantenimiento y mejora.
