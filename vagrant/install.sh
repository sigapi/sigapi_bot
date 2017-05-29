#!/bin/bash

if [ ! -f ~/runonce ]
then

  export DEBIAN_FRONTEND=noninteractive # http://serverfault.com/a/670688

  # Pacotes
  apt-get update
  apt-get install -yq \
    curl \
    tree \
    unzip \
    zip

  # Timezone
  timedatectl set-timezone America/Sao_Paulo

  # Locale
  locale-gen pt_BR
  locale-gen pt_BR.UTF-8
  dpkg-reconfigure locales
  update-locale LANG=pt_BR.UTF-8

  # ----------------------------------------------------------------------------
  # Docker
  # ----------------------------------------------------------------------------
  apt-get install -yq
    linux-image-extra-$(uname -r) \
    linux-image-extra-virtual

  apt-get install -yq \
    apt-transport-https \
    ca-certificates \
    curl \
    software-properties-common

  curl -fsSL https://download.docker.com/linux/ubuntu/gpg | apt-key add -

  add-apt-repository \
    "deb [arch=amd64] https://download.docker.com/linux/ubuntu \
    $(lsb_release -cs) \
    stable"

  apt-get update
  apt-get install -yq docker-ce

  usermod -aG docker $USER

  # docker-compose
  curl -fsSL https://github.com/docker/compose/releases/download/1.13.0/docker-compose-`uname -s`-`uname -m` > /usr/local/bin/docker-compose
  chmod +x /usr/local/bin/docker-compose

  # ----------------------------------------------------------------------------

  touch ~/runonce

fi
