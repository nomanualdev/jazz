# Jazz - Plugin de Ejemplo para DevDay SJ 2025

**Versión:** 1.0.0  
**Autor:** Manfred Rodríguez  
**Sitio Web del Autor:** [https://mojitowp.com](https://mojitowp.com)  
**Licencia:** GPLv2 o superior

## Descripción

Jazz es un plugin de ejemplo desarrollado para el taller "Crea tu Propio Plugin de WordPress desde Cero" en el WordPress DevDay San José 2025. Este plugin sirve como base para aprender a crear funcionalidades personalizadas en WordPress, incluyendo la integración de formularios y manejo de datos mediante AJAX.

## Características

- **Integración de formularios personalizados:** Añade formularios a tus páginas o entradas de WordPress.
- **Manejo de datos con AJAX:** Procesa los datos del formulario sin recargar la página.
- **Estructura modular:** Código organizado en archivos separados para facilitar su mantenimiento y comprensión.

## Instalación

1. **Descarga del plugin:**
   - Puedes obtener la última versión del plugin desde el repositorio de GitHub: [https://github.com/nomanualdev/jazz](https://github.com/nomanualdev/jazz).

2. **Instalación manual:**
   - Descomprime el archivo `jazz.zip`.
   - Sube la carpeta `jazz` al directorio `/wp-content/plugins/` de tu instalación de WordPress.

3. **Activación del plugin:**
   - Ve al panel de administración de WordPress.
   - Navega a `Plugins` > `Plugins instalados`.
   - Busca "Jazz" en la lista y haz clic en `Activar`.
  
## Uso

Después de activar el plugin, puedes utilizar el shortcode `[jazz_contact_form]` para insertar el formulario personalizado en cualquier página o entrada de tu sitio. Este formulario está diseñado para enviar datos mediante AJAX y mostrar un mensaje de confirmación al usuario.

## Personalización

El plugin está estructurado de manera modular, con archivos separados para diferentes funcionalidades:

- `jazz.php`: Archivo principal del plugin que inicializa las funciones y engancha las acciones necesarias.
- `public/js/jazz.js`: Archivo JavaScript que maneja la lógica de envío del formulario mediante AJAX.
- `includes/class-jazz.php`: Clase PHP que procesa los datos enviados desde el formulario.
- `includes/class-admin.php`: Clase PHP que procesa la administración desde WordPress.
- `includes/class-email.php`: Clase PHP que permite enviar copia por correo.

Puedes modificar estos archivos según tus necesidades para ampliar o adaptar las funcionalidades del plugin.

## Recursos Adicionales

Para obtener más información y recursos relacionados con el desarrollo de plugins en WordPress, puedes consultar los siguientes enlaces:

- **Archivos de apoyo del taller:** [https://mojitowp.com/devday/](https://mojitowp.com/devday/)
- **Documentación oficial de WordPress sobre desarrollo de plugins:** [https://developer.wordpress.org/plugins/](https://developer.wordpress.org/plugins/)

## Licencia

Este plugin se distribuye bajo la Licencia Pública General de GNU v2 o superior.

---

*Este plugin fue desarrollado como parte del taller "Crea tu Propio Plugin de WordPress desde Cero" en el WordPress DevDay San José 2025.*
