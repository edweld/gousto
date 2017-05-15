Gousto Test

You will need php **7.0*** with **SQLite extension** enabled and **Composer** and also **phpunit**
    
    composer install 
    sqlite3 app.db < resources/sql/recipe.sql
    phpunit

Functional testing
    php -S 0:8000 -t web/

Curl requests
    curl http://localhost:8000/recipe -H 'Content-Type: application/json' -w "\n"
    curl http://localhost:8000/recipe/1 -H 'Content-Type: application/json' -w "\n"
    curl -X POST http://localhost:8000/recipe/add -d '{"title":"posted title","recipe_cuisine":"italian"}' -H 'Content-Type: application/json' -w "\n"
    curl http://localhost:8000/recipe/cuisine/british/5/2 -H 'Content-Type: application/json' -w "\n
    curl -X POST http://localhost:8000/recipe/update/5 -d '{"title":"posted title","recipe_cuisine":"italian"}' -H 'Content-Type: application/json' -w "\n"

    curl -X POST http://localhost:8000/recipe/rating/5 -d '{"rating": 5}' -H 'Content-Type: application/json' -w "\n"
