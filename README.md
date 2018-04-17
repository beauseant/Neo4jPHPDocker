# Neo4jPHPDocker
Ejemplo de servidor neo4j con acceso PHP en un docker

Se crean dos contenedores docker:

- Uno contiene un servidor Apache con PHP y las librerías necesarias para cargar la base de datos Neo4j. El PHP se carga desde el directorio externo data/html/
- Otro con la base de datos propiamente dicha y los puertos necesarios abiertos.

El fichero de descriptor de la aplicación:

```javascript
version: '3.1'

services:

  db:
    image: neo4j
    ports:
      - "7474:7474"
      - "7687:7687"
    volumes:
      - ./data/neo4jdb:/data

  apachephp:
    image: apachephp
    depends_on:
      - db
    links:
      - db
    volumes:
      - ./data/html/:/var/www/html      
    ports:
      - "80:80"

```

# Instalación y ejecución

## Instalación de docker:

- cd containers
- docker build -t apachephp . , carga un apache con php y las librerias necesarias.
- docker image ls , para comprobar que funciona correctamente
- cd .. , volvemos al principal.
- docker swarm init --advertise-addr 127.0.0.1 , iniciamos el cluster / docker swarm leave --force para pararlo
- docker ps para comprobar que no tenemos nada en ejecución
- docker stack deploy -c Server.yml rosemary , Cargamos los dos docker necesarios con los puertos abiertos.

## Aplicaciones neo4js y PHP:

  Una vez terminada la instalación de la parte de docker, podemos comprobar el funcionamiento de los contenedores.

  ### Apache / PHP:
  
  Si nos conectamos a http://127.0.0.1/info.php comprobamos que podemos ver el servidor web.

  ### Neo4j

  Nos conectamos a http://127.0.0.1:7474/browser/ e introducimos los datos de la conexión. Al ser la primera vez, el usuario es neo4j y la contrasña es neo4j. UNa vez introducidos esos datos nos pide la nueva contraseña.

  Para poder probar la conexión con PHP debemos añadir algunos datos que se han sacado de los ejemplos. Creamos la base de datos de películas cargando en el navegador anterior los datos del fichero movieDatabase.neo4js (el fichero se encuentra en el raíz y debemos hacer un cortar / pegar )

  ### Aplicación PHP.

  Una vez creada la base de datos de películas abrimos en el navegador: http://127.0.0.1/info.php y vemos como se cargan algunos de los datos introducidos en el paso anterior.


    
