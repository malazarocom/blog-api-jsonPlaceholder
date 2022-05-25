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

- Probar API:

        http://127.0.0.1:8101/api

- Probar Front:

        http://127.0.0.1:8000/blog/articles

## Comentarios

Se ha optado por emplear el modelo de datos del API JsonPlaceholder y sustituirlo por el que ofrece Symfony por defecto.

Para ello, aplicando la inversión de dependencias, se definen servicios de dominio (ArticleRepository) mediante declaración de interfaz,
y serán e servicio de infraestructura(JsonPlaceholderPostQueryRepository) el encargado de la implementación en concreto.

De igual manera se utiliza la Interfaz HttpClientInterface para poder implementar SymfonyHttpClient encapsulando todo esa funcionalidad en un único archivo para incrementar la mantenibilidad del proyecto.
De tal manera que podrimamos añadir otro cliente como Guzzle creando Guzzleclient e implementandolo en vez del SymfonyHttpClient de Symfony.

En la parte front se utiliza: 
    - Bootstrap 5 para la maquetación
    - Extensión twig
    - Un plugin js 'infinite scroll' cargado en stimulus.