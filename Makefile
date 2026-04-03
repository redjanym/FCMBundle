.PHONY: test phpstan

test:
	vendor/bin/phpunit

phpstan:
	vendor/bin/phpstan analyse
