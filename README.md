



## Instalation of the project:

Make sure port 8000 is not busy. App is using standart .env file.

```bash
cp backend/.env.example backend/.env
```
```bash
docker-compose up --build -d
```
```bash
docker exec yellow-duck-backend php artisan migrate
```
## You can go to:
http://localhost:8000

## For development purposes:

Set ENV_TYPE=dev. Vite dev server will be available.

```bash
docker-compose up --build -d
```