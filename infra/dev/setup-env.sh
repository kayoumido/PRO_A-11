#!/bin/bash

# build the container with the same UID and GID as the local user and launch the container
USER_ID=$(id -u) GROUP_ID=$(id -g)  docker-compose up --build
