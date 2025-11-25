# PHP + MySQL Demo App for Render
A minimal PHP application demonstrating a MySQL connection using **environment variables**. Ready to deploy to [Render](https://render.com) or run locally with PHP.

## Features
* Connects to MySQL using environment variables.
* Simple web interface to create a table and add entries.
* Compatible with Render deployment using Render Managed Databases or external MySQL hosts.    

## Environment Variables

Set the following in Render or your local environment:

| Variable | Description |
| --- | --- |
| DB_HOST | MySQL hostname (freesqldatabase) |
| DB_PORT | MySQL port |
| DB_USER | Database username |
| DB_PASS | Database password |
| DB_NAME | Database name |

## Usage

### 1\. Running on Render

1.  Create a **Web Service** in Render.
    
2.  Connect your GitHub repository and select the `main` branch.
    
3.  Add environment variables (`DB_HOST`, `DB_USER`, `DB_PASS`, `DB_NAME`, optionally `DB_PORT`).
    
4.  Visit your deployed app in the browser.
    

> If using Render Managed MySQL/PostgreSQL, create the database first and copy the credentials into your environment variables.

### 2\. Running Locally

1.  Make sure PHP and MySQL are installed on your machine (e.g., via Homebrew on macOS).
    
2.  Set your environment variables locally (or create a `.env` file for development).
    
3.  Start the PHP built-in server in the project root:
    

`php -S localhost:8000`

4.  Open [http://localhost:8000](http://localhost:8000) in your browser.
    

### 3\. Default Login

*   **Username:** `admin`
    
*   **Password:** `admin123`
    

## Project Structure

html/       ← main PHP files  
admin/      ← admin pages  
assets/     ← images, CSS, JS  
includes/   ← reusable PHP includes  
pages/      ← main pages  
db.php      ← database connection  
index.php   ← entry point  
vendor/     ← Composer dependencies  
composer.json  
composer.lock  
README.md  
.gitignore

## Notes

*   `.env` is **not included in production**. Use Render’s environment variables instead.
    
*   Composer dependencies (`vendor/`) must be present for local testing or installed via `composer install`.
    
*   Ensure your database allows connections from the deployment environment (Render cloud).