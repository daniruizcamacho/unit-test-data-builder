.PHONY: build
build:
	docker-compose up --build

.PHONY: tests
tests:
	docker-compose run php vendor/bin/phpunit