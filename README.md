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

1. Go to the appropriate environment folder (ex. ``dev``)
```
cd infra/dev
```
1. Build your docker environment `sudo docker-compose build`
1. Start your docker environment `sudo docker-compose up -d`
1. Install composer dependencies following your environment (eg for dev: `sudo docker exec dev_laravel composer install`)
1. Install node dependencies following your environment (eg for dev: `sudo docker exec dev_laravel npm install`)
1. Compile node vues following your environment (eg for dev: `sudo docker exec dev_laravel npm run dev`)
1. Generate your app key `sudo docker exec dev_laravel php artisan key:generate`
1. Migrate the database `sudo docker exec dev_laravel php artisan migrate`
1. Fill the database `sudo docker exec dev_laravel php artisan db:seed`
1. The website should now be available with the following url: http://localhost

### Useful commands

Below are some shell commands useful when working with the Docker stack.

1. Stop all container in the stack (still in the same folder as `docker-compose.yml`)
```
docker-compose stop
```
2. Stop and delete all containers in the stack
```bash
docker-compose down
```
3. Start a shell inside a running container
```bash
docker exec -it --user=foo container_name bash
# if --user is not specified, the last user set in the corresponding Dockerfile in used
```
4. List running containers
```
docker ps
```

### Documentation

User manual: see file xxxxx.

API documentation: see file yyyyy.
