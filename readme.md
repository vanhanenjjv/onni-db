# Backup Tool

This tool automates backing up remote servers. You define the servers, directories and commands. Then transfer the generated files back to archival storage.

## Installing

Backup Tool uses Docker to run everything which makes setting up a breeze. _The following instructions expect you have `git` and `docker` installed. Install Git [here](https://git-scm.com/) and Docker [here](https://docker.com/)._

1. First, clone the git repo by running the following code:<br>
    `git clone https://github.com/mirorauhala/laravel-backup.git`

2. Build and start the containers by running:<br>
    `docker-compose start -d`

3. Initialise empty database by running:<br>
    `docker-compose exec php-fpm touch database/database.sqlite`

4. Run migrations for the database:<br>
    `docker-compose exec php-fpm php artisan migrate`

5. Open browser at [http://localhost/](http://localhost/).

## License

Backup Tool is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
