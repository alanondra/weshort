# WeShort

## Starting Up

### Software Requirements

* [Docker](https://docs.docker.com/engine/install/)
* [WSL2](https://learn.microsoft.com/en-us/windows/wsl/install)
    * for Windows users

### Getting Started
1. Make a copy of `.env.example` as `.env`
2. If you are on a Unix-based host, run the following commands to get your
    `UID` and `GID` respectively:

       id -u
       id -g

3. Apply these to the `WWWUSER` and `WWWGROUP` respectively
4. Update the following values to a comfortable port number for you to
    access from your host machine:

    - `APP_PORT` - **Web browser port** - You may also wish to add this
        to the end of `APP_URL`
    - `VITE_PORT` - **Vite port** - Front-end asset server
    - `FORWARD_DB_PORT` - **MariaDB port**
    - `FORWARD_REDIS_PORT` - **Redis port**
    - `FORWARD_MINIO_PORT` - **MinIO port**
    - `FORWARD_MINIO_CONSOLE_PORT` - **MinIO terminal access port**

5. Adjust any usernames and passwords in the file to your liking
6. Open a terminal to the project root and run `docker compose up`
7. Open another one and to access the app container with `docker exec -it ao.weshort.app /bin/sh`
8. Install the PHP packages using `composer install`
    - This will also give your host  access to the Sail binaries
9. Run the database migrations with `./vendor/bin/sail artisan migrate`
10. Run the Vite server using `./vendor/bin/sail npm run dev`
11. Open a browswer window to the hostname and `APP_PORT` given in `.env`
