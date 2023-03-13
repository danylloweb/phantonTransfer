## Introdução

Esse é o Backend do Aplicativo Mobile T.A.M.A.S

## Pré-requisitos

- api_notification

## Instruções de Instalação

Clone esse projeto para sua máquina e execute os passos abaixo no diretório base do projeto.

Passos:

Crie a rede Docker chamada TAMAS com o comando.
```sh
docker network create tamas
```

Instale os seguintes serviços:

- MySQL
- MongoDB
- MongoDB Express
- Redis
- Redis Commander

```sh
docker-compose -f docker-dependent-services.yml up --build -d
```

Certifique-se que todos os containers acima estão executando sem erros e de forma consistente sem reinicializações.

Crie o arquivo .env com o comando abaixo:

```sh
cp .env.example .env
```

OBS: O arquivo .env.example deve a maioria das variáveis de ambiente já pre-definidas. De qualquer maneira verifique novamente, inclusive para se certificar que os dados de conexão com o banco de dados MySQL estão corretos. Modifique se necessário.

Agora você deve criar os seguintes containers:

- API TAMAS (PHP Laravel)
- NGINX TAMAS (Entre o GATEWAY e a API TAMAS)

use o comando abaixo:

```sh
docker-compose up --build -d
```

Certifique-se que os containers acima foram criados e estão executando sem problemas.

O próximo passo consiste em instalar as dependências do Laravel, criar as tabelas do banco de dados MySQL e realizar a carga inicial do banco de dados.

Acesse o container tamasapi

```sh
docker-compose exec api_tamas bash
```

e execute os comandos abaixo:

```sh
composer install
php artisan migrate --force
php artisan db:seed --force
exit
```
Você deverá ver mensagens de sucesso como:

- Package manifest generated successfully.
- Migration table created successfully.
- Migrating: 2014_10_12_000000_create_users_table
- Migrated:  2014_10_12_000000_create_users_table (98.10ms)
- ...
- Seeding: Database\Seeders\UserSeeder
- Seeded:  Database\Seeders\UserSeeder (400.15ms)
- ...
- Database seeding completed successfully.

Pronto, backend API TAMAS deve estar instalado.

Agora procure o projeto GATEWAY_TAMAS e instale ele para conseguir realizar testes.

OBS: O MongoDB desse projeto é o mesmo do projeto do GATEWAY_TAMAS. Esse projeto cria os usuário no MySQL e no MongoDB. Então o GATEWAY_TAMAS usa os usuários criados no MongoDB para realiza as autenticações.

É possível chamar os endpoints desse projeto sem autenticação passando o e-mail do usuário no header da requisição HTTP.

Quando for necessario gerar os usuarios cadatrados no Mysqs no mongo deve ser usando o comando abaixo:

```sh
docker-compose exec api_tamas bash
php artisan createUserMongo:run
```

