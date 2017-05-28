#!/bin/bash

docker run \
  --rm \
  --user $(id -u):$(id -g) \
  -v $(pwd):/app \
  -v $(pwd)/.composer-cache:/composer/cache \
  composer/composer "$@"
