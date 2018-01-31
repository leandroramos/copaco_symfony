# CoPaco - Controle do Parque Computacional 

Sistema de controle do parque computacional nas unidades da USP

## Objetivo

* Ser o primeiro sistema das oficinas a serem realizadas com desenvolvedores PHP interessados em boas práticas de desenvolvimento.
* Integrar os desenvolvedores de diversas unidades da USP formando uma comunidade com foco no desenvolvimento de soluções utilizando software livre.

## Tecnologias utilizadas

* Frontend e Backend
    - HTML, CSS, JS
    - PHP (Symfony Framework)
* Banco de dados
    - PostgreSQL, MySQL ou SQLite

## Procedimentos de Deploy
    - composer install
    - yarn run encore dev
    - php bin/console doctrine:migrations:migrate

## dicas:

Gerar hash para senhas:

    ./bin/console security:encode-password

Inserir usuário no banco de dados:

    insert into local_user values (1,'admin','$2y$13$iY27ArIxc7DF2jyop.A90./nklpNyAjmAtla.k5zvH2HxXO4CvhZm','{"ROLE_ADMIN": "ROLE_ADMIN"}' );
    insert into local_user values (2,'user','$2y$13$qTlNiepx0m3U9tec/KlrIenGrPOZqZs6K2RQvNM/S9q2wV7.m/kui','{"ROLE_USER": "ROLE_USER"}' );



