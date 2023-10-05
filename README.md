# ProjectII_BasededatosSantosHernandez
# Documentación de Clases

Este repositorio contiene una aplicación web con varias clases PHP que se utilizan para implementar diferentes funcionalidades. A continuación, se proporciona una breve descripción de cada una de las clases y su propósito:

## Clase `registro`

- **Propósito**: Esta clase se encarga de manejar el proceso de registro de nuevos usuarios en la aplicación web.

- **Funcionalidad principal**:
  - Valida los datos del formulario de registro, como nombre, correo electrónico y contraseña.
  - Realiza la inserción segura de los datos del usuario en la base de datos.
  - Redirige a los usuarios a la página de inicio de sesión después del registro.

## Clase `Subcategorias`

- **Propósito**: Esta clase se utiliza para mostrar subcategorías de productos en función de una categoría seleccionada.

- **Funcionalidad principal**:
  - Recupera y muestra las subcategorías de productos asociadas a una categoría específica.
  - Permite a los usuarios navegar por las subcategorías y explorar productos.

## Clase `obtener_categorias`

- **Propósito**: Esta clase se encarga de recuperar y mostrar las subcategorías de productos para una categoría dada.

- **Funcionalidad principal**:
  - Recupera y muestra las subcategorías de productos asociadas a una categoría específica.
  - Proporciona enlaces a las subcategorías para que los usuarios puedan explorar productos.

## Clase `conexion`

- **Propósito**: Esta clase establece la conexión con la base de datos.

- **Funcionalidad principal**:
  - Establece una conexión segura con la base de datos utilizando los parámetros de conexión proporcionados.
  - La conexión se utiliza en otras clases para interactuar con la base de datos.

## Clase `carrito`

- **Propósito**: Esta clase maneja la visualización de detalles del carrito de compras.

- **Funcionalidad principal**:
  - Verifica el tipo de sesión (usuario registrado o invitado).
  - Recupera información sobre el carrito de compras, incluyendo productos, cantidades y precios.
  - Muestra el detalle del carrito de compras en la página.

Cada una de estas clases desempeña un papel importante en la aplicación web y contribuye a su funcionalidad general. Asegúrate de revisar y ajustar las consultas SQL y las funcionalidades según las necesidades específicas de tu base de datos.


## Requisitos para Ejecutar la Página Web

Para ejecutar esta página web en tu entorno local, necesitas cumplir con los siguientes requisitos:

1. **Servidor Web**: Debes tener un servidor web instalado en tu sistema. Puedes utilizar soluciones como Apache, Nginx o XAMPP según tu preferencia.

2. **Base de Datos MySQL**: Asegúrate de tener un servidor de base de datos MySQL instalado y funcionando. Puedes usar herramientas como phpMyAdmin para administrar la base de datos.

3. **PHP**: La aplicación web está escrita en PHP. Asegúrate de tener PHP instalado en tu sistema. Puedes verificar la instalación ejecutando `php -v` en tu terminal.

4. **Conexión a Internet**: La aplicación puede requerir acceso a Internet para cargar fuentes web y otros recursos externos.

5. **Archivos de Configuración**: Asegúrate de configurar los archivos de conexión a la base de datos, como `conexion.php`, con la información correcta de tu servidor MySQL.

6. **Habilitar PHP en Servidor Web**: Asegúrate de que PHP esté habilitado en la configuración de tu servidor web para que pueda procesar los archivos PHP de la aplicación.

7. **Navegador Web**: Puedes utilizar cualquier navegador web moderno, como Google Chrome, Mozilla Firefox o Microsoft Edge, para acceder a la aplicación web.

8. **Editor de Texto o IDE**: Para modificar y personalizar la aplicación web, es útil tener un editor de texto o un entorno de desarrollo integrado (IDE) como Visual Studio Code, PhpStorm o cualquier otro que prefieras.

Una vez que hayas cumplido con estos requisitos, puedes clonar el repositorio de la aplicación web en tu sistema y ejecutarla en tu servidor local siguiendo las instrucciones proporcionadas en la documentación.

