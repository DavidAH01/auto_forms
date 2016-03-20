# auto_forms
Construcción automatica de formularios web basado en sufijos en los nombres de los campos que se crean en la base de datos.
# auto_forms
> Construcción automatica de formularios web (CRUD) basado en los campos que se crean en la base de datos.

> Desarrollo en PHP (Codeigniter 3 y Mysql)

### Problema
Al iniciar un proceso de desarrollo web muchas veces nos encontramos con el requerimiento de la administración de datos por parte de usuarios haciendo más largo el tiempo que debemos dedicar a un proyecto. 

### Propuesta
Esta iniciativa busca acortar el tiempo que se le dedica a los proyectos por parte de los desarrolladores creando un CRUD completo y automatizado de las tablas dentro de una base de datos.

**auto_forms** crea componentes de un formulario web basado en una lista de sufijos que se le colocan a los nombres de los campos de la base de datos extendiendo su funcionalidad y configuración a la parte visual que el usuario final va a utilizar.

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

### Adicionales
- El listado de registros cuenta con las caracteristicas adiciones de DataTables como el filtrado de información, paginado del lado del cliente, exportación de datos en formato CSV, PDF y Excel. Se pueden ordenar los registros con Drag&drop y se puede tener una previsualización de los campos con sufijos _color y _file.
- Se peden crear usuarios con permisos para diferentes secciones (tablas) administrables.
- La encriptación de contraseñas se basa en Bcrypt/Blowfish y la recuperación de la misma se hace a travez de correo electronico con un hash de autenticación unico.

License
----

MIT


**Free Software, Hell Yeah!**

