# PHP + MySQL demo for Render

This repository contains a minimal PHP app that connects to MySQL using environment variables. It's packaged with a Dockerfile and is ready to deploy to Render (https://render.com).

Environment variables

- DB_HOST: hostname (Render private service host or external MySQL host)
- DB_PORT: optional, default 3306
- DB_USER: database username
- DB_PASS: database password
- DB_NAME: database name (optional)

How the app works

- Visit the site, click "Create table`visits`" to create the table.
- Add entries using the form and they will be stored in the database.

Render deployment (Docker)

1. Create a new "Web Service" on Render.
2. Connect your repository and choose the `main` branch.
3. For the environment, choose "Docker" and Render will build the included `Dockerfile`.
4. Add environment variables in Render for DB_HOST, DB_USER, DB_PASS, DB_NAME.

If you prefer to use Render's Managed PostgreSQL or MySQL, create the database first and copy the host/user/password into the service's environment variables.

Local testing with Docker

Build and run locally (assuming Docker Desktop installed):

```bash
# build
docker build -t php-mysql-demo .
# run (replace values)
docker run -p 8080:80 -e DB_HOST=host -e DB_USER=user -e DB_PASS=pass -e DB_NAME=db php-mysql-demo
```

Then open http://localhost:8080

How to run with Homebrew PHP: 
brew install php (if you don’t already have it)
cd ~/Sites/myproject
php -S localhost:8000
http://localhost:8000

user: admin
password: admin123

How to php + mysql with docker (locally)
docker-compose up -d (run the containters)
docker-compose exec web php index.php (run php script)
docker-compose down (stop containers)

