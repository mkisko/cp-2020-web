.PHONY: boot
boot:
	- composer install
	- bin/console doctrine:schema:create
	- bin/console doctrine:schema:update --force
	- bin/console cache:clear

.PHONY: clear
clear:
	- bin/console doctrine:schema:update --force
	- bin/console cache:clear