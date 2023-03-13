API=api_transfer

install:
	cd ./api_transfer/ && cp .env.example .env
	cd ./ms_notification/ && cp .env.example .env
	make build
	make up
	make npm_i

	make compose_install
	make migrate
	make seed
	docker ps
up:
	docker-compose up -d
	docker ps

down:
	docker-compose down

bash:
	docker exec -it $(API) bash

build:
	docker-compose build

seed:
	docker exec -t $(API) php artisan db:seed

compose_install:
	docker exec -t $(API) composer install
	docker exec -t $(API) php artisan key:generate

migrate:
	docker exec -t $(API) php artisan migrate
	docker exec -t $(API) php artisan passport:install

npm_i:
	docker exec -t notification_picpay npm i
	docker restart notification_picpay
