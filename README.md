
# CRUD Articles

Bienvenido a **CRUD_Articles**, un proyecto que implementa un sistema básico de gestión de artículos utilizando [PHP](https://www.php.net/), [MySQL](https://www.mysql.com/), y una interfaz responsive desarrollada con [Tailwind CSS](https://tailwindcss.com/).

## Características principales

- **Crear**: Permite agregar nuevos artículos con título, contenido y etiquetas.
- **Leer**: Visualiza una lista de artículos con detalles completos.
- **Actualizar**: Edita artículos existentes de forma sencilla.
- **Eliminar**: Elimina artículos que ya no son necesarios.
- **Interfaz amigable**: UI moderna y responsiva gracias a Tailwind CSS.

## Tecnologías utilizadas

- **Backend**: PHP 8+.
- **Frontend**: HTML5, Tailwind CSS.
- **Base de datos**: MySQL.
- **Servidor local**: XAMPP.
- **Herramientas adicionales**: Visual Studio Code.

## Estructura del proyecto

```
CRUD_Articles/
├── database/
│   ├── tables.sql           # Esquema de las tablas de la base de datos
├── scripts/
│   ├── script.php           # Script para generar artículos de prueba
├── public/
│   ├── screenshots/         # Capturas de pantalla del proyecto
│   │   ├── ...              # Archivos de imágenes (articles.png, new.png, etc.)
│   ├── new.php              # Página para crear un nuevo artículo
│   ├── delete.php           # Página para eliminar un artículo específico
│   ├── update.php           # Página para actualizar un artículo
│   ├── articles.php         # Página con la lista de artículos disponibles
├── src/
│   ├── Database/
│   │   ├── Article.php       # Clase para gestionar artículos
|   |   ├── Category          # Clase para gestionar categorías de artículos
│   │   ├── Connection.php    # Clase para manejar la conexión a la base de datos
│   │   ├── QueryExecutor.php # Clase para ejecutar consultas
│   ├── Utils/
│       ├── ...               # Clases con métodos auxiliares para el proyecto
├── .env                     # Variables de entorno del proyecto
├── README.md                # Documentación del proyecto
```

## Instalación y configuración

1. Clona este repositorio:
   ```bash
   git clone https://github.com/Omatple/CRUD_Articles.git
   ```

2. Configura tu entorno local:
   - Descarga e instala [XAMPP](https://www.apachefriends.org/).
   - Crea una base de datos en MySQL e importa el archivo `database.sql`.

3. Configura el archivo `.env` con tus credenciales de base de datos:
   ```env
   PORT=3306
   HOST=localhost
   DBNAME=crud_articles
   USER=root
   PASSWORD=tu_password
   ```

4. Inicia el servidor local:
   - Coloca el proyecto en la carpeta `htdocs` de XAMPP.
   - Accede a [http://localhost/CRUD_Articles](http://localhost/CRUD_Articles).

## Capturas de pantalla

### Página principal y formulario de creación
| Página principal               | Formulario de creación           |
|--------------------------------|-----------------------------------|
| ![Página principal](public/screenshots/articles.png) | ![Formulario de creación](public/screenshots/new.png) |

### Formulario de actualización y mensajes de estado
| Formulario de actualización     | Mensajes de estado              |
|---------------------------------|----------------------------------|
| ![Formulario de actualización](public/screenshots/update.png) | ![Mensajes de estado](public/screenshots/status-messages.png) |

## Cómo contribuir

1. Haz un fork del repositorio.
2. Crea una nueva rama:
   ```bash
   git checkout -b feature/new-feature
   ```
3. Realiza los cambios y haz un commit:
   ```bash
   git commit -m "Agregada nueva funcionalidad"
   ```
4. Envía un pull request.

## Licencia

Este proyecto está licenciado bajo la [MIT License](LICENSE).

## Contacto

¿Tienes preguntas o sugerencias? ¡Házmelo saber!  
**Ángel Martínez Otero** - [LinkedIn](https://linkedin.com/in/Omatple)  
