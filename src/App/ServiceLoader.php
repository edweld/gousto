<?php
/**
 * Bind services to container
 * @author: Ed Weld <edweld@gmail.com>
 * @package edweld/gousto <https://github.com/edweld/gousto>
 * PHP version 7
 */

namespace App;

use Silex\Application;

class ServiceLoader
{
	/**
     * @var $app Silex\Application
     */
    protected $app;

    /**
     * Class constructor, calls instantiateControllers() method
     * @param object $app Silex\Application
     * @return void
     * @access public
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }
    
    /**
     * binds services to container
     * @access public
     * @return void
     */
    public function bindServicesIntoContainer()
    {
        $this->app['recipe.service'] = function() {
            return new Service\RecipeService($this->app["db"]);
        };
    }
}
