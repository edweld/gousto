<?php
/**
 * Functional tests for application 
 * tests are written against resources/sql/recipe.sql
 * to execute tests locally in dev run the application 
 * php -S localhost:8000 -t web/ in a seperate terminal
 * @author: Ed Weld <edweld@gmail.com>
 * @package edweld/gousto <https://github.com/edweld/gousto>
 * PHP version 7
 */


require('vendor/autoload.php');

class ApiTest extends \PHPUnit\Framework\TestCase 
{
	protected $client;

    protected function setUp()
    {
        $this->client = new GuzzleHttp\Client([
            'base_uri' => 'http://localhost:8000'
        ]);
    }

    public function test_getOneById()
    {
        $response = $this->client->get('/recipe/1', []);
        $this->assertEquals(200, $response->getStatusCode());
        $data = json_decode($response->getBody(), true);
        $this->assertEquals('Sweet Chilli and Lime Beef on a Crunchy Fresh Noodle Salad', $data['title']);
        $this->assertEquals(59, $data['gousto_reference']);
    }

    public function test_getAllByCuisine()
    {
    	$response = $this->client->get('/recipe/cuisine/british/5/1', []);
    	$this->assertEquals(200, $response->getStatusCode());
    	$data = json_decode($response->getBody(), true);
    	$this->assertEquals(4, count($data));
    	$this->assertEquals('Umbrian Wild Boar Salami Ragu with Linguine', $data[0]['title']);
    	$this->assertEquals(7, $data[3]['id']);

    }

    public function test_addRecipe()
    {
    	$response = $this->client->post('recipe/add',['json'=>['title'=>'posted title','recipe_cuisine'=>'mexican']]);
    	$this->assertEquals(200, $response->getStatusCode(), true);
    	$id = json_decode($response->getBody(),true)['id'];

    	$response = $this->client->get('/recipe/'.$id, []);
        $data = json_decode($response->getBody(), true);
        $this->assertEquals('posted title', $data['title']);
        $this->assertEquals('mexican', $data['recipe_cuisine']);
    }

    public function test_updateRecipe()
    {
    	$response = $this->client->post('recipe/update/6',['json'=>['title'=>'posted updated title']]);
    	$this->assertEquals(200, $response->getStatusCode());

        $response = $this->client->get('/recipe/6', []);
        $data = json_decode($response->getBody(), true);
        $this->assertEquals('posted updated title', $data['title']);
    }

    public function test_addRating_fetchRating()
    {
        $response = $this->client->post('/recipe/rating/6',['json'=>['rating'=>5]]);
        $this->assertEquals(200, $response->getStatusCode());

        $response = $this->client->get('/recipe/rating/6',[]);
        $this->assertEquals(200, $response->getStatusCode());
        $data = json_decode($response->getBody(),true);
        
        $rating = array_pop($data); 
        $this->assertEquals(5, $rating['rating']);
    }
}
