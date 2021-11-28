run:
	docker-compose down --remove-orphans
	docker-compose up -d
shell:
	docker-compose exec vf-php /bin/bash
