# Aplicación web con Laravel 5.6
Proyecto diseñado para mi TFM. Consiste en una cliente web desarrollado en **PHP 7.2**
utilizando el framework **[Laravel 5.6](https://laravel.com/docs/5.6)**. La aplicación
consumirá los datos expuestos por la API desarrollada en el proyecto [carlosgmr/tfm-api-lumen](https://github.com/carlosgmr/tfm-api-lumen).

## Instalación y despliegue
Para instalar el proyecto hay que seguir los siguientes pasos:

1. Clonar o descargar proyecto desde GitHub: `git clone https://github.com/carlosgmr/tfm-app-laravel.git app-laravel`
2. Entrar en la carpeta del proyecto: `cd app-laravel`
3. Copiar el archivo `.env.example` y renombrarlo a `.env`
4. Abrir el archivo `.env` y completar las siguientes variables de configuración:

    - *APP_KEY*: cadena aleatoria que se utilizará para tareas de encriptación. Se recomienda que tenga una longitud mínima de 32 caracteres y que contega letras en mayúsculas y minúsculas y números.
    - *API_URL*: URL donde está desplegada la [API Lumen](https://github.com/carlosgmr/tfm-api-lumen). **Importante** Si API se encuentra en el mismo equipo, no utilizar `localhost` o `127.0.0.1`, sino la IP que tiene el equipo en la red local (utilizad ifconfig para averiguarla).

5. Construir la imagen de Docker: `docker build -t carlosgmr/app-laravel .`
   Tener en cuenta que hay que estar dentro de la carpeta del proyecto.
6. Construir contenedor Docker con la imagen anterior y ejecutarlo: `docker run -p 8972:80 --detach --memory 1g --name app-laravel carlosgmr/app-laravel`
7. La aplicación se encuentra accesible desde `http://localhost:8972`
