# Guía de Puesta en Marcha - TheDebateClub

## Requisitos previos

- PHP (versión recomendada 8.x)
- Composer
- Node.js y npm (preferiblemente versión LTS)
- MySQL (XAMPP)
- Git
---

## Instalación y configuración

1. **Clonar el repositorio**

```bash
git clone https://github.com/DevFabK/TheDebateClub.git
cd TheDebateClub
```

2. **Instalar dependencias de PHP y Node**

```bash
composer install
npm install
```

3. **Configurar variables de entorno**

Copiar el archivo .env.example a .env:
```bash
cp .env.example .env
```

Genera la clave de aplicación Laravel:
```bash
php artisan key:generate
```

4. **Crear la base de datos**

Desde phpmyadmin crear la base de datos con el nombre thedebateclubdb

5. **Configurar las credenciales en .env**

Abrir el archivo .env con un editor y asegurar de que la configuración de la base de datos sea la siguiente:
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=thedebateclubdb
DB_USERNAME=root
DB_PASSWORD=
```

6. **Hacer las migraciones**

```bash
php artisan migrate
```

7. **Ejecutar los seeders**

```bash
php artisan db:seed --class=DatabaseSeeder
```

8. **Compilar los assets con npm**

```bash
npm run dev
```

9. **Para enlazar el storage público**

```bash
php artisan storage:link
```

10. **Levantar el servidor local de desarrollo**

```bash
php artisan serve
```

