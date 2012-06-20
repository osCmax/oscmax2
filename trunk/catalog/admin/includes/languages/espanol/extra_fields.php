<?php
/*
$Id: extra_fields.php 1011 2011-01-06 23:38:01Z michael.oscmax@gmail.com $

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

define('HEADING_TITLE', "Campos extra de productos");
define('TABLE_HEADING_ID', "ID");
define('TABLE_HEADING_LABEL', 'Idioma/Etiqueta');
define('TABLE_HEADING_ORDER', 'Orden');
define('TABLE_HEADING_STATUS', 'Estado en catálogo');
define('TABLE_HEADING_ACTION', 'Acción');
define('TEXT_YES', 'Sí');
define('TEXT_NO', 'No');
define('BUTTON_NEW', 'Nuevo campo extra');
define('BUTTON_EDIT_VALUES', 'Editar lista de valores');
define('ENTRY_LABEL', 'Etiqueta: ');
define('ENTRY_ACTIVE', '<b>Campo activo</b>');
define('ENTRY_ACTIVATE_NOW', 'Mostrar campo a los clientes: ');
define('ENTRY_SHOW_ADMIN', 'Mostrar campo en el panel de administración incluso si está oculto para los clientes: ');
define('ENTRY_ORDER', 'Orden: ');
define('ENTRY_VALUE_LIST', 'Utilizar una lista de valores: ');
define('ENTRY_SEARCH', 'Habilitar Búsqueda avanzada para este campo: ');
define('ENTRY_TEXT_ENTRY', 'Introducir texto usando: ');
define('TEXT_SINGLE_LINE', 'línea simple');
define('TEXT_MULTILINE', 'área de texto');
define('TEXT_LIST_IGNORES', ' Se ignora área de texto si el campo utiliza una lista de valores.');
define('TEXT_TEXTAREA_NOTE', 'NOTA: Campos con área de texto no se pueden mostrar en el listado de productos.');
define('ENTRY_LISTING', 'Mostrar campo en listado de productos: ');
define('ENTRY_SIZE', 'Máximo numero de caracteres permitidos en el campo (se igonora si el campo utiliza lista de valores o área de texto): ');
define('ENTRY_META', 'Utilizar el valor del campo como META Keyword para los buscadores de Internet: ');
define('ENTRY_LIST_TYPE', 'De la lista de valores el usuario puede seleccionar: ');
define('TEXT_SINGLE_VALUE', 'valor individual');
define('TEXT_MULTIPLE_VALUE', 'múltiples valores');
define('ENTRY_CHAIN', 'Mostrar cadena de valores padre del campo (requiere lista de valores de selección individual): ');
define('ENTRY_RESTRICT', 'Permitir utilizar el campo para restringir listado de productos (requiere lista de valores de selección individual): ');
define('ENTRY_SEARCH_BOX', 'Utilizar el campo en la caja de Búsqueda rápida avanzada (requiere lista de valores de selección individual y Búsqueda avanzada): ');
define('ENTRY_CHECKBOX', 'Los valores se seleccionan mediante: ');
define('TEXT_DROPDOWN', 'Menú desplegable');
define('TEXT_CHECKBOX', 'Casillas de verificación');
define('TEXT_RADIO', 'Botones radio');
define('TEXT_MS_CHECKBOX_NOTE', 'NOTA: Este parámetro sólo se aplica a las lista de valores de selección individual que utilizan el tipo seleccionado para la introducción de datos excepto en la caja de Búsqueda rápida avanzada donde siempre se utiliza una menú desplegable. Las listas de valores de selección múltiple siempre utilizan casillas de verificación para la introducción de datos.');
define('ENTRY_COLUMNS', 'Número de columnas de valores para usar con casillas de verificación/botones radio: ');
define('ENTRY_DISPLAY_TYPE', 'Mostrar lista de valores del campo como: ');
define('TEXT_TEXT', 'Sólo texto');
define('TEXT_IMAGE', 'Sólo imagen (con texto alt)');
define('TEXT_IMAGE_TEXT', 'Imagen y texto');
define('TEXT_SAMPLE', 'Ejemplo de visualización');
define('ERROR_COLS_OUTOFRANGE', '¡El número de columnas debe ser un número entre 1 y 255!');
define('ERROR_OUTOFRANGE', '¡El tamaño máximo debe ser un número entre 1 y 255!');
define('ERROR_ENTRY_REQUIRED', '¡No has introducido nada! ');
define('ERROR_INCOMPATIBLE_MS_SC', '¡Los campos que utilizan listas de valores de selección múltiple no pueden mostrar la cadena de valores padre!');
define('ERROR_INCOMPATIBLE_TA_PL', '¡Los campos que utilizan un área de texto no se pueden mostrar en el listado de productos!');
define('ERROR_INCOMPATIBLE_MS_RPL', '¡Los campos que utilizan listas de valores de selección múltiple no pueden restringir listado de productos!');
define('ERROR_INCOMPATIBLE_MS_QS', '¡Los campos que utilizan listas de valores de selección múltiple se no pueden usar en la caja de búsqueda rápida avanzada!');
define('ERROR_AS_REQUIRED', 'Este campo no se mostrará en la caja de Búsqueda rápida avanzada a menos que habilites la Búsqueda avanzada para este campo.');
define('TEXT_APPLIES_LIST_ONLY', 'Los siguientes parámetros sólo se aplican si Utilizar una lista de valores está configurado a Sí. Los puedes ignorar para campos con áreas de texto.');
define('TEXT_ENABLED', 'Habilitado');
define('TEXT_DISABLED', 'Deshabilitado');
define('TEXT_SIZE', 'Tamaño máximo: ');
define('TEXT_SEARCHABLE', 'Directorio de búsqueda: ');
define('TEXT_META', 'META Keyword: ');
define('TEXT_USER_SELECTS', 'Los usuarios pueden seleccionar: ');
define('TEXT_SELECTED_BY', 'Seleccionado usando: ');
define('TEXT_RESTRICTS', 'Restringir listado de productos: ');
define('TEXT_SHOW_PARENTS', 'Mostrar valores padre: ');
define('TEXT_SEARCH_BOX', 'Caja de Búsqueda rápida: ');
define('TEXT_COLUMNS', 'Número de columnas Casillas/Botones: ');
define('TEXT_DISPLAY_TYPE', 'Mostrar valores como: ');
define('TEXT_LINKED_TO', 'Vinculado al campo nº');
define('HEADING_NEW', 'Creando nuevo campo');
define('HEADING_EDIT', 'Editando campo existente nº');
define('ERROR_ACTIVE', '¡El campo debe estar activado al menos para un idioma!');
define('ERROR_LABEL', '¡La etiqueta del campo para el idioma activo %s no se puede dejar en blanco!');
define('WARNING_TRUNCATE', '¡Se perderá información si reduces la longitud del campo a este tamaño! ¡Actualmente %d descripciones de productos contienen valores que son más largos que este tamaño! Para evitar pérdidas de información este campo necesitaría ser de largo al menos %d caracteres. Si realmente quieres reducir el tamaño de este campo y provocar que se trunquen los datos entonces pulsa el botón de Guardar para confirmar el cambio.');
define('WARNING_LANGUAGE_IN_USE', '¡Este campo tiene actualmente %d productos con valores configurados para el idioma %s! Si realmente quieres desactivar el campo para este idioma entonces pulsa el botón de Guardar para confirmar el cambio. La información actual no será borrada pero tampoco se podrá cambiar ni visualizar.');
define('HEADING_DELETE', 'Eliminar el campo extra de producto nº');
define('TEXT_FIELD_DATA', '&nbsp;<b>Etiqueta:</b> %s <b>Utilizado por:</b> %d productos');
define('TEXT_ARE_SURE', '¿Estás seguro que quieres eliminar este campo?');
define('TEXT_VALUES_GONE', ' ¡Todos los valores almacenados en las listas de valores para este campo serán eliminados!');
define('TEXT_LINKS_DESTROYED', ' ¡Este campo está vinculado con otro campo y todos los vínculos entre sus valores se eliminarán si eliminas este campo!');
define('TEXT_CONFIRM_DELETE', '¿Estás realmente seguro que quieres eliminar este campo? ¡Se perderá toda la información almacenada de este campo!');
define('BUTTON_UNLINK', 'Desvincular campo');
define('BUTTON_LINK', 'Vincular este campo a otro');
define('BUTTON_CREATE_LINK', 'Crear vínculo hacia el campo seleccionado');
define('HEADING_UNLINK', 'Desvincular campo %d del campo %d');
define('TEXT_NUM_LINKED', 'Actualmente %d valores de este campo están vinculados al otro campo.');
define('TEXT_SURE_UNLINK', '¿Estás seguro que quieres desvincular estos dos campos?');
define('TEXT_LINKS_GONE', ' ¡Todos los vínculos entre los valores de estos campos se eliminarán si continúas!');
define('TEXT_CONFIRM_UNLINK', '¿Estás realmente seguro que quieres desvincular estos dos campos? Todos los vínculos entre sus valores se eliminarán si continúas!');
define('ERROR_NO_FIELD', '¡No se ha encontrado el campo para vincular!');
define('TABLE_HEADING_SELECT', 'Selecciona');
define('TEXT_SELECT_LINK', ' Selecciona un campo de la lista a continuación para vincular con este campo. Los idiomas marcados con un * en la lista pueden tener valores vinculados a este campo.');
define('TEXT_NOT_LINKABLE', 'Este campo no tiene ningún idioma activo que coincidan con el campo al que va a ser vinculado y por tantono puede ser vinculado a él.');
define('ERROR_NONE_LINKABLE', '¡No se han encontrado campos que puedan ser vinculados a este!');
define('ERROR_WRONG_TYPE', '¡Los campos a vincular deben usar listas de valores!');
define('ERROR_SAME_TYPE', '¡Un campo a vincular debe usar una lista de valores de selección individual mientras que el otro debe usar una lista de valores de selección múltiple!');
define('ERROR_ALREADY_LINKED', 'El campo %d ya está vinculado a otro campo!');
define('TEXT_LINK_SUCCESS', 'El campo %d ha sido vinculado correctamente al campo %d.');
define('ERROR_NOT_LINKED', '¡Este campo no está vinculado a otro!');
define('TEXT_ADMIN_AVAILABLE', 'Disponible en administración: ');

define('HEADING_NO_EPF', 'Campos extra de productos');
define('TEXT_NO_EPF', 'Actualmente no hay campos extra definidos.<br><br>Por favor pulsa en <b>Nuevo campo extra</b> para crear uno nuevo.');
define('ENTRY_ALL_CATEGORIES', '¿Se aplica este campo a todas las categorías?');
define('ENTRY_CHECK_CATEGORIES', 'Selecciona las casillas para definir a qué categorías se aplica este campo: <br>Téngase en cuenta que serán ignoradas si el parámetro \'¿Se aplica este campo a todas las categorías?\' está configurado a SÍ. <ul><li>Si se selecciona una categoría todas las subcategorías bajo ella son incluidas automáticamente. </li><li>Si no se selecciona ninguna categoría entonces \'¿Se aplica este campo a todas las categorías?\' se configurará a SÍ.</li><li>Seleccionar la categoría Inicio es lo mismo que seleccionar todas las categorías.</li></ul>');
define('TEXT_ALL_CATEGORIES_HELP', 'Si no quieres que este campo se aplique a todas las categorías de la tienda, configúralo a No y selecciona las categorías en las que se aplica con las casillas que se mostrarán.');
define('TEXT_ACTIVATE_NOW_HELP', 'Controla si la información del campo se mostrará o no a los clientes en el catálogo.');
define('TEXT_SHOW_ADMIN_HELP', 'Controla si se puede o no introducir y visualizar la información del campo durante la introducción del producto en el sistema, habiendo configurado el campo como no visible en el catálogo. Este parámetro permite introducir información de productos mientras se mantiene esa información oculta a los clientes que navegan por la parte del catálogo.<br><br>Esto permite tener campos que almacenan información de un producto, siendo esa información útil solamente para la tienda pero no para los clientes. También hace posible mantener un campo oculto hasta que la información de ese campo se haya introducido en todos los productos del catálogo. Si tanto este parámetro como \'Mostrar campo a los clientes\' se configuran a NO entonces no se pueden introducir datos en el campo. REcuerda que un campo que es visible en el catálogo es siempre visible también en el panel de administración.');
define('TEXT_LISTING_HELP', 'Controla si se mostrará o no el campo como una entrada disponible en la página de Búsqueda avanzada del catálogo. Todos los campos creados con esta contribución podrán ser buscados por el Criterio de búsqueda siempre que se marque la opción de buscar en las descripciones, pero este parámetro permite a los usuarios buscar un valor en un campo específico.');
define('TEXT_TEXT_HELP', 'Una línea simple o un área de texto determina quñe tipo de campo de texto se crea en la base de datos. Si se define como línea simple en la tabla de descripción de productos de la base de datos se crea un campo de tipo VARCHAR utilizando en máximo número de caracteres. Si se define como área de texto, e crea un campo de tipo TEXT y se ignora el máximo número de caracteres. Una vez que se haya creado un campo de texto no se puede cambiar el tipo entre línea simple o área de texto. Este valor es ignorado si se establece \'Utilizar una lista de valores\' a SI.');
define('TEXT_VALUE_LIST_HELP', 'Determina si la información para el campo se introduce en un campo de text vacío estándar (si se establece a NO) o como una lista de valores predefinidos (si se establece a SÍ). Si se elige una lista de valores entonces se ignora el máximo número de caracteres ya que a todos los valores de la lista se les permite una longitud máxima de 64 caracteres.');
define('TEXT_VALUE_LIST_WARNING', ' Una vez que se configure este valor para el nuevo campo extra <b>no se puede cambiar</b>. Un campo de texto debe permanecer como un campo de texto y un campo de lista de valores debe permanecer como una campo de lista de valores. Si te equivocas en este parámetro deberás eliminar el campo y crear uno nuevo.');
define('TEXT_LIST_TYPE_HELP', 'Selecciona si quieres poder seleccionar un valor individual o múltiples valores. Por favor lee el mensaje de advertencia antes de guardar el campo extra de producto.');
define('TEXT_LIST_TYPE_WARNING', 'Los valores para productos para los dos tipos distintos de campos de lista son almacenados en dos formatos totalmente diferentes en la base de datos por lo que una vez que se configure este tipo <b>no se puede cambiar</b>. <br><br>Las listas de valores de selección individual almacenan el valor del producto como un entero que es simplemente un puntero al valor real en el fichero de lista de valores. <br><br>Las listas de valores de selección múltiples almacenan el valor del producto en un campo de texto como una serie de punteros separados por un delimitador. Cuántos punteros se almacenen depende totalmente de cuántos valores se seleccionen para el producto.  <br><br><b>Si te equivocas en este parámetro deberás eliminar el campo y crear uno nuevo.</b>');
define('TEXT_CHAIN_HELP', 'Esta opción se aplica sólo si únicamente se puede seleccionar una valor individual de la lista. Las listas de selección múltiple no pueden tener valores padre. Por ejemplo, si se creó un campo para un tipo de producto y uno de los valores para ese campo era <b>Películas</b> entonces se podrían crear valores bajo Películas como <b>VHS, DVD y BluRay</b>. Si entonces un producto tiene el valor establecido a DVD, con \'Mostrar cadena de valores padre\' habilitado el valor se mostraría como <b>Películas : DVD</b>. De otra forma se mostraría simplemente como <b>DVD</b>.');
define('TEXT_RESTRICT_HELP', 'La opción Restringir listado de productos permite a los usuarios restringir los resultados de un listado de productos en la tienda. POr favor téngase en cuenta que las listas de valores de selección múltiple no pueden restringir estos listados.');
define('TEXT_SEARCH_HELP','Determina si una lista de valores de selección individual tendrá o no un menú desplegable en la caja de Búsqueda rápida avanzada.');
define('TEXT_CHECKBOX_HELP', 'Establece qué método usa una lista de valores de selección individual para introducir datos, tanto en la parte de administración como en la página de Búsqueda avanzada del catálogo. Es mejor configurar el menú desplegable para grandes listas de valores.');
define('TEXT_COLUMNS_HELP', 'Determina cuántos valores se listan en cada columna durante la entrada de datos cuando se usan <b>botones radio</b> para las listas de valores de selección individual o cuando se usan listas de valores <b>de selección multiple</b> (que siempre utilizan <b>casillas de verificación</b> para la entrada de datos). Téngase en cuenta que el número final de columnas mostradas puede acabar siendo menos para una lista de valores de selección múltiple si la has vinculado a otro campo.');

?>