
# Referências

- https://github.com/RobLoach/docker-composer/issues/101

# Anotações gerais

docker run --rm --user $(id -u):$(id -g) -v $(pwd):/app -v composer/composer create-project --prefer-dist laravel/laravel sigapi-bot

conectar - Realiza a conexão ao serviço
desconectar - Desfaz a conexão ao serviço
dados_cadastrais - Obtém os dados cadastrais
dados_desempenho - Obtém os dados de desempenho
notas_parciais - Obtém as notas parciais
faltas_parciais - Obteḿ as faltas parciais
