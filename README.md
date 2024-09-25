
# Personal blog project

Just a simple demo project that let the author publish aritcles with tags and a category for each article.








## The author can:
Manage (articles, tags and categories).

Login to his website (using laravel breeze) but no registeration is allowed.

Introduce himself in a simple (About me) page.
## The user can:
See the articles published from the author (as a guest).

See the (About me) page (as a guest).


## The goal of the project:
The goal was to implement some topics as a practice and put some of the knowledge into a simple project.
## How to run this project in your local machine:
After you clone the project you have to run:

- composer install
- copy .env.example .env
- php artisan key:generate
- npm install
- php artisan storage:link
- after creating the database you should run: php artisan migrate --seed
- php artisan serve
- npm run dev