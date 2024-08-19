## Laravel Boilerplate

- bootstrap

```shell
docker-compose up
```

- post install

```shell
docker exec laravel_boilerplate_app composer install
docker exec laravel_boilerplate_app php artisan jwt:secret -f
docker exec laravel_boilerplate_app php artisan key:generate
docker exec laravel_boilerplate_app php artisan config:clear
docker exec laravel_boilerplate_app php artisan migrate
docker exec laravel_boilerplate_app chmod 0777 -R /var/www/html/storage
docker exec laravel_boilerplate_app chown -R www-data:www-data /var/www/html/storage
```

- start shell

```shell
docker exec -it laravel_boilerplate_app bash
```

- reset permission

```shell
sudo chown -R $USER:$USER .
```

- docker remove all

```shell
docker stop $(docker ps -aq)
docker container prune -f
docker image prune -f -a
docker volume prune -f -a
docker network prune -f
docker system prune
```