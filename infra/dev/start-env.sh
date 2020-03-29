#!/bin/bash

# start only the container for hosting the file
USER_ID=$(id -u) GROUP_ID=$(id -g) docker-compose up -d laravel nginx db
