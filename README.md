# Gateway


## To Run the project

- docker network create ouredu-service-app `docker network create ouredu-service-app`
- Copy the core/.env.example to core/.env
- `docker-compose up` you may need to use `sudo`
- `docker exec -it gateway bash` you may need to use `sudo`
- run `composer install` maybe not
- do your work

## Don't forget to compose up the ouredu-db project, since the project db is there.

### browse [http://localhost:8003](http://localhost:8003) for the app

### when changing any configuration in the Dockerfile or docker-compose you have to run `sudo docker-compose build`

## To Run The Unit Tests
- run `./vendor/bin/phpunit ./tests/Feature/ExampleTest.php`