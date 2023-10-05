
reload:
	symfony console doctrine:database:drop --force
	symfony console doctrine:database:create
	symfony console doctrine:schema:create
	symfony console doctrine:fixture:load -n

start:
	symfony server:start
