<?php
/**
 * @author: Ed Weld <edweld@gmail.com>
 * Written for PHP 7
 * tests are written against resources/sql/recipe.sql
 */

namespace Tests\Services;
use Silex\Application;
use Silex\Provider\DoctrineServiceProvider;
use App\Services\RecipeService;

class RecipeServiceTest extends \PHPUnit\Framework\TestCase 
{

    private $recipeService;

    public function setUp()
    {
        $app = new Application();
        $app->register(new DoctrineServiceProvider(), array(
            "db.options" => array(
                "driver" => "pdo_sqlite",
                "memory" => true
            ),
        ));
        $this->recipeService = new RecipeService($app["db"]);

        $stmt = $app["db"]->prepare("CREATE TABLE recipe (id INTEGER PRIMARY KEY AUTOINCREMENT, title VARCHAR NOT NULL, recipe_cuisine VARCHAR NOT NULL)");
        $stmt->execute();

        $stmt = $app["db"]->prepare("INSERT INTO recipe (title, recipe_cuisine) VALUES ('title1', 'british'), ('title1', 'british'), ('title3', 'british'), ('title4', 'italian'))");
        $stmt->execute();

        $stmt = $app["db"]->prepare("CREATE TABLE rating (id INTEGER PRIMARY KEY AUTOINCREMENT, rating INTEGER NOT NULL, recipe_id INTEGER NOT NULL)");
        $stmt->execute();

        $stmt = $app["db"]->prepare("INSERT INTO rating (rating, recipe_id) VALUES (5,1), (4,1), (4,2),(5,2))");
        $stmt->execute();
    }
}