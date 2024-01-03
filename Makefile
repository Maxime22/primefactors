build:
	docker build -t imageprimefactors .

start:
	docker run -it -d -v ${PWD}:/app --name containerprimefactors -p 8080:80 imageprimefactors

sh:
	docker exec -it containerprimefactors sh

test:
	docker exec containerfractions sh -c "php -d memory_limit=512M ./vendor/bin/phpunit"

