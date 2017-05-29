#!/bin/bash

set -e

# Para a execução anterior
cd /vagrant/laradock
docker-compose stop

# Atualiza configuração do laravel
cd /vagrant/sigapi-bot
rm -rf .env.
cp .env.production .env

# Limpa os arquivos do laravel
cd /vagrant/sigapi-bot/storage
rm -rf queue.pid
rm -rf logs/*

# Atualiza configuração do laradock
cd /vagrant/laradock
rm -rf .env.
cp .env.production .env

# Inicia novamente
cd /vagrant/laradock
docker-compose up -d nginx redis
