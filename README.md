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
    - [Useful commands](#useful-commands)
    - [Documentation](#documentation)


### Dependencies

This project requires:

- git
  - https://git-scm.com/downloads
- Docker (up-to-date version)
  - https://docs.docker.com/install/
- Docker-compose
  - https://docs.docker.com/compose/install/

The containers will embed the other dependencies.

### Build Docker containers

1. Clone this repository
```
git clone git@github.com:kayoumido/HEIGVD-PRO-A-11.git
```

2. Go to the appropriate environment folder (ex. ``dev``)
```
cd infra/dev
```
3. to setup the environment the first time execute (this will start also startup the containers)

```bash
./setup-env.sh
# NB: this script simply run this comment
USER_ID=$(id -u) GROUP_ID=$(id -g)  docker-compose up --build
```

4. The build will take some times so go get a coffee.


### Run Docker stack

To start the containers, run the following (still in the same folder as the `docker-compose.yml`)

5. Afterward to start up the container just run (avoid re-build)
```bash
./start-env.sh
# NB: this script simply run this comment
USER_ID=$(id -u) GROUP_ID=$(id -g) docker-compose up laravel nginx db adminer
```

Check on which IP belongs to the Web server (look for `IPAddress`)
```
docker inspect dev_nginx
```

Finally, go to http://ipaddr and check everything works nominally.

**Note: nginx serves files from the `src/public` directory.**

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
