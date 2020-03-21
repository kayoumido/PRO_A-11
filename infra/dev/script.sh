#!/bin/bash

WWW = "/var/www"

#we set the path to composer bin
PATH = $PATH:$HOME/.composer/vendor/bin

cd $WWW

laravel new project

cd $WWW/project

php project/artisan ui vue

npm install && npm run dev
