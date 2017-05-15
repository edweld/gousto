<?php
/**
 * @author: Ed Weld <edweld@gmail.com>
 * Written for PHP 7
 */

namespace Tests\Services;
use Silex\Application;
use Silex\Provider\DoctrineServiceProvider;
use App\Service\RecipeService;

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

        $stmt = $app["db"]->prepare("INSERT INTO recipe (title, recipe_cuisine) VALUES ('title1', 'british'), ('title2', 'british'), ('title3', 'british'), ('title4', 'italian')");
        $stmt->execute();

        $stmt = $app["db"]->prepare("CREATE TABLE rating (id INTEGER PRIMARY KEY AUTOINCREMENT, rating INTEGER NOT NULL, recipe_id INTEGER NOT NULL)");
        $stmt->execute();

        $stmt = $app["db"]->prepare("INSERT INTO rating (rating, recipe_id) VALUES (5,1), (4,1), (4,2),(5,2)");
        $stmt->execute();
    }

    public function test_fetchOneById()
    {
        $data = $this->recipeService->fetchOneById(1);
        $this->assertEquals('title1', $data['title']);
    }

    public function test_fetchAllByCuisine()
    {
        $data = $this->recipeService->fetchAllByCuisine('british',1,2);
        $this->assertEquals('title2', $data[0]['title']);
        $this->assertEquals(1, count($data));

        $data = $this->recipeService->fetchAllByCuisine('british',10,1);
        $this->assertEquals(3, count($data));
    }

    public function test_fetchRating()
    {
        $data = $this->recipeService->fetchRating(1);
        $this->assertEquals(2, count($data));
        $this->assertEquals( 5, $data[0]['rating']);
    }
    /**
     * @depends test_fetchOneById
     */
    public function test_updateRecipeById()
    {
        $recipe = ['title'=>'updatedtitle'];
        $result = $this->recipeService->updateRecipeById( 1, $recipe);
        $this->assertEquals(1, $result);
        $data = $this->recipeService->fetchOneById(1);
        $this->assertEquals('updatedtitle', $data['title']);
    }

    /**
     * @depends test_fetchOneById
     */
    public function test_addRecipe()
    {
        $recipe = ['title'=>'newrecipe with black beans', 'recipe_cuisine'=>'mexican'];
        $id = $this->recipeService->addRecipe($recipe);
        $this->assertTrue( ($id > 0));

        $data = $this->recipeService->fetchOneById($id);
        $this->assertEquals($recipe['title'],$data['title']);
        $this->assertEquals($recipe['recipe_cuisine'],$data['recipe_cuisine']);

    }
   
}