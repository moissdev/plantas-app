# 🌿 Plantas App

Prototipo de sistema CRUD sencillo construido con **Laravel** para registrar y gestionar plantas con sus características esenciales.

---

## ¿Qué hace esta aplicación?

Plantas App permite llevar un registro básico de plantas desde el navegador. Con ella puedes:

- **Registrar** una nueva planta con nombre común, especie, descripción y fecha de registro
- **Ver** todas las plantas registradas en una tabla ordenada por más reciente
- **Eliminar** cualquier registro con confirmación previa

> Por el momento no se incluye la edición de registros para esta versión.

---

## Tecnologías utilizadas

- Laravel 11 — Framework PHP
- PHP >= 8.2
- SQLite — Base de datos local (sin servidor externo)
- Blade — Motor de plantillas de Laravel

---

## Requisitos previos

Antes de correr el proyecto, asegúrate de tener instalado en tu máquina:

| Herramienta | Versión mínima | Verificar con |
|---|---|---|
| PHP | 8.2 | `php -v` |
| Composer | 2.x | `composer -v` |
| Node.js | 18.x | `node -v` |
| Git | cualquier | `git -v` |

> SQLite ya viene incluido con PHP, no se necesita instalar nada adicional para la persistencia de datos.

---

## Instalación y configuración local

Sigue estos pasos en orden para tener el proyecto corriendo en tu máquina:

**1. Clona el repositorio**

```bash
git clone https://github.com/moissdev/plantas-app.git
cd plantas-app
```

**2. Instala las dependencias PHP**

```bash
composer install
```

**3. Copia el archivo de variables de entorno de ejemplo**

```bash
cp .env.example .env
```

**4. Configura la base de datos SQLite**

Abre el archivo `.env` y asegúrate de que la configuración de base de datos sea:

```env
DB_CONNECTION=sqlite
```

Elimina o comenta las siguientes líneas si existen en tu `.env`:

```env
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=laravel
# DB_USERNAME=root
# DB_PASSWORD=
```

Luego crea el archivo de base de datos:

```bash
touch database/database.sqlite
```

> Puedes usar: `echo "" > database/database.sqlite` para Windows o crearlo de forma manual.

**5. Genera la clave de aplicación**

```bash
php artisan key:generate
```

**6. Corre las migraciones**

```bash
php artisan migrate
```

Deberás ver una salida similar a:

```
INFO  Running migrations.
xxxx_xx_xx_create_plantas_table ............. DONE
```

**7. Levanta el servidor**

```bash
php artisan serve
```

**8. Abrir en el navegador**

Visita: [http://127.0.0.1:8000](http://127.0.0.1:8000) ó http://plantas-app.test (según sea el nombre de tu proyecto)

