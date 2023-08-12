API Rest com Laravel

Rotas

http://127.0.0.1:8989/api/cliente/{id} Get //HTTP Method: Get

http://127.0.0.1:8989/api/clienteCadastro Insert //HTTP Method: Post

http://127.0.0.1:8989/api/cliente/{id} Update //HTTP Method: Patch

http://127.0.0.1:8989/api/cliente/{id} Delete //HTTP Method: Delete

http://127.0.0.1:8989/api/cliente/consulta/final-placa/{id} //HTTP Method: GET //Traz todos os clientes cujo final da placa é o numero escolhido


Para iniciar o projeto, basta ter o docker, dar os comandos

docker composer up -d

docker-compose exec app bash

ao entrar no terminal do container dar o comando

composer install

php artisan migrate