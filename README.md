# <img src="http://dev.kodkollektivet.se/public/images/svg/logo.svg" style="width: 40px;"> Kodkollektivet 3.0

### Kodkollektivet.se front & back.

Kodkollektivet is an IT student organization of Linnaeus University (Sweden).
<br>
<br>

<img src="http://dev.kodkollektivet.se/public/images/item_covers/default.jpg">

## Main focus

The website:
- Provides information about:
  - the organization
  - current, past and future projects
  - ongoing, past and future events
  - organisation members
<br>
 

## Acknowledgements
 
Powered by <a href="https://www.php.net/">PHP 7.4</a>, <a href="https://laravel.com/">Laravel</a>, <a href="https://tailwindcss.com/">Tailwind CSS</a> and the sheer lunacy of <a href="http://dev.kodkollektivet.se/member/theAlex" target="_blank">Aleksandra Bušure</a>.


## Localhost setup

### What you will need:
1. Apache / Nginx
2. MySQL / SQL
3. PHP 7.4

This repository utilises a slightly modified version of the Laravel (v8.83.13) framework. The setup process may differ from the one described in the documentation.

1. Clone the repository
2. cd into kodkollektivet.se-3.0 and run:
    - npm install
    - composer install
3. In project root, create a .env file
4. Copy the contents of .env.example over to a newly created file, and set your environment variables:
    - APP_URL (without port)
    - DB_CONNECTION (sqlite / mysql / pgsql / sqlsrv)
    - DB_HOST (localhost / 127.0.0.1)
    - DB_PORT (3306, 8889, etc)
    - DB_DATABASE (database name)
    - DB_USERNAME
    - DB_PASSWORD
5. From project root, run:
    - php artisan key:generate
    - php artisan optimize:clear
    - composer dump-autoload
6. Migrate and seed the database by running:
    - php artisan migrate
    - php artisan db:seed
- or, import kdkl.sql
7. Start the development server with:
    - php -S localhost:{port, no brackets}
8. In a new CMD / Terminal window, run:
    - npm run watch
9. Did it work?


## Deployment

1. Make sure the development server and NPM are not running
2. Set the .env variables to match the new host configuration, or create a new .env file.
3. In .env, set:
    - APP_ENV=production
    - APP_DEBUG=false
    - DB_HOST (either an address or localhost, depending on server configuration)
    - aforementioned variables
4. From project root, run:
    - php artisan optimize:clear
    - composer dump-autoload
5. FTP or SCP the files into your host (/www or /public_html); normally, you won't need:
    - resources/css
    - resources/js
    - resources/sass
    - webpack.mix.js
    - tailwind.config.js
6. SSH into the server and run:
    - php artisan migrate
    - php artisan db:seed
- or, import kdkl.sql / your instance of the database
7. Everything should be up :)


## TODOs

### Urgent
1. Non-Chromium-based browser support ✅
2. Email templates (e.g., invitation, welcome) ✅
3. Forms, requests, routes, methods for projects
4. Google index, XML sitemap ✅
5. Comment backend code
6. Open House notification / banner ✅
7. SMTP
8. @kodkollektivet.se emails for board people ✅
9. Address + Google Maps ✅
10. Favicon ✅

### Other
1. Refactor: EventController, PostController, ProjectController
2. Dedicated controller for any methods dealing with server-side rendering (e.g., in AJAX responses)
3. Remove HTML from renderers; use components
4. Minimise logic in templates
5. Repetitive HTML / JS to reusable components
6. Feature latest posts and events in /origins ✅
7. Event calendar (controller, view, export)
8. Think about spam
9. Sponsors listing ✅
10. Former sponsors / other collaborators
11. Edit sponsors form
12. Internal mailbox

### A day may come, but it is not this day
1. Docs (with Markdown API)
2. Event image listing for board people
3. Notify about posts from followed users
4. Notify about changes to followed events
5. Newsletter
6. Discord integration (primarily for the "doorbell" notification) ✅
7. Websockets and instant messaging
8. Company accounts, user flow etc
9. Forum / helpdesk