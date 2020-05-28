<p align="center">
<img src="doc/paul.png" width="400">
</p>
<p align="center">
  <img src="https://forthebadge.com/images/badges/built-with-love.svg" alt="version">
  <img src="https://forthebadge.com/images/badges/made-with-vue.svg" alt="platform">
  <img src="https://forthebadge.com/images/badges/makes-people-smile.svg" alt="platform">
  <img src="https://forthebadge.com/images/badges/winter-is-coming.svg" alt="platform">
</p>


## Table of contents
* [About Paul.](#about-paul)
* [Getting started](#getting-started)
  * [Prerequisites](#prerequisites)
  * [Installation](#installation)
  * [Working with Vue.js](#working-with-vuejs)
  * [Start hacking :trollface:](#start-hacking-trollface)
* [API](#api)
* [Workflow](#workflow)
* [Documentation](#documentation)
* [Contributors](#contributors)

## About Paul.

Paul was developed as a semester project at the [HEIG-VD](https://heig-vd.ch/) in the academic year of 2019-2020'. It's main purpose is allow any kind presenters to offer polls to her/his audience in a simple way and receive the results instantly

## Getting started

### Prerequisites

- [Git](https://git-scm.com/downloads) (v2.26.0)
- [Docker](https://docs.docker.com/install/) (v19.03.8-cd)
- [Docker-compose](https://docs.docker.com/compose/install/) (v1.25.4)

The rest of the dependencies are embed by the Docker containers. But if you do not wish to use them here's the list:

* PHP
* Laravel
* Node
* PosgeSQL
* Nginx

### Installation

First things first, you need to clone the project on your local machine. You can either download the zip or user git.

```bash
# without ssh
https://github.com/kayoumido/HEIGVD-PRO-A-11.git

# with ssh
git clone git@github.com:kayoumido/HEIGVD-PRO-A-11.git
```

#### Build the containers

Go the the appropriate environment directory and build and run the containers.

> They can be found in the `infra` directory.  

```bash
cd infra/dev
docker-compose run --build -d
```

> Note: `-d` will *detach* the container. i.e. they'll run in the background
>
> If you wish to just build the containers, you con run the following
>
> ```bash
> docker-compose build
> ```

The names of the containers will be slightly different depending on the environment you choose.

| Environment | Prefix |
| ----------- | ------ |
| Production  | prod   |
| Development | dev    |

#### Install dependencies

You need to install the `composer` and `node` dependencies.

```bash
composer install
npm i
```

If you're using docker, you need to execute the above commands within the `laravel` container. 

> Note: The name of the containers will change depending on which environment you chose earlier. Production will have have the `prod` prefix and `dev` for the development environment.

```bash
docker exec dev_laravel composer install
docker exec dev_laravel npm i
```

#### Setup Laravel

First you need to copy the file `src/.env.example` into `src/.env` and fill it with the environment details. It will be needed for the following steps.

You then need the generate the key for the application

```shell
php artisan key:generate

# with docker
docker exec dev_laravel php artisan key:generate
```

> Note: The key will be automatically added to the `.env` file.

#### Setup the database

Now we can setup the database. You'll need to add some environment variables to the `.env` file. Here's the configuration we used with our development environment.

```
DB_CONNECTION=pgsql
DB_HOST=db
DB_PORT=5432
DB_DATABASE=laravel
DB_USERNAME=laravel
DB_PASSWORD=passPRO
```

> Note: if you've changed something within the Docker config to match your needs, this config might not fight and you'll have to change it.

To generate the DB and add some test data (i.e. seeds)

```shell
php artisan migrate
php artisan db:seed

# with docker
docker exec dev_laravel php artisan migrate
docker exec dev_laravel php artisan db:seed
```

Database setup check :heavy_check_mark:.

#### Setup `laravel/passport`

You'll need to generate the secrets of`laravel/passport`.

```shell
php artisan passport:install

# with docker
docker exec dev_laravel php artisan passport:install
```
You'll then need to update your `.env` file with the values of the `Client id` and `Client secret` from the `Password grant client` section.

 ```
PASSPORT_CLIENT=<client_id>
PASSPORT_CLIENT_SECRET=<client_secret>
 ```

#### Setup `laravel/scout`

In your `.env` file add the following.

```
SCOUT_DRIVER=tntsearch
```

Then, if you already have records in your database, you'll need to import the records to
the search driver for every model that you want to be "search-able".
In our case we only have `App\Presentation`.

```shell
php artisan scout:import "App\Presentation"

# with docker
docker exec dev_laravel php artisan scout:import "App\Presentation"
```
Since we've added the `Laravel\Scout\Searchable` trait to `App\Presentation`, Scout will take care of adding any new records to the search index.

#### Setup email

You now need to setup the email environment variables in your `.env` file. The configuration will vary depending on the provider you decide to use (i.e. gmail, homail, etc...). Here's an example of configuration for `mailtrap`

```
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@paul.ch
MAIL_FROM_NAME="${APP_NAME}"
```

> Note: Mailtrap comes preconfigured with Laravel

### Working with Vue.js
```bash
# compile the JS
npm run dev

# to have npm autocompile the JS after you save a file
npm run wath

# check if your code respects the JS guidelines
npm run lint

# fix any linting issues
npm run lint-fix

# with docker
docker exec dev_laravel npm run dev
docker exec dev_laravel npm run wath
docker exec dev_laravel npm run lint
docker exec dev_laravel npm run lint-fix
```

### Start hacking :trollface:
Now you have the environment up and running, the website should now be available with the following url: http://localhost:<port>
The port will change depending on what is configured in `infra/dev/docker-compose.yml`. We've decided to use `80`, so the url will be `http://localhost/.

## API

To see the documentation of the API, simply open  `src/public/docs/index.html` with your preferred web browser,

### Update the documentation

To update the api you must follow these [guidelines](https://laravel-apidoc-generator.readthedocs.io/en/v4/)

To regenerate the documentation just execute the following command `php artisan apidoc:generate`

## Workflow

For this project, we've put in place the [Gitflow](https://www.atlassian.com/git/tutorials/comparing-workflows/gitflow-workflow) workflow. Simply put, any new feature will have its own branch (see `GUIDELINES.md` for naming convention). Once it's completed, a PR will be made with `develop` as a base. This will trigger our [testing](.github/workflows/testing.yml) pipeline which will report if anything wrong happened (e.g. failed tests).

Once an iteration of development is completed, `develop` will be merged into `master` and it will trigger our second [pipeline](.github/workflows/prod.yml).

> Note: We've used Scrum to manage our project, so we've merged develop into master at the end of each sprint.

## Documentation

Guidelines: see `GUIDELINES.md`

Styleguide: see `STYLEGUIDE.md`

Any other documentation can be found on the [Google drive](https://drive.google.com/drive/folders/1UG8XgBYXcLnsYemoNqBL4o8rzbHp67e-) of the project.

## Contributors

| Name                                         | Email                           | Github     |
| -------------------------------------------- | ------------------------------- | ---------- |
| Doran Kayoumi (project lead)                 | doran.kayoumi@heig-vd.ch        | kayoumido  |
| Fabio da Silva Marques (deputy project lead) | fabio.dasilvamarques@heig-vd.ch | fabio10000 |
| Moïn Danai                                   | guido.vanrossum@heig-vd.ch      | Serphentas |
| Sacha Perdrizat                              | sacha.perdrizat@heig-vd.ch      | Sinyks     |
| Rui Lopes Gouveia                            | rui.lopesgouveia@heig-vd.ch     | Lindwing   |
| Alban Favre                                  | alban.favre@heig-vd.ch          | alfavre    |

## 
