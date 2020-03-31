# Paul

<PROJECT_DESCRIPTION>

This software was developed as semester project (PRO) at HEIG-VD,
academic year 2019/20.

Development team:

| Name                                         | Email                           | Github     |
|----------------------------------------------|---------------------------------|------------|
| Doran Kayoumi (project lead)                 | doran.kayoumi@heig-vd.ch        | kayoumido  |
| Fabio da Silva Marques (deputy project lead) | fabio.dasilvamarques@heig-vd.ch | fabio10000 |
| Moïn Danai                                   | guido.vanrossum@heig-vd.ch      | Serphentas |
| Sacha Perdrizat                              | sacha.perdrizat@heig-vd.ch      | Sinyks     |
| Rui Lopes Gouveia                            | rui.lopesgouveia@heig-vd.ch     | Lindwing   |
| Alban Favre                                  | alban.favre@heig-vd.ch          | alfavre    |

## **Development**

Below you will find all information related on how to get the development environment up and running.

### Steps

- [Paul](#paul)
  - [**Development**](#development)
    - [Steps](#steps)
    - [Dependencies](#dependencies)
    - [Build Docker containers](#build-docker-containers)
    - [Run Docker stack](#run-docker-stack)
    - [Start development](#start-development)
    - [Useful commands](#useful-commands)
    - [Documentation](#documentation)


### Dependencies

This project requires:

- git
  - https://git-scm.com/downloads
- Docker (v19.03.8-cd)
  - https://docs.docker.com/install/
- Docker-compose (v1.25.4)
  - https://docs.docker.com/compose/install/

The containers will embed the other dependencies.

### Build Docker containers

1. Clone this repository
```
git clone git@github.com:kayoumido/HEIGVD-PRO-A-11.git
```

1. Copy the file `src/.env.example` into `src/.env` and fill it with the environnement details

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

4. Install composer dependencies following your environment:

```shell
$ docker exec <env>_laravel composer install

# for dev
$ docker exec dev_laravel composer install
```

5. Install node dependencies following your environment:
```shell
$ docker exec <env>_laravel npm i

# for dev
$ docker exec dev_laravel npm i
```

6. Compile node vues following your environment:
```shell
$ docker exec <env>_laravel npm run dev

# for dev
$ docker exec dev_laravel npm run dev
```
7. Generate your app key:
```shell
$ docker exec dev_laravel php artisan key:generate
```

8. Migrate the database:
```shell
$ docker exec dev_laravel php artisan migrate
```

9. Fill the database:
```shell
$ docker exec dev_laravel php artisan db:seed
```

10. The website should now be available with the following url: http://localhost:<port>
The port will change depending on what is configured in `infra/dev/docker-compose.yml`. We've decided to use `80`
so the url will be `http://localhost/.

11. Start hacking :trollface:
Now you have the environment up and running :kissing_heart:.

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

### Documentation

User manual: see file xxxxx.

API documentation: see file yyyyy.
