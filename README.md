# One Piece Quotes Scraper

Este proyecto de Laravel **extraer citas (quotes)** de One Piece de un sitio web llamado [freakuotes](https://freakuotes.com/frases/30/one-piece),  las **almacena en un archivo JSON** local y luego las **sirve a través de una API**.

---

## 🚀 Características Principales

* **Scraping**: Extrae las citas de la URL objetivo [freakuotes](https://freakuotes.com/frases/30/one-piece).
* **Almacenamiento Persistente**: Guarda todas las citas obtenidas en un archivo JSON en el sistema de archivos de la aplicación.
* **API REST**: Ofrece un endpoint `/api/quotes` que devuelve las citas.

---

## 🛠️ Tecnologías Empleadas

* **Laravel 12**: El framework PHP.
* **GuzzleHttp**: Utilizado para realizar solicitudes HTTP eficientes a la página web objetivo.
* **Symfony DomCrawler**: Componente esencial para navegar y extraer datos de la estructura HTML de la página.
* **Symfony HttpClient**: El cliente HTTP que `DomCrawler` y `HttpBrowser` usan para las solicitudes.
* **PHP 8.2+**: La versión mínima de PHP requerida.

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

### 5. Ejecuta las migraciones
```bash
php artisan migrate
```

### 6. Levanta los servidores de desarrollo
Ejecuta los siguientes comandos:
```bash
php artisan serve
npm run dev
```

### 7. Visita la url 
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