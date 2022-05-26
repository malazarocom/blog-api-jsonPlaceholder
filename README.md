# # Blog Api jsonPlaceholder

## Prerequisitos
    Php 8.1
    Symfony 6
    Composer 2

## Comandos

- Instalar dependencias:

        $ composer2 install

- Iniciar servidor de symfony:

        $ symfony serve

- Iniciar webpack encore:

        $ yarn install
        $ yarn --verbose encore dev-server --host 127.0.0.1 --port 9001 --hot

- Lanzar PhpStan:
    
        $ composer2 phpstan

- Lanzar test:
    
        $ composer2 phpunit;

- Probar API:

        http://127.0.0.1:8101/api

- Probar Front:

        http://127.0.0.1:8000/blog/articles

## Comentarios

Se ha optado por emplear el modelo de datos del API JsonPlaceholder sustiuyendo al que ofrece Symfony por defecto.

Para ello, aplicando la inversión de dependencias, se definen servicios de dominio (ArticleRepository) mediante declaración de interfaz,
y será el servicio de infraestructura(JsonPlaceholderPostQueryRepository) el encargado de la implementación en concreto.

De igual manera se utiliza la Interfaz HttpClientInterface para poder implementar SymfonyHttpClient encapsulando todo esa funcionalidad en un único archivo para incrementar la mantenibilidad del proyecto.
De tal manera que podrimamos añadir otro cliente como Guzzle creando Guzzleclient e implementandolo en vez del SymfonyHttpClient de Symfony.

En la parte front se utiliza: 
    Bootstrap 5 para la maquetación
    Extensión twig
    Un plugin js 'infinite scroll' cargado en stimulus.
    Modal con stimulus para cargar los detalles del artículo y autor.

## Experimento
He aprovechado para hacer pruebas e intentar separar el sistema en capas de infastructura, aplicación y dominio.
He probado la utilización de value objects para empujar la lógica al modelo.

## Todo
Profundizar en los test e investigar porqué al hacer post en api-platform devuelve 201, pero a la hora de hacer el test con "assertResponseStatusCodeSame" se obtiene un 401 "hydra:description":"Update is not allowed for this operation."
Llegar a phpstan level 9.