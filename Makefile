run:
	docker-compose down --remove-orphans
	docker-compose up -d
shell:
	docker-compose exec vf-php /bin/bash
qa:
	docker-compose run --rm vf-qa php-cs-fixer fix --diff -v src
	docker-compose run --rm vf-qa phpstan analyse --level=max src
