![php badge](https://img.shields.io/badge/php-%3E%3D%208.0-blue)

# Management patrimony

_school project in LPDIM_

Site de gestion du patrimoine d'Annecy (France).
Il servira par exemple à lister des monuments, mettre des descriptions, des photos etc ...

## Déploiement en prod
[https://findme.nathan-cuvellier.fr/](https://findme.nathan-cuvellier.fr/)

## Getting started

Installation des dépendances
```sh
$ composer install
```
Configurer votre php init et décommenter ses 2 lignes :
```
extension=fileinfo
extension=gd
```
Configurer le fichier `.env` pour utiliser une base de donnée

*Les migrations actuelles sont générées pour PostgresSQL*
```sh
$ php bin/console doctrine:database:create
$ php bin/console doctrine:migration:migrate
$ php bin/console doctrine:fixtures:load
```

Pour régénérer le style css, si vous avec sass d'installer :
```
$ sass assets/styles/app.scss public/assets/styles/app.css --style compressed --watch
```

