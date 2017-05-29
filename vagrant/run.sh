#!/bin/bash

cd /vagrant/sigapi-bot
rm -rf .env.
cp .env.production .env

cd ../laradock
docker-compose stop
docker-compose up -d nginx redis
