
# Referências

- https://github.com/RobLoach/docker-composer/issues/101

# Anotações gerais

docker run --rm --user $(id -u):$(id -g) -v $(pwd):/app -v composer/composer create-project --prefer-dist laravel/laravel sigapi-bot
