#Gousto Test:#


You will need php **7.0*** with **SQLite extension** enabled and **Composer** and also **phpunit**

This application has been written using the PHP Microframework Silex. I really like the service container architecture which is very suited to this kind of task. Lumen may have also been a good choice, but this being a task for me to demonstrate my own skills I figured to stay with the Symfony based framework.  

The folder structure is pretty straight forward:

```
    +-- resources
    |   +-- sql +-- recipe.sql #sample data
    |   +-- config +-- prod.php #dynamic config
    |
    +-- src  #The main application
    |   +-- App
    |   |   +-- Controller
    |   |   +-- Exception
    |   |   +-- Service
    |   |   +-- Validator
    |   |   +-- RoutesLoader.php #Configuration for routes
    |   |   +-- ServicesLoader.php 
    |   +-- app.php #Bootstrapper
    |
    +-- tests
    |   +-- Functional 
    |   +-- Service
    +-- vendor #vendor libraries
    |
    +-- web/index.php #Application entrypoint 
```   


After checking out the code you will need to run the following lines to install vendor libraries, create the sample database and run unit tests.

```    
    composer install 
    sqlite3 app.db < resources/sql/recipe.sql
    phpunit
```

In dev, you can run the function tests by executing the following at the application root

```
    php -S 0:8000 -t web/
```
    
And run the tests in a seperate pipe/terminal window:

```
    phpunit tests/Functional/
```

Example Curl requests against the application in dev:

```    
    #Fetch recipe id 1
	curl http://localhost:8000/recipe/1 -H 'Content-Type: application/json' -w "\n"
	
	#add a recipe
	curl -X POST http://localhost:8000/recipe/add -d '{"title":"posted title","recipe_cuisine":"italian"}' -H 'Content-Type: application/json' -w "\n"
	
	#Receive recipes by cuisine /recipe/cuisine/{cuisine}/{per page}/{page}
	curl http://localhost:8000/recipe/cuisine/british/5/2 -H 'Content-Type: application/json' -w "\n
	
	#Update a recipe
	curl -X POST http://localhost:8000/recipe/update/5 -d '{"title":"posted title","recipe_cuisine":"italian"}' -H 'Content-Type: application/json' -w "\n"
	
	#Add a rating to a recipe
    curl -X POST http://localhost:8000/recipe/rating/5 -d '{"rating": 5}' -H 'Content-Type: application/json' -w "\n"
    
    #Fetch a list of ratings for a recipe
    curl http://localhost:8000/recipe/rating/1 -H 'Content-Type: application/json' -w "\n"
```


