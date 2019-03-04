all : composer up-quick
test : phpunit

up : all

up-quick :
	docker-compose up -d

down :
	docker-compose down --remove-orphans

composer :
	docker-compose run --rm --no-deps php sh -c "composer validate && composer install"

composer-require :
	docker-compose exec php sh -c "composer require $(package)"

phpunit :
	docker-compose exec php sh -c "./vendor/bin/phpunit"
