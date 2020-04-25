# Paul

- [Paul](#paul)
  - [About](#about)
  - [Contributers](#contributers)
  - [Getting started](#getting-started)
    - [Dependencies](#dependencies)
    - [Configure environnment](#configure-environnment)
    - [Build Docker containers](#build-docker-containers)
    - [Install dependencies](#install-dependencies)
    - [Setup Laravel](#setup-Laravel)
    - [Working with Vue.js](#working-with-vuejs)
    - [Start hacking :trollface:](#start-hacking-trollface)
    - [Useful commands](#useful-commands)

## About
<PROJECT_DESCRIPTION>

This software was developed as semester project (PRO) at HEIG-VD,
academic year 2019/20.

## Contributers

| Name                                         | Email                           | Github     |
|----------------------------------------------|---------------------------------|------------|
| Doran Kayoumi (project lead)                 | doran.kayoumi@heig-vd.ch        | kayoumido  |
| Fabio da Silva Marques (deputy project lead) | fabio.dasilvamarques@heig-vd.ch | fabio10000 |
| Moïn Danai                                   | guido.vanrossum@heig-vd.ch      | Serphentas |
| Sacha Perdrizat                              | sacha.perdrizat@heig-vd.ch      | Sinyks     |
| Rui Lopes Gouveia                            | rui.lopesgouveia@heig-vd.ch     | Lindwing   |
| Alban Favre                                  | alban.favre@heig-vd.ch          | alfavre    |

## Getting started

Below you will find all information related on how to get the development environment up and running.

### Dependencies

This project requires:

- [git](https://git-scm.com/downloads)
  - v2.26.0
- [Docker](https://docs.docker.com/install/)
  - v19.03.8-cd
- [Docker-compose](https://docs.docker.com/compose/install/)
  - v1.25.4

The containers will embed the other dependencies.


### Configure environnment
1. Clone this repository
```
git clone git@github.com:kayoumido/HEIGVD-PRO-A-11.git
```

2. Copy the file `src/.env.example` into `src/.env` and fill it with the environnement details

here's the details for the database used for dev

*Note: If you changed something within de Docker config to match you needs, this config might not work.*
```
DB_CONNECTION=pgsql
DB_HOST=db
DB_PORT=5432
DB_DATABASE=laravel
DB_USERNAME=laravel
DB_PASSWORD=passPRO
```

### Build Docker containers
1. Go to the appropriate environment folder (ex. ``dev``)
```
$ cd infra/dev
```

2. Build your docker environment:
```shell
$ docker-compose build
```

3. Start your docker environment:
```shell
$ docker-compose up -d
```
*Note: `-d` will "detach" the container. i.e. they will run in the background*


### Install dependencies
1. Install composer dependencies following your environment:
```shell
$ docker exec <env>_laravel composer install

# for dev
$ docker exec dev_laravel composer install
```

2. Install node dependencies following your environment:
```shell
$ docker exec <env>_laravel npm i

# for dev
$ docker exec dev_laravel npm i
```

### Setup Laravel
1. Generate your app key:
```shell
$ docker exec dev_laravel php artisan key:generate
```

2. Migrate the database:
```shell
$ docker exec dev_laravel php artisan migrate
```

3. Fill the database:
```shell
$ docker exec dev_laravel php artisan db:seed
```

4. Generate Passport secrets
```shell
$ docker exec dev_laravel php artisan passport:install
```
Once donne copy the values of `Client id` and `Client secret` from the Password 
grant client section and paste them on your `.env` file under `PASSPORT_CLIENT` and `PASSPORT_CLIENT_SECRET`

### Working with Vue.js
1. Compile node vues following your environment:
```shell
$ docker exec <env>_laravel npm run dev

# for dev
$ docker exec dev_laravel npm run dev
```

### Start hacking :trollface:
Now you have the environment up and running, the website should now be available with the following url: http://localhost:<port>
The port will change depending on what is configured in `infra/dev/docker-compose.yml`. We've decided to use `80`
so the url will be `http://localhost/.

### Useful commands
Below are some shell commands useful when working with the Docker stack.

1. Stop all container in the stack (still in the same folder as `docker-compose.yml`)
```shell
$ docker-compose stop
```
2. Stop and delete all containers in the stack
```shell
$ docker-compose down
```

3. Start a shell inside a running container
```shell
$ docker exec -it <container_name> bash
```
*Note: you can specify the user you want to use with the `--user=<username>` flag.

4. List running containers
```shell
$ docker ps
```

## Workflow

Whenever a commit is made on any branch but master, or a PR is made on `develop`, the (Testing)[.github/workflows/testing.yml] pipeline will run. It reports whether the new code passes unit tests.

Whenever a commit is made on `master`, the (Production)[.github/workflows/prod.yml] pipeline will run. It updates the production stack with the latest code, migrating DB data, etc.

## Documentation

User manual: see file xxxxx.

API documentation: see file `api.md`.
