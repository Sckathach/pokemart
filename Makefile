all: start
start:
	symfony server:start
reload:
	symfony console doctrine:database:drop --force
	symfony console doctrine:database:create
	symfony console doctrine:schema:create
	symfony console doctrine:fixture:load -n



