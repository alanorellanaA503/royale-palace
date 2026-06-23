# 🍽️ The Royale Palace

Sistema web de reservaciones y gestión multi-sede para restaurante, desarrollado como **Proyecto Final** de la materia **Desarrollo de Páginas Web** — Ciclo I 2026.

---

## 📖 Descripción

**The Royale Palace** es una aplicación web construida con el patrón **MVC de Laravel** que permite gestionar reservaciones, sedes, mesas, platos y usuarios de un restaurante con múltiples sucursales. El sistema cuenta con dos roles diferenciados: **administrador**, con acceso a un panel completo de gestión, y **usuario**, con acceso a reservaciones, favoritos y su cuenta personal.

El proyecto incluye generación de reportes en **PDF mediante DomPDF**, autenticación con roles, gestión de imágenes, y un diseño responsivo construido con Bootstrap.

---

## 🎓 Información académica

|                      |                                                 |
| -------------------- | ----------------------------------------------- |
| **Institución**      | Escuela Especializada en Ingeniería ITCA-FEPADE |
| **Sede**             | Central Santa Tecla — Escuela de Computación    |
| **Carrera**          | Técnico en Ingeniería de Desarrollo de Software |
| **Materia**          | Desarrollo de Páginas Web                       |
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
- Gestión de mesas (CRUD)
- Gestión de platos (CRUD)
- Gestión de categorías
- Gestión de sedes/sucursales
- Administración de reservaciones
- Gestión de usuarios y roles
- **Generación de reportes en PDF** (reservaciones) con DomPDF

---

## 🧱 Tecnologías utilizadas

- **Backend:** Laravel (PHP)
- **Base de datos:** MySQL (vía XAMPP / Apache)
- **Frontend:** Blade Templates, Bootstrap, CSS, JavaScript
- **Reportes PDF:** barryvdh/laravel-dompdf
- **Roles y permisos:** Spatie Laravel Permission
- **Entorno de desarrollo local:** XAMPP (Apache + MySQL)
- **Control de versiones:** Git & GitHub

---

## 📂 Estructura del proyecto

```
royale-palace/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/        # Controladores del panel admin
│   │   │   └── Auth/         # Autenticación
│   │   ├── Middleware/       # CheckRole y middlewares personalizados
│   │   └── Requests/         # Form Requests de validación
│   ├── Models/                # Mesa, Plato, Reservacion, Sede, User, etc.
│   ├── Providers/
│   └── View/Components/       # Layouts como componentes Blade
├── database/
│   ├── migrations/
│   └── seeders/
├── public/
│   └── images/                 # Assets visuales del sitio
├── resources/
│   └── views/
│       ├── admin/               # Vistas del panel administrativo
│       ├── auth/                 # Login, registro, recuperación
│       ├── cuenta/
│       ├── favoritos/
│       ├── menu/
│       ├── profile/
│       ├── reservaciones/
│       └── layouts/              # app, admin, guest, navigation
├── routes/
│   ├── web.php
│   └── auth.php
└── .env.example
```

---

## ⚙️ Instalación y configuración local

### Requisitos previos

- PHP >= 8.1
- Composer
- XAMPP (Apache + MySQL)
- Node.js y npm

### Pasos

1. **Clonar el repositorio**

    ```bash
    git clone https://github.com/tu-usuario/royale-palace.git
    cd royale-palace
    ```

2. **Instalar dependencias de PHP**

    ```bash
    composer install
    ```

3. **Instalar dependencias de JavaScript**

    ```bash
    npm install
    ```

4. **Configurar el archivo de entorno**

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

5. **Crear la base de datos**

    Abre phpMyAdmin (con XAMPP corriendo) y crea una base de datos llamada `royale_palace`. Luego edita tu `.env` con tus credenciales locales:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=royale_palace
    DB_USERNAME=root
    DB_PASSWORD=
    ```

6. **Ejecutar migraciones y seeders**

    ```bash
    php artisan migrate --seed
    ```

7. **Crear el enlace simbólico de almacenamiento**

    ```bash
    php artisan storage:link
    ```

8. **Compilar los assets del frontend**

    ```bash
    npm run dev
    ```

9. **Levantar el servidor**

    ```bash
    php artisan serve
    ```

    Accede en tu navegador a `http://localhost:8000` (o la URL configurada en tu `APP_URL`).

---

## 🔑 Roles del sistema

| Rol               | Acceso                                  |
| ----------------- | --------------------------------------- |
| **Administrador** | Panel completo de gestión (`/admin`)    |
| **Usuario**       | Reservaciones, favoritos, perfil propio |

> Los seeders incluidos (`AdminSeeder`, `RoleSeeder`) crean automáticamente un usuario administrador y los roles base al ejecutar `php artisan migrate --seed`.

---

## 📄 Licencia

Este proyecto fue desarrollado con fines académicos para la materia de Desarrollo de Páginas Web, ITCA-FEPADE, Ciclo I - 2026.
