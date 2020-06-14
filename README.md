# ABM de Clientes

El proyecto consiste de un ABM de Clientes desarrollado bajo el Framework Symfony en su versión 2.8.
Desarrollo realizado para una prueba técnica.

# Requisitos

* PHP 5.6.X o superior;
* [Composer](https://getcomposer.org/)
* y los requerimientos usuales de una aplicación [Symfony](https://symfony.com/doc/current/setup.html)

# Instalación
Ejecuta los siguientes comandos para descargar e instalar la aplicación:

```
# Clona el código de la aplicación
$ git clone https://github.com/enajcelis/brandlive.git

# Instala las dependencias del proyecto (incluyendo Symfony)
$ cd brandlive/
$ composer install
```
Ejecutar los comandos para la creación de la base de datos:

```
# Crear base de datos
$ php app/console doctrine:database:create

# Actualizar base de datos
$ php app/console doctrine:schema:update --force  

# Si deseas validar las setencias a ejecutar:
$ php app/console doctrine:schema:update --dump-sql
```

Es importante agregar data en la tabla **group**, necesaria en el ABM de Clientes.

```
INSERT INTO customgroup VALUES (1, 'Grupo A');
INSERT INTO customgroup VALUES (2, 'Grupo B');
INSERT INTO customgroup VALUES (3, 'Grupo C');
```

# Probando la aplicación

La forma más sencilla de probar la aplicación es ejecutando el servidor web interno de PHP. De esta forma la aplicación se puede ejecutar sin necesidad de usar Apache o Nginx.

Para ello ejecuta el siguiente comando:

```
$ php app/console server:run
```

# Consideraciones
La aplicación está configurada con el driver de doctrine **pdo_pgsql**

Se deben agregar registros en la tabla **group**

## Autor

* **Jane Celis** - (https://www.linkedin.com/in/jane-celis)
