
banco de dados:

    create user paco with password 'paco';
    create database paco with owner paco;


    composer installl
    yarn run encore dev
    yarn run encore dev --watch

    ./bin/console doctrine:migrations:migrate


    ./bin/console security:encode-password

    insert into local_user values (1,'admin','$2y$13$iY27ArIxc7DF2jyop.A90./nklpNyAjmAtla.k5zvH2HxXO4CvhZm','{"ROLE_ADMIN": "ROLE_ADMIN"}' );
    insert into local_user values (2,'user','$2y$13$qTlNiepx0m3U9tec/KlrIenGrPOZqZs6K2RQvNM/S9q2wV7.m/kui','{"ROLE_USER": "ROLE_USER"}' );



