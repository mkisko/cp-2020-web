boot:
	- bin/console doctrine:schema:create
	- bin/console doctrine:schema:update --force
	- bin/console cache:clear