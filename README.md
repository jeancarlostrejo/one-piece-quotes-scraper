# One Piece Quotes Scraper

Este proyecto de Laravel **extraer citas (quotes)** de One Piece de un sitio web llamado [freakuotes](https://freakuotes.com/frases/30/one-piece), las **almacena en un archivo JSON** local y luego las **sirve a través de una API**, bien sea mostrandolas todas u obteniendo una cita aleatoriamente. **¡Inspirate con las frases del mundo de One Piece!**

---

## 🚀 Características Principales

* **Scraping**: Extrae las citas de la URL objetivo [freakuotes](https://freakuotes.com/frases/30/one-piece).
* **Almacenamiento Persistente**: Guarda todas las citas obtenidas en un archivo JSON en el sistema de archivos de la aplicación.
* **Implementación de Caché**: Optimiza el acceso a las citas almacenadas utilizando el sistema de caché de Laravel. Los datos del archivo JSON se almacenan en memoria durante un período definido, reduciendo la necesidad de leer el archivo en cada solicitud.
* **API REST**: Ofrece un endpoint `/api/quotes` que devuelve todas las citas; y otro endpoint `/api/quotes/random` para obtener una cita aleatoria.
* **Página para cita aleatoria**: Una página donde ir generando y mostrando citas aleatorias con `/quote-random`
* **Implementación de queues y jobs**: Realiza el scraping del sitio en segundo plano por medio de las queue y los jobs, lo que permite que la operación sea más eficiente y no bloquee el flujo de la aplicación mientras se realiza el proceso.
* **Implementación de envio de email utilizando tareas programadas**: Se configura el envio por correo electrónico de una cita aleatoria utilizando Resend como api de correo; además de utilizar comandos de consola y tareas programadas para programar el envio de correo en un momento específico.
---

## 🛠️ Tecnologías Empleadas

* **Laravel 12**: El framework PHP.
* **GuzzleHttp**: Utilizado para realizar solicitudes HTTP eficientes a la página web objetivo.
* **Symfony DomCrawler**: Componente esencial para navegar y extraer datos de la estructura HTML de la página.
* **Symfony HttpClient**: El cliente HTTP que `DomCrawler` y `HttpBrowser` usan para las solicitudes.
* **PHP 8.2+**: La versión mínima de PHP requerida.
* **HTML, Tailwind CSS**: para dar estilos a la página.
* **Resend**: API de correo electrónico para desarrolladores

---

## ⚙️ Configuración del Proyecto

Sigue estos pasos para poner en marcha tu proyecto localmente:

### 1. Clonar el Repositorio

Primero, descarga o clona el repositorio a tu máquina:

```bash
git clone <URL_DEL_REPOSITORIO>
cd one-piece-quotes-scraper
```
### 2. Instalar Dependencias
Ejecuta los siguientes comandos:
```bash
composer install
npm install
```

### 3. Configuración del entorno
Copia el archivo .env.example y renombralo a .env y genera una nueva clave de aplicación:

 ```bash composer
cp .env.example .env
php artisan key:generate
```

###  4. Configurar la URL de Scraping
Abre el archivo .env y asegúrate de configurar la URL de la página objetivo [freakuotes](https://freakuotes.com/frases/30/one-piece) 

###  5. Configurar El Driver de Caché
Abre el archivo .env y configurar el driver de caché que desees utilizar (por defecto es driver es `CACHE_STORE=database`)

###  6. Configurar El Driver de colas
Abre el archivo .env y configurar el driver de caché que desees utilizar (por defecto es driver es `QUEUE_CONNECTION=database`).

Para usar el controlador de cola de la base de datos, necesitará una tabla de base de datos para almacenar los jobs. Normalmente, esto se incluye en la migración de base de datos predeterminada de Laravel, `0001_01_01_000002_create_jobs_table.php`; sin embargo, si su aplicación no incluye esta migración, puede usar el comando artisan para crearla:
```bash
php artisan make:queue-table
```
### Bonus. Configurar envío de correo
Puede configurar un servicio para el envío de correo electrónico. En este caso se utilizó [Resend](https://resend.com/). Puede consultar toda la documentación para laravel [aquí](https://resend.com/docs/send-with-laravel).


### 7. Ejecuta las migraciones
```bash
php artisan migrate
```

### 8. Levanta los servidores de desarrollo
Ejecuta los siguientes comandos, cada uno en una terminal diferente:
```bash
php artisan serve
php artisan queue:work
npm run dev
```

***IMPORTANTE*** Para la ejecución y prueba de tareas programadas deberá ejecutar en una terminal diferente el comando:
```bash
php artisan schedule:run
```

### 9. Visita la url 
Visita la dirección http://127.0.0.1:8000

---

## 🏃 Uso
### 1. Scrapea el Sitio Web
Visita la página http://127.0.0.1:8000/scraping para scrapear el sitio web de [freakuotes](https://freakuotes.com/frases/30/one-piece) y generar el json con los quotes

### 2. Acceder a las Citas a través de la API
Una vez que las citas hayan sido scrapeadas y guardadas, puedes acceder a ellas a través de la siguiente ruta:
```
GET /api/quotes
```
Esta ruta devolverá un JSON con todas las citas almacenadas en el archivo quotes.json. Por ejemplo:
```json
[
    {
        "quote": "¡Quiero crear un mundo donde todos puedan comer hasta saciarse!",
        "author": "Monkey D. Luffy"
    },
    {
        "quote": "Los fuertes viven y los débiles mueren.",
        "author": "Kaido"
    },
]
```

### 3. Acceder a una cita aleatoria a través de la API
Una vez que las citas hayan sido scrapeadas y guardadas, puedes obtener una cita aleatoria de la siguiente ruta:
```
GET /api/quotes/random
```
Esta ruta devolverá un JSON con una cita aleatoria. Por ejemplo:
```json
{
    "quote": "Un hombre que no es capaz de secar las lágrimas de una mujer no es un hombre",
    "author": "Kuroashi no Sanji"
}
```
### 4. Acceder a una cita aleatoria a través de una página
Puedes visitar la página `/quote-random` en la que te mostrará una tarjeta con una cita aleatoria y donde a través de un botón puedes obtener una nueva cita

### 5. Obtener una cita aleatoria en la terminal
Puede utilizar el comando `php artisan quote:random` para obtener una cita en la terminal