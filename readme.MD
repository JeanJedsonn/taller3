# Requisitos Previos

Este documento detalla los pasos necesarios para configurar el entorno local y desplegar el proyecto correctamente.

### Clonar o Descargar el Proyecto

[https://github.com/JeanJedsonn/taller3](https://github.com/JeanJedsonn/taller3)

# Guía de Instalación - Taller 3 Con HERD

Ubica el proyecto en tu directorio de trabajo (por ejemplo, dentro de la carpeta `Herd` que crea el instalador).

### 1. Laravel Herd (Recomendado para Windows):

Descarga e instala Herd desde: [https://herd.laravel.com/windows](https://herd.laravel.com/windows).
_Herd instalará automáticamente PHP, Composer y configurará un servidor web local._

## Pasos para la Instalación

### 2. Instalación de Dependencias de PHP

Abre una terminal en la raíz del proyecto y ejecuta:

```bash
composer install
```

### 3. Vincular el Proyecto en Herd

- Abre el panel de **Herd** .
- Ve a la sección **Sites** .
- Utiliza la opción **"Link existing project"** y selecciona la carpeta raíz de este proyecto.
- Ahora podrás acceder desde el navegador (ej: `http://taller3.test`) (**Herd** indicara la url).

# Guía de Instalación - Taller 3 Con XAMPP

**1.** Si no lo tienes, descárgalo en: [https://www.apachefriends.org/download.html](https://www.apachefriends.org/download.html)

**2.** Mueve la carpeta del proyecto a **`C:\xampp\htdocs\taller3`**.

**3.** Inicia los servicios de \***\*Apache\*\*** en el Panel de Control de XAMPP.

**4.** El sitio será accesible en: **`http://localhost/taller3/public`**.

## Pasos para ejecutar

Una vez elegido el servidor, abre una terminal en la carpeta raíz del proyecto y sigue estos comandos:

```
composer install
npm install
npm run dev
```

### Guía de Instalación - Taller 3 Con artisan

**1.** Abre una terminal en la raíz del proyecto.

**2.** Asegúrate de tener PHP en tu variable de entorno **`PATH`**.

**3.** Ejecuta el comando:

```
php artisan serve
npm run dev
```

**4.** El sitio será accesible en: `http://127.0.0.1:8000`
