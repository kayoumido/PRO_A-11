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

## Dependencies

This project require the followings :

- git
  - https://git-scm.com/downloads
- Docker (up-to-date version)
  - https://docs.docker.com/install/
- Docker-compose
  - https://docs.docker.com/compose/install/

The containers will embedded the other dependencies


## Build and install

1. Clone this repository
```
git clone git@github.com:kayoumido/HEIGVD-PRO-A-11.git
```

2. Go to the ``dev`` folder
```
cd infra/dev
```
3. Run docker compose to build all of the container, be sur to be in the dev folder
```
docker-compose build
```
4. the build will take some times (go get a coffee)

## Run

1. To start the containers in the start (always in the same folder as docker-compose.yml)
   
```
docker-compose up # to start the stack
docker-compose up -d # to start the stack and detach the terminal
```
   
2. go to http://localhost check

## VueJs setup (TEMP)

1. Inside the container __laravel__
2. go to the project folder
3. set up dependencies
```
composer require laravel/ui
```
4. Setup VueJs
```
php artisan ui vue
npm install && npm run dev
```

## Usefule command
1. Stop all container in the stack (always in the same folder as docker-compose.yml)
```
docker-compose stop
```
2. Stop and delete all containers in the stack
```
docker-compose down
```
3. Start a shell inside a running container
```
docker exec -it --user=foo container_name bash # if --user is not specifie it is the last user set in the dockerfile
```
4. List running container
```
docker ps
```
## Documentation

User manual: see file xxxxx.

API documentation: see file yyyyy.
