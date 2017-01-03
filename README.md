# auto_forms
> Construcción automatica de formularios web (CRUD) basado en los campos que se crean en la base de datos.

> Desarrollo en PHP (Codeigniter 3 y Mysql)

### Problema
Al iniciar un proceso de desarrollo web muchas veces nos encontramos con el requerimiento de la administración de datos por parte de usuarios haciendo más largo el tiempo que debemos dedicar a un proyecto. 

### Propuesta
Esta iniciativa busca acortar el tiempo que se le dedica a los proyectos por parte de los desarrolladores creando un CRUD completo y automatizado de las tablas dentro de una base de datos.

**auto_forms** crea componentes de un formulario web basado en una lista de sufijos que se le colocan a los nombres de los campos de la base de datos extendiendo su funcionalidad y configuración a la parte visual que el usuario final va a utilizar.

###Módulos de Apache
- headers (mod_headers).
- rewrite (mod_rewrite).

Debian Apache
```
a2enmod headers 
a2enmod rewrite
service restart apache2
```

###Instalación
1. Crear la base de datos e importar el archivo database/auto_forms.sql.
2. Si se cambia el nombre de la carpeta que contiene el sistema se debera modificar el archivo .htaccess en la linea 5.
3. En application/config/config.php en la linea 26 se debe colocar la ruta absoluta que contiene el sistema. Ejemplo http://midominio.com/auto_forms/ terminado en "/".
4. En application/config/config.php en la linea 38 se debe colocar el lenguaje que menejara el sistema, actualmente cuenta con español e ingles.
5. En application/config/database.php se deben colocar los datos de la base de datos (host, nombre, usuario y contraseña).
6. En application/views/templates/index.php en la linea 80 colocar la Clave del API de Google Maps (https://developers.google.com/maps/documentation/javascript/get-api-key).

###Primeros Pasos
- Para crear secciones administrables se deben crean las tablas en la base de datos normalmente.
- Los campos se deben crear con los sufijos correspondientes para que se creen los formularios automaticamente (Ver **Tipos de campos**), pero adicionalmente se deben crear 4 campos:
    1. id: Autoincrement y primary key.
    2. record_order: Integer.
    3. created_at y updated_at: datetime.
- En la tabla "administrable_tables" (que viene incluida en el archivo auto_forms.sql) se deben agregar los nombres de las tablas que se desean ver desde el administrador.
- ¡Ya está listo el sistema para ser usado!.

###Nuevos lenguajes
- El sistema utiliza Codeigniter como framework por lo que primero se deben descargar las traducciones para el idioma que se desea usar. Aquí estás las traducciones https://github.com/bcit-ci/codeigniter3-translations/tree/develop/language
- Dento de la carpeta de la traducción que se desea usar se debe crear un archivo llamado auto_forms_lang.php
- Ahora hay que copear el contenido de language/spanish/auto_forms_lang.php en el archivo que se creó en el paso anterior.
- Por último se debe reemplazar el contenido de las variables al idioma correspondiente.

### Tipos de campos
- _text *(tipo: varchar o text)*: Input tipo texto.
- _textarea *(tipo: text)*: Textarea potencializada con el plugin TinyMCE donde se pueden subir imagenes, insertar imagenes, videos, lineas de codigo, tablas, además de modificar los textos (Negrita, cursiva, tamaños, fuentes, alineación, etc).
- _number *(tipo: varchar)*: Input tipo texto con la posibilidad de definir el numero de digitos en la parte decimal y los caracteres de separación para los miles y las demacimas.
- _date *(tipo: varchar)*: Input tipo texto potencializado con el plugin de boostrap date-time picker para seleccionar fechas y horarios.
- _color *(tipo: varchar)*: Input tipo texto potencializado con el plugin Jscolor que permite configurar el guardado de colores en formato HEX, RGB o HSV.
- _slider *(tipo: varchar)*: Utilizando el widget de Jquery UI se puede configurar el valor maximo y minimo, el intervalo de aumento y si va ser utilizado para crear un rango.
- _select *(tipo: enum)*: Las opciones del select se crean a partir de los datos separados por comas colocados en la seccion de "valores" de phpmyadmin y solo se podrá seleccionar uno.
- _relation *(tipo: integer)*: Las opciones del select se crean a partir de los datos guardados en la tabla con el nombre que precese al sufijo y solo se pordrá seleccionar uno. Ejemplo *mi_tabla_a_relacionar_relation*.
- _multiselect *(tipo: set)*: Las opciones del select se crean a partir de los datos separados por comas colocados en la seccion de "valores" de phpmyadmin y se podrá seleccionar la cantidad de opciones que se desee.
- _multirelation *(tipo: varchar)*: Las opciones del select se crean a partir de los datos guardados en la tabla con el nombre que precese al sufijo y se podrá seleccionar la cantidad de opciones que se desee. Los datos seleccionados se guardarán en modo string separados por comas. Ejemplo *mi_tabla_a_relacionar_multirelation*.
- _radio *(tipo: enum)*: Las opciones en forma de "radio" se crean a partir de los datos separados por comas colocados en la seccion de "valores" de phpmyadmin y solo se podrá seleccionar uno.
- _checkbox *(tipo: set)*: Las opciones en forma de "checkbox" se crean a partir de los datos separados por comas colocados en la seccion de "valores" de phpmyadmin y se podrá seleccionar la cantidad de opciones que se desee.
- _map *(tipo: varchar)*: Crea un mapa de google maps con un marker que se puede mover para polocarlo en la posición que se desee. Se guardaran los datos de latitud y longitud.
- _gallery *(tipo: varchar)*: Crea un iframe en donde se podrá seleccionar todo tipo de archivos (según el requerimiento) para ser almacenados. Cuenta con uan funcion de "sortable" para organizar los archivos. Se guardara un id unico relacionado con la tabla "Uploads" propia del sistema.
- _file *(tipo: varchar)*: Input tipo file en donde solo se podra añadir un archivo.
- _steps *(tipo: text o longtext)*: Genera un par de campos a la vez (input tipo texto [titulo] y textarea con TinyMCE [contenido]) teniendo la posibilidad de agragar o remover pares. Se guarda un string con formato json.
- _list *(tipo: text o longtext)*: Genera una lista donde cada item puede ser ordenado por drag&drop. Se guarda un string con los items separados por comas.

### Adicionales
- El listado de registros cuenta con las caracteristicas adiciones de DataTables como el filtrado de información, paginado del lado del cliente, exportación de datos en formato CSV, PDF y Excel. Se pueden ordenar los registros con Drag&drop y se puede tener una previsualización de los campos con sufijos _color y _file.
- Se peden crear usuarios con permisos para diferentes secciones (tablas) administrables.
- La encriptación de contraseñas se basa en Bcrypt/Blowfish y la recuperación de la misma se hace a travez de correo electronico con un hash de autenticación unico.

### Capturas de pantalla
![Auto_forms](https://dl.dropboxusercontent.com/u/43961568/auto_forms/Captura%20de%20pantalla%202016-03-20%20a%20las%2012.43.16%20p.m..png "Auto_forms")

![Auto_forms](https://dl.dropboxusercontent.com/u/43961568/auto_forms/Captura%20de%20pantalla%202016-03-20%20a%20las%2012.43.20%20p.m..png "Auto_forms")

![Auto_forms](https://dl.dropboxusercontent.com/u/43961568/auto_forms/Captura%20de%20pantalla%202016-03-20%20a%20las%2012.44.16%20p.m..png "Auto_forms")

![Auto_forms](https://dl.dropboxusercontent.com/u/43961568/auto_forms/Captura%20de%20pantalla%202016-03-20%20a%20las%2012.44.20%20p.m..png "Auto_forms")

![Auto_forms](https://dl.dropboxusercontent.com/u/43961568/auto_forms/Captura%20de%20pantalla%202016-03-20%20a%20las%2012.44.27%20p.m..png "Auto_forms")

![Auto_forms](https://dl.dropboxusercontent.com/u/43961568/auto_forms/Captura%20de%20pantalla%202016-03-20%20a%20las%2012.44.30%20p.m..png "Auto_forms")

![Auto_forms](https://dl.dropboxusercontent.com/u/43961568/auto_forms/Captura%20de%20pantalla%202016-03-20%20a%20las%2012.44.33%20p.m..png "Auto_forms")

![Auto_forms](https://dl.dropboxusercontent.com/u/43961568/auto_forms/Captura%20de%20pantalla%202016-03-20%20a%20las%2012.44.40%20p.m..png "Auto_forms")

![Auto_forms](https://dl.dropboxusercontent.com/u/43961568/auto_forms/Captura%20de%20pantalla%202016-03-20%20a%20las%2012.44.47%20p.m..png "Auto_forms")

![Auto_forms](https://dl.dropboxusercontent.com/u/43961568/auto_forms/Captura%20de%20pantalla%202016-03-20%20a%20las%2012.45.45%20p.m..png "Auto_forms")

![Auto_forms](https://dl.dropboxusercontent.com/u/43961568/auto_forms/Captura%20de%20pantalla%202016-03-20%20a%20las%2012.45.57%20p.m..png "Auto_forms")

![Auto_forms](https://dl.dropboxusercontent.com/u/43961568/auto_forms/Captura%20de%20pantalla%202016-03-20%20a%20las%2012.46.02%20p.m..png "Auto_forms")

![Auto_forms](https://dl.dropboxusercontent.com/u/43961568/auto_forms/Captura%20de%20pantalla%202016-03-20%20a%20las%2012.46.08%20p.m..png "Auto_forms")

![Auto_forms](https://dl.dropboxusercontent.com/u/43961568/auto_forms/Captura%20de%20pantalla%202016-03-20%20a%20las%2012.46.16%20p.m..png "Auto_forms")

![Auto_forms](https://dl.dropboxusercontent.com/u/43961568/auto_forms/Captura%20de%20pantalla%202016-03-20%20a%20las%2012.46.26%20p.m..png "Auto_forms")

![Auto_forms](https://dl.dropboxusercontent.com/u/43961568/auto_forms/Captura%20de%20pantalla%202016-03-20%20a%20las%2012.46.59%20p.m..png "Auto_forms")

![Auto_forms](https://dl.dropboxusercontent.com/u/43961568/auto_forms/Captura%20de%20pantalla%202016-03-20%20a%20las%2012.47.38%20p.m..png "Auto_forms")

![Auto_forms](https://dl.dropboxusercontent.com/u/43961568/auto_forms/Captura%20de%20pantalla%202016-03-20%20a%20las%2012.48.10%20p.m..png "Auto_forms")

![Auto_forms](https://dl.dropboxusercontent.com/u/43961568/auto_forms/Captura%20de%20pantalla%202016-03-20%20a%20las%2012.48.26%20p.m..png "Auto_forms")

![Auto_forms](https://dl.dropboxusercontent.com/u/43961568/auto_forms/Captura%20de%20pantalla%202016-03-20%20a%20las%2012.49.12%20p.m..png "Auto_forms")

![Auto_forms](https://dl.dropboxusercontent.com/u/43961568/auto_forms/Captura%20de%20pantalla%202016-08-20%20a%20las%2010.26.46%20a.m..png "Auto_forms")

![Auto_forms](https://dl.dropboxusercontent.com/u/43961568/auto_forms/Captura%20de%20pantalla%202016-03-20%20a%20las%2012.51.08%20p.m..png "Auto_forms")

Licencia
----

MIT


**Free Software, Hell Yeah!**

