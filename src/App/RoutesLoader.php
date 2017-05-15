<?php

/**
 * Route abstraction for managing uri access points
 * PHP Version 7.0
 * @author Ed.weld <edweld@gmail.com>
 */

namespace App;

use Silex\Application;

class RoutesLoader
{
    /**
     * @var $app Silex\Application
     */
    private $app;

    /**
     * Class constructor, calls instantiateControllers() method
     * @param object $app Silex\Application
     * @return void
     * @access public
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->instantiateControllers();

    }

    /**
     * instantiates recipe controller and binds to $app on key recipe.controller
     * @access private
     * @return void
     */
    private function instantiateControllers()
    {
        $this->app['recipe.controller'] = function() {
            return new Controller\RecipeController($this->app['recipe.service']);
        };
    }

    /**
     * binds routes to controller factory
     * @access public
     * @return void
     */
    public function bindRoutesToControllers()
    {
        $api = $this->app["controllers_factory"];
        $api->get("/recipe/{id}", "recipe.controller:fetchOneById");
        $api->get("/recipe/cuisine/{cuisine}/{perpage}/{page}", "recipe.controller:fetchAllByCuisine");
        $api->post("/recipe/add", "recipe.controller:addRecipe");
        $api->post("/recipe/update/{id}", "recipe.controller:updateRecipeById");
        $api->get("/recipe/rating/{recipe_id}", "recipe.controller:fetchRating");
        $api->post("/recipe/rating/{recipe_id}", "recipe.controller:addRatingById");
        $this->app->mount('/', $api);
    }
}